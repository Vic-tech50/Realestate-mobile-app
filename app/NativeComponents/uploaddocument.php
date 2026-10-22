<?php

namespace App\NativeComponents;

use App\Models\User;
use App\Services\AuthStorage;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Native\Mobile\Attributes\On;
use Native\Mobile\Edge\NativeComponent;
use Native\Mobile\Edge\Transition;
use Native\Mobile\Events\Camera\PhotoTaken;
use Native\Mobile\Events\Gallery\MediaSelected;
use Native\Mobile\Facades\Camera;

class uploaddocument extends NativeComponent
{
    public array $user = [];

    public ?string $documentType = null;

    public ?string $documentPath = null;

    public bool $isUploading = false;

    public string $message = '';

    /**
     * Select National ID
     */
    public function selectNationalId(): void
    {
        $this->documentType = 'national_id';
        $this->message = '';
    }

    /**
     * Select Passport
     */
    public function selectPassport(): void
    {
        $this->documentType = 'passport';
        $this->message = '';
    }

    /**
     * Select Voter's Card
     */
    public function selectVotersCard(): void
    {
        $this->documentType = 'voters_card';
        $this->message = '';
    }

    /**
     * Take document photo
     */
    public function takePhoto(): void
    {
        if (! $this->documentType) {
            $this->message = 'Please select a document type first.';

            return;
        }

        Camera::getPhoto()
            ->id('agent-verification-document');
    }

    /**
     * Select document from gallery
     */
    public function chooseFromGallery(): void
    {
        if (! $this->documentType) {
            $this->message = 'Please select a document type first.';

            return;
        }

        Camera::pickImages('image', false);
    }

    /**
     * Camera photo received
     */
    #[On(PhotoTaken::class)]
    public function handlePhotoTaken(string $path): void
    {
        $this->documentPath = $this->resolveDocumentPath($path);

        $this->message = $this->documentPath
            ? 'Document photo captured successfully.'
            : 'The captured document could not be accessed.';
    }

    /**
     * Gallery image received
     */
    #[On(MediaSelected::class)]
    public function handleMediaSelected(
        $success,
        $files,
        $count
    ): void {
        if (! $success || empty($files)) {
            $this->message = 'No document was selected.';

            return;
        }

        $file = $files[0];

        /*
        |--------------------------------------------------------------------------
        | Depending on the camera plugin version, the file may be returned
        | as a path or an array containing "path".
        |--------------------------------------------------------------------------
        */

        $this->documentPath = $this->resolveDocumentPath($file);

        if ($this->documentPath) {
            $this->message = 'Document selected successfully.';
        } else {
            $this->message = 'Unable to read the selected document.';
        }
    }

    /**
     * Submit verification document
     */
    public function submitVerification(): void
    {
        if (! $this->documentType) {
            $this->message = 'Please select your document type.';

            return;
        }

        if (! $this->documentPath) {
            $this->message = 'Please take or select a photo of your document.';

            return;
        }

        $userId = (int) ($this->user['id'] ?? 0);

        if ($userId <= 0) {
            $this->message = 'Unable to identify your account.';

            return;
        }

        $this->isUploading = true;

        try {
            $user = User::findOrFail($userId);

            /*
            |--------------------------------------------------------------------------
            | Make sure the file exists
            |--------------------------------------------------------------------------
            */

            $documentPath = $this->resolveDocumentPath($this->documentPath);

            if (! $documentPath) {
                $this->message = 'The selected document could not be found.';

                return;
            }

            $this->documentPath = $documentPath;

            /*
            |--------------------------------------------------------------------------
            | Generate a random filename
            |--------------------------------------------------------------------------
            */

            $extension = pathinfo(
                $this->documentPath,
                PATHINFO_EXTENSION
            );

            $extension = $extension ?: 'jpg';

            $filename = bin2hex(random_bytes(32)) . '.' . $extension;

            /*
            |--------------------------------------------------------------------------
            | Store privately
            |--------------------------------------------------------------------------
            */

            $directory = 'verification-documents/' . $user->id;

            $storedPath = Storage::disk('local')->putFileAs(
                $directory,
                new File($this->documentPath),
                $filename
            );

            /*
            |--------------------------------------------------------------------------
            | Delete old document if one exists
            |--------------------------------------------------------------------------
            */

            if (
                $user->verification_document_path &&
                Storage::disk('local')->exists(
                    $user->verification_document_path
                )
            ) {
                Storage::disk('local')->delete(
                    $user->verification_document_path
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Update user
            |--------------------------------------------------------------------------
            */

            $user->update([
                'verification_document_type' => $this->documentType,
                'verification_document_path' => $storedPath,
                'verification_status' => 'pending',
                'verification_rejection_reason' => null,
                'verification_submitted_at' => now(),
                'verification_verified_at' => null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Update local AuthStorage if necessary
            |--------------------------------------------------------------------------
            */

            $this->message =
                'Your document has been submitted successfully.';

            $this->documentPath = null;

            /*
            |--------------------------------------------------------------------------
            | Go to verification status page
            |--------------------------------------------------------------------------
            */

            $this->navigate('/agentprofile')
                ->transition(Transition::SlideFromBottom);
        } catch (\Throwable $e) {

            report($e);

            $this->message =
                'Unable to upload your document. Please try again.';
        } finally {

            $this->isUploading = false;
        }
    }

    public function render(): View
    {
        $this->user = AuthStorage::user() ?? [];

        return view('native.uploaddocument', [
            'user' => $this->user,
        ]);
    }

    private function resolveDocumentPath(mixed $file): ?string
    {
        if (is_array($file)) {
            foreach (['path', 'uri', 'url', 'file', 'localPath'] as $key) {
                if (isset($file[$key])) {
                    return $this->resolveDocumentPath($file[$key]);
                }
            }

            return null;
        }

        if (! is_string($file) || trim($file) === '') {
            return null;
        }

        $path = trim($file, " \t\n\r\0\x0B\"'");

        // Native camera APIs may return a file URL rather than a filesystem path.
        // Decode the URL path (including spaces) before checking it on disk.
        if (str_starts_with(strtolower($path), 'file://')) {
            $urlPath = parse_url($path, PHP_URL_PATH);

            if (! is_string($urlPath) || $urlPath === '') {
                return null;
            }

            $path = rawurldecode($urlPath);

            // Windows file URLs commonly look like /C:/path.
            if (PHP_OS_FAMILY === 'Windows' && preg_match('/^\/[A-Za-z]:\\\\/', $path)) {
                $path = substr($path, 1);
            }
        } elseif (str_starts_with(strtolower($path), 'content://') || preg_match('/^https?:\\/\\//i', $path)) {
            return null;
        }

        // Normalize absolute native paths; this also removes harmless ./ segments.
        $resolvedPath = realpath($path);
        if ($resolvedPath !== false && is_file($resolvedPath) && is_readable($resolvedPath)) {
            return $resolvedPath;
        }

        // Gallery references are normally relative to Laravel's local disk.
        if (str_starts_with($path, DIRECTORY_SEPARATOR) || preg_match('/^[A-Za-z]:[\\\\\/]/', $path)) {
            return null;
        }

        $storagePath = Storage::disk('local')->path($path);
        $resolvedStoragePath = realpath($storagePath);

        return $resolvedStoragePath !== false && is_file($resolvedStoragePath) && is_readable($resolvedStoragePath)
            ? $resolvedStoragePath
            : null;
    }
}
