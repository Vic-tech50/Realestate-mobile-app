@php
    $status = $user?->verification_status ?? 'unverified';
    $isVerified = $status === 'verified';
    $isRejected = $status === 'rejected';
    $isPending = $status === 'pending';

    $statusLabel = match ($status) {
        'verified' => 'Verified',
        'pending' => 'Under review',
        'rejected' => 'Action required',
        default => 'Not verified',
    };

    $documentLabel = match ($user?->verification_document_type) {
        'national_id' => 'National ID / NIN',
        'passport' => 'International Passport',
        'voters_card' => "Voter's Card",
        default => 'Identification Document',
    };
@endphp

<native:scroll-view class="flex-1 bg-theme-background">
    <native:column class="w-full gap-5 p-5">
        <native:column class="gap-1">
            <native:text class="text-sm font-medium text-theme-primary">
                ACCOUNT SECURITY
            </native:text>

            <native:text class="text-3xl font-bold text-theme-on-background dark:text-white">
                Identity verification
            </native:text>

            <native:text class="text-sm text-theme-on-surface-variant">
                Keep your account trusted and ready for property listings.
            </native:text>
        </native:column>

        <native:column class="w-full gap-5 rounded-2xl bg-theme-surface p-5">
            <native:row class="w-full items-center justify-between">
                <native:row class="items-center gap-3">
                    @if ($isVerified)
                        <native:column class="h-14 w-14 items-center justify-center rounded-full bg-green-100">
                            <native:icon icon="verified" size="28" class="text-green-600" />
                        </native:column>
                    @elseif ($isPending)
                        <native:column class="h-14 w-14 items-center justify-center rounded-full bg-orange-100">
                            <native:icon icon="schedule" size="28" class="text-orange-600" />
                        </native:column>
                    @elseif ($isRejected)
                        <native:column class="h-14 w-14 items-center justify-center rounded-full bg-red-100">
                            <native:icon icon="error" size="28" class="text-red-600" />
                        </native:column>
                    @else
                        <native:column class="h-14 w-14 items-center justify-center rounded-full bg-theme-primary/15">
                            <native:icon icon="badge" size="28" class="text-theme-primary" />
                        </native:column>
                    @endif

                    <native:column class="gap-1">
                        <native:text class="text-lg font-bold text-theme-on-surface">
                            @if ($isVerified)
                                Identity verified
                            @elseif ($isPending)
                                Verification pending
                            @elseif ($isRejected)
                                Verification rejected
                            @else
                                Identity not verified
                            @endif
                        </native:text>

                        <native:text class="text-sm text-theme-on-surface-variant">
                            {{ $statusLabel }}
                        </native:text>
                    </native:column>
                </native:row>
            </native:row>

            <native:column class="gap-2 rounded-xl bg-theme-surface-variant p-4">
                <native:text class="text-sm leading-5 text-theme-on-surface-variant">
                    @if ($isVerified)
                        Your identity has been confirmed. You can now add properties to your account.
                    @elseif ($isPending)
                        Your document has been submitted and is waiting for admin review.
                    @elseif ($isRejected)
                        {{ $user?->verification_rejection_reason ?? 'Your document could not be verified. Please submit a new document.' }}
                    @else
                        Verify your identity before adding properties to your account.
                    @endif
                </native:text>
            </native:column>
        </native:column>

        @if ($user?->verification_document_type)
            <native:column class="w-full gap-4 rounded-2xl bg-theme-surface p-5">
                <native:text class="text-lg font-bold text-theme-on-surface">
                    Submitted document
                </native:text>

                <native:row class="items-center justify-between border-b border-theme-outline pb-4">
                    <native:text class="text-sm text-theme-on-surface-variant">
                        Document type
                    </native:text>

                    <native:text class="text-sm font-semibold text-theme-on-surface">
                        {{ $documentLabel }}
                    </native:text>
                </native:row>

                <native:row class="items-center justify-between">
                    <native:text class="text-sm text-theme-on-surface-variant">
                        Review status
                    </native:text>

                    <native:text class="text-sm font-semibold text-theme-primary">
                        {{ $statusLabel }}
                    </native:text>
                </native:row>
            </native:column>
        @endif

        @if ($isVerified || $isRejected || $status === 'unverified')
            <native:column class="w-full gap-3 rounded-2xl bg-theme-primary p-5">
                <native:text class="text-lg font-bold text-theme-on-primary">
                    {{ $isVerified ? 'Ready to list?' : 'Complete your verification' }}
                </native:text>

                <native:text class="text-sm text-theme-on-primary">
                    {{ $isVerified ? 'Start adding properties to your account.' : 'Submit your identity document to continue.' }}
                </native:text>

                @if ($isVerified)
                    <native:button label="Add Property" @press="addProperty" />
                @else
                    <native:button label="{{ $isRejected ? 'Submit New Document' : 'Verify My Identity' }}" @press="resubmit" />
                @endif
            </native:column>
        @endif
    </native:column>
</native:scroll-view>
