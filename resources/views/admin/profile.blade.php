@extends('web.main')

@section('content')

<style>
    /* =========================================
       PROFILE PAGE
    ========================================= */

    .profile-page {
        background: #f6f8fb;
    }

    .profile-card {
        border: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }

    /* Left Profile Card */
    .profile-sidebar {
        background: #ffffff;
        text-align: center;
        padding: 35px 25px;
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 18px;
    }

    .profile-avatar {
        width: 125px;
        height: 125px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #f1f5f3;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.10);
    }

    .profile-online {
        position: absolute;
        width: 16px;
        height: 16px;
        background: #22c55e;
        border: 3px solid #fff;
        border-radius: 50%;
        right: 7px;
        bottom: 10px;
    }

    .profile-name {
        font-size: 21px;
        font-weight: 700;
        color: #17221a;
        margin-bottom: 5px;
    }

    .profile-role {
        font-size: 13px;
        color: #718096;
        margin-bottom: 25px;
    }

    .contact-title {
        font-size: 15px;
        font-weight: 700;
        color: #093411;
        text-align: left;
        padding-bottom: 12px;
        border-bottom: 1px solid #edf0ee;
        margin-bottom: 5px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f2f1;
        text-align: left;
    }

    .contact-item:last-child {
        border-bottom: 0;
    }

    .contact-icon {
        min-width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
    }

    .contact-label {
        display: block;
        font-size: 11px;
        color: #94a3a8;
        margin-bottom: 2px;
        text-transform: uppercase;
        letter-spacing: .3px;
    }

    .contact-value {
        display: block;
        font-size: 13px;
        color: #334155;
        word-break: break-word;
    }

    /* Right Content */
    .profile-content {
        background: #fff;
        min-height: 100%;
    }

    /* Tabs */
    .profile-tabs {
        display: flex;
        padding: 0 25px;
        border-bottom: 1px solid #edf0f2;
        background: #fff;
    }

    .profile-tabs .nav-link {
        position: relative;
        border: 0 !important;
        border-radius: 0;
        padding: 20px 22px;
        color: #7b8794;
        font-size: 14px;
        font-weight: 600;
        background: transparent;
    }

    .profile-tabs .nav-link i {
        margin-right: 7px;
    }

    .profile-tabs .nav-link.active {
        color: #093411;
        background: transparent;
    }

    .profile-tabs .nav-link.active:after {
        content: "";
        position: absolute;
        left: 18px;
        right: 18px;
        bottom: -1px;
        height: 3px;
        background: #093411;
        border-radius: 4px 4px 0 0;
    }

    /* Tab Content */
    .profile-tab-content {
        padding: 35px;
    }

    .section-heading {
        display: flex;
        align-items: center;
        margin-bottom: 28px;
    }

    .section-heading-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
    }

    .section-heading h5 {
        margin: 0;
        color: #17221a;
        font-weight: 700;
    }

    .section-heading p {
        margin: 3px 0 0;
        color: #8a959c;
        font-size: 12px;
    }

    /* Form */
    .modern-form-group {
        margin-bottom: 22px;
    }

    .modern-form-group label {
        font-size: 13px;
        font-weight: 600;
        color: #344054;
        margin-bottom: 8px;
    }

    .modern-input {
        height: 48px !important;
        border: 1px solid #e1e6e3 !important;
        border-radius: 9px !important;
        background: #fbfcfc !important;
        padding: 10px 14px !important;
        font-size: 14px !important;
        transition: all .2s ease;
    }

    .modern-input:focus {
        background: #fff !important;
        border-color: #093411 !important;
        box-shadow: 0 0 0 3px rgba(9, 52, 17, .08) !important;
    }

    .modern-input::placeholder {
        color: #a5adb3;
    }

    textarea.modern-input {
        height: auto !important;
    }

    /* Password */
    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        border: 0;
        background: transparent;
        color: #89949c;
        cursor: pointer;
    }

    /* Buttons */
    .modern-btn {
        min-height: 46px;
        border: 0;
        border-radius: 9px;
        padding: 10px 22px;
        background: #093411;
        color: #fff;
        font-weight: 600;
        transition: all .2s ease;
    }

    .modern-btn:hover {
        background: #0d4d19;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 7px 18px rgba(9, 52, 17, .15);
    }

    /* Alerts */
    .modern-alert {
        border: 0;
        border-radius: 10px;
        padding: 14px 17px;
        margin-bottom: 25px;
    }

    /* Upload */
    .upload-area {
        border: 2px dashed #dce5df;
        border-radius: 14px;
        padding: 35px 20px;
        text-align: center;
        background: #fbfdfb;
    }

    .upload-preview {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .10);
        margin-bottom: 18px;
    }

    .upload-label {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 8px;
        background: #edf7ef;
        color: #093411;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
    }

    .upload-label:hover {
        background: #dcefe0;
    }

    .upload-input {
        display: none;
    }

    /* Responsive */
    @media (max-width: 767px) {

        .profile-tabs {
            padding: 0 10px;
            overflow-x: auto;
            white-space: nowrap;
        }

        .profile-tabs .nav-link {
            padding: 16px 13px;
            font-size: 13px;
        }

        .profile-tabs .nav-link.active:after {
            left: 10px;
            right: 10px;
        }

        .profile-tab-content {
            padding: 22px 18px;
        }

        .profile-sidebar {
            padding: 28px 20px;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
        }
    }
</style>

<div class="main-container profile-page">


<div class="pd-ltr-20 xs-pd-20-10">

    {{-- PAGE HEADER --}}
    <div class="page-header mb-30">
        <div class="row align-items-center">

            <div class="col-md-7">
                <h4 class="mb-1" style="font-weight: 700; color:#17221a;">
                    My Profile
                </h4>

                <p class="text-muted mb-0">
                    Manage your account information and security settings.
                </p>
            </div>

            <div class="col-md-5">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-md-end mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Home</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Profile
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>


    <div class="row">

        {{-- =====================================
             LEFT PROFILE SIDEBAR
        ====================================== --}}
        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-30">

            <div class="profile-card profile-sidebar">

                <div class="profile-avatar-wrapper">

                    @if(Auth::user()->passport != null)

                        <img
                            src="{{ asset('uploads/teachers/' . Auth::user()->passport) }}"
                            alt="{{ Auth::user()->name }}"
                            class="profile-avatar"
                        >

                    @else

                        <img
                            src="{{ asset('vendors/images/person.svg') }}"
                            alt="Profile"
                            class="profile-avatar"
                        >

                    @endif

                    <span class="profile-online"></span>

                </div>

                <h4 class="profile-name">
                    {{ Auth::user()->name }}
                </h4>

                <p class="profile-role">
                    <i class="fa fa-shield-alt mr-1"></i>
                    Administrator
                </p>


                {{-- Contact Information --}}
                <div class="text-left">

                    <h6 class="contact-title">
                        Contact Information
                    </h6>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa fa-envelope"></i>
                        </div>

                        <div>
                            <span class="contact-label">Email</span>
                            <span class="contact-value">
                                {{ Auth::user()->email }}
                            </span>
                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa fa-phone"></i>
                        </div>

                        <div>
                            <span class="contact-label">Phone</span>
                            <span class="contact-value">
                                {{ Auth::user()->phone ?? 'Not Provided' }}
                            </span>
                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa fa-venus-mars"></i>
                        </div>

                        <div>
                            <span class="contact-label">Gender</span>
                            <span class="contact-value">
                                {{ Auth::user()->gender ?? 'Not Provided' }}
                            </span>
                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa fa-calendar"></i>
                        </div>

                        <div>
                            <span class="contact-label">Date of Birth</span>
                            <span class="contact-value">
                                {{ Auth::user()->dob ?? 'Not Provided' }}
                            </span>
                        </div>

                    </div>


                    <div class="contact-item">

                        <div class="contact-icon">
                            <i class="fa fa-map-marker-alt"></i>
                        </div>

                        <div>
                            <span class="contact-label">Address</span>
                            <span class="contact-value">
                                {{ Auth::user()->address ?? 'Not Provided' }}
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================
             RIGHT CONTENT
        ====================================== --}}
        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 mb-30">

            <div class="profile-card profile-content">

                {{-- TABS --}}
                <ul class="nav nav-tabs profile-tabs" role="tablist">

                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            data-toggle="tab"
                            href="#timeline"
                            role="tab"
                        >
                            <i class="fa fa-user"></i>
                            Profile
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-toggle="tab"
                            href="#setting"
                            role="tab"
                        >
                            <i class="fa fa-lock"></i>
                            Security
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-toggle="tab"
                            href="#passport"
                            role="tab"
                        >
                            <i class="fa fa-camera"></i>
                            Photo
                        </a>
                    </li>

                </ul>


                <div class="tab-content">


                    {{-- =====================================
                         PROFILE TAB
                    ====================================== --}}
                    <div
                        class="tab-pane fade show active"
                        id="timeline"
                        role="tabpanel"
                    >

                        <div class="profile-tab-content">

                            {{-- Success --}}
                            @if(session('message'))

                                <div class="alert alert-success modern-alert alert-dismissible fade show">

                                    <i class="fa fa-check-circle mr-2"></i>

                                    {{ session('message') }}

                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >
                                        <span>&times;</span>
                                    </button>

                                </div>

                            @endif


                            {{-- Error --}}
                            @if(session('error'))

                                <div class="alert alert-danger modern-alert alert-dismissible fade show">

                                    <i class="fa fa-exclamation-circle mr-2"></i>

                                    {{ session('error') }}

                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >
                                        <span>&times;</span>
                                    </button>

                                </div>

                            @endif


                            <div class="section-heading">

                                <div class="section-heading-icon">
                                    <i class="fa fa-user"></i>
                                </div>

                                <div>
                                    <h5>Personal Information</h5>
                                    <p>Update your basic account information.</p>
                                </div>

                            </div>


                            <form action="{{ route('update.profile') }}" method="POST">

                                @csrf

                                <div class="row">

                                    {{-- Name --}}
                                    <div class="col-md-6">

                                        <div class="modern-form-group">

                                            <label>
                                                Full Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ Auth::user()->name }}"
                                                class="form-control modern-input"
                                                placeholder="Enter your full name"
                                            >

                                        </div>

                                    </div>


                                    {{-- Email --}}
                                    <div class="col-md-6">

                                        <div class="modern-form-group">

                                            <label>
                                                Email Address
                                            </label>

                                            <input
                                                type="email"
                                                name="email"
                                                value="{{ Auth::user()->email }}"
                                                class="form-control modern-input"
                                                placeholder="Enter your email"
                                            >

                                        </div>

                                    </div>


                                    {{-- Phone --}}
                                    <div class="col-md-6">

                                        <div class="modern-form-group">

                                            <label>
                                                Phone Number
                                            </label>

                                            <input
                                                type="text"
                                                name="phone"
                                                value="{{ Auth::user()->phone }}"
                                                class="form-control modern-input"
                                                placeholder="Enter your phone number"
                                            >

                                        </div>

                                    </div>

                                </div>


                                <div class="text-right mt-2">

                                    <button
                                        type="submit"
                                        class="modern-btn"
                                    >
                                        <i class="fa fa-save mr-2"></i>
                                        Save Changes
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- =====================================
                         SECURITY TAB
                    ====================================== --}}
                    <div
                        class="tab-pane fade"
                        id="setting"
                        role="tabpanel"
                    >

                        <div class="profile-tab-content">

                            <div class="section-heading">

                                <div class="section-heading-icon">
                                    <i class="fa fa-lock"></i>
                                </div>

                                <div>
                                    <h5>Security Settings</h5>
                                    <p>Keep your account secure with a strong password.</p>
                                </div>

                            </div>


                            <form action="{{ route('update.password') }}" method="POST">

                                @csrf

                                {{-- Current Password --}}
                                <div class="modern-form-group">

                                    <label>
                                        Current Password
                                    </label>

                                    <div class="password-wrapper">

                                        <input
                                            type="password"
                                            name="current_password"
                                            class="form-control modern-input"
                                            placeholder="Enter your current password"
                                            id="current_password"
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            onclick="togglePassword('current_password', this)"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </button>

                                    </div>

                                    @error('current_password')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- New Password --}}
                                <div class="modern-form-group">

                                    <label>
                                        New Password
                                    </label>

                                    <div class="password-wrapper">

                                        <input
                                            type="password"
                                            name="password"
                                            class="form-control modern-input"
                                            placeholder="Enter your new password"
                                            id="password"
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            onclick="togglePassword('password', this)"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </button>

                                    </div>

                                    @error('password')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                {{-- Confirm Password --}}
                                <div class="modern-form-group">

                                    <label>
                                        Confirm New Password
                                    </label>

                                    <div class="password-wrapper">

                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            class="form-control modern-input"
                                            placeholder="Confirm your new password"
                                            id="password_confirmation"
                                        >

                                        <button
                                            type="button"
                                            class="password-toggle"
                                            onclick="togglePassword('password_confirmation', this)"
                                        >
                                            <i class="fa fa-eye"></i>
                                        </button>

                                    </div>

                                    @error('password_confirmation')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror

                                </div>


                                <div class="text-right mt-4">

                                    <button
                                        type="submit"
                                        class="modern-btn"
                                    >
                                        <i class="fa fa-shield-alt mr-2"></i>
                                        Update Password
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>


                    {{-- =====================================
                         PHOTO TAB
                    ====================================== --}}
                    <div
                        class="tab-pane fade"
                        id="passport"
                        role="tabpanel"
                    >

                        <div class="profile-tab-content">

                            <div class="section-heading">

                                <div class="section-heading-icon">
                                    <i class="fa fa-camera"></i>
                                </div>

                                <div>
                                    <h5>Profile Photo</h5>
                                    <p>Upload a clear image to personalize your profile.</p>
                                </div>

                            </div>


                            <form
                                action=""
                                method="POST"
                                enctype="multipart/form-data"
                            >

                                @csrf

                                <div class="upload-area">

                                    @if(Auth::user()->passport != null)

                                        <img
                                            src="{{ asset('uploads/teachers/' . Auth::user()->passport) }}"
                                            id="im"
                                            class="upload-preview"
                                            alt="Profile Photo"
                                        >

                                    @else

                                        <img
                                            src="{{ asset('vendors/images/person.svg') }}"
                                            id="im"
                                            class="upload-preview"
                                            alt="Profile Photo"
                                        >

                                    @endif


                                    <h6 class="font-weight-bold mb-1">
                                        Upload a new profile photo
                                    </h6>

                                    <p class="text-muted small mb-3">
                                        JPG, PNG or JPEG. Recommended square image.
                                    </p>


                                    <label
                                        for="fileid"
                                        class="upload-label"
                                    >
                                        <i class="fa fa-cloud-upload-alt mr-2"></i>
                                        Choose Image
                                    </label>

                                    <input
                                        type="file"
                                        name="image"
                                        accept="image/*"
                                        id="fileid"
                                        class="upload-input"
                                        onchange="loadImageFileAsURL();"
                                    >

                                    <div class="mt-4">

                                        <button
                                            type="submit"
                                            class="modern-btn"
                                        >
                                            <i class="fa fa-upload mr-2"></i>
                                            Upload Photo
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

<script>

    function togglePassword(inputId, button) {

        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {

            input.type = 'text';

            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');

        } else {

            input.type = 'password';

            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');

        }

    }


    function loadImageFileAsURL() {

        const file = document.getElementById('fileid').files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            document.getElementById('im').src = e.target.result;

        };

        reader.readAsDataURL(file);

    }

</script>

@endsection
