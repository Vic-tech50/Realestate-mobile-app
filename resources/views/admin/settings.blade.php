@extends('web.main')

@section('title', 'Settings')

@section('content')

<style>
    .settings-page {
        padding-bottom: 50px;
    }

    /* Header */
    .settings-header {
        margin-bottom: 25px;
    }

    .settings-header h4 {
        font-size: 24px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .settings-header p {
        color: #8a94a6;
        font-size: 13px;
        margin: 0;
    }

    /* Settings Navigation */
    .settings-nav {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        padding: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
        margin-bottom: 20px;
    }

    .settings-nav-item {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        border: 0;
        background: transparent;
        padding: 12px 14px;
        border-radius: 9px;
        color: #697386;
        font-size: 13px;
        font-weight: 600;
        text-align: left;
        cursor: pointer;
        transition: .2s ease;
        margin-bottom: 3px;
    }

    .settings-nav-item:last-child {
        margin-bottom: 0;
    }

    .settings-nav-item:hover {
        background: #f5f8fc;
        color: #0d6efd;
    }

    .settings-nav-item.active {
        background: #eef5ff;
        color: #0d6efd;
    }

    .settings-nav-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6f9;
        font-size: 15px;
    }

    .settings-nav-item.active .settings-nav-icon {
        background: #fff;
        color: #0d6efd;
    }

    /* Card */
    .settings-card {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .settings-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 18px;
        margin-bottom: 23px;
        border-bottom: 1px solid #f0f2f5;
    }

    .settings-card-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .settings-card-header h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 800;
        color: #273142;
    }

    .settings-card-header p {
        margin: 3px 0 0;
        color: #929baa;
        font-size: 11px;
    }

    /* Forms */
    .settings-label {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #465064;
        margin-bottom: 7px;
    }

    .settings-input,
    .settings-select {
        width: 100%;
        height: 45px;
        border: 1px solid #e2e6ed;
        border-radius: 8px;
        background: #fafbfc;
        padding: 0 13px;
        color: #303846;
        font-size: 13px;
        transition: .2s ease;
    }

    .settings-input:focus,
    .settings-select:focus {
        outline: none;
        background: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
    }

    .settings-textarea {
        width: 100%;
        min-height: 100px;
        border: 1px solid #e2e6ed;
        border-radius: 8px;
        background: #fafbfc;
        padding: 12px 13px;
        color: #303846;
        font-size: 13px;
        resize: vertical;
    }

    .settings-textarea:focus {
        outline: none;
        background: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
    }

    .form-help {
        display: block;
        margin-top: 6px;
        font-size: 11px;
        color: #9aa3b2;
    }

    /* Toggle */
    .setting-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 16px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .setting-row:first-child {
        padding-top: 0;
    }

    .setting-row:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .setting-title {
        font-size: 13px;
        font-weight: 700;
        color: #303846;
        margin-bottom: 3px;
    }

    .setting-description {
        font-size: 11px;
        color: #929baa;
        line-height: 1.6;
    }

    .switch {
        position: relative;
        width: 45px;
        height: 24px;
        flex-shrink: 0;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch-slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        background: #d8dde5;
        border-radius: 30px;
        transition: .2s ease;
    }

    .switch-slider:before {
        content: "";
        position: absolute;
        width: 18px;
        height: 18px;
        left: 3px;
        top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: .2s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, .15);
    }

    .switch input:checked + .switch-slider {
        background: #0d6efd;
    }

    .switch input:checked + .switch-slider:before {
        transform: translateX(21px);
    }

    /* Profile */
    .profile-box {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 20px;
        margin-bottom: 20px;
        border-bottom: 1px solid #f0f2f5;
    }

    .profile-avatar {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eef5ff;
    }

    .profile-name {
        font-size: 15px;
        font-weight: 800;
        color: #273142;
        margin-bottom: 3px;
    }

    .profile-role {
        font-size: 11px;
        color: #929baa;
    }

    /* Security */
    .security-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .security-item:last-child {
        border-bottom: 0;
    }

    .security-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .security-icon {
        width: 38px;
        height: 38px;
        background: #f4f7fb;
        color: #0d6efd;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .security-title {
        font-size: 13px;
        font-weight: 700;
        color: #303846;
    }

    .security-description {
        font-size: 11px;
        color: #929baa;
        margin-top: 3px;
    }

    /* Save */
    .save-bar {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .save-info strong {
        display: block;
        color: #273142;
        font-size: 13px;
        margin-bottom: 3px;
    }

    .save-info span {
        color: #929baa;
        font-size: 11px;
    }

    .save-bar .btn {
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 18px;
    }

    @media (max-width: 767px) {

        .settings-card {
            padding: 18px;
        }

        .settings-header h4 {
            font-size: 21px;
        }

        .setting-row {
            align-items: flex-start;
        }

        .save-bar {
            display: block;
        }

        .save-bar .btn {
            margin-top: 15px;
        }
    }
</style>


<div class="main-container settings-page">

    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- PAGE HEADER --}}
        <div class="settings-header">

            <h4>
                Settings
            </h4>

            <p>
                Manage your account, application and platform preferences.
            </p>

        </div>


        <div class="row">

            {{-- =====================================
                 SETTINGS MENU
            ====================================== --}}
            <div class="col-lg-3">

                <div class="settings-nav">

                    <button
                        type="button"
                        class="settings-nav-item active"
                        onclick="showSettings('general', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-settings"></i>
                        </span>

                        General Settings
                    </button>


                    <button
                        type="button"
                        class="settings-nav-item"
                        onclick="showSettings('profile', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-user1"></i>
                        </span>

                        Profile
                    </button>


                    <button
                        type="button"
                        class="settings-nav-item"
                        onclick="showSettings('notifications', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-notification"></i>
                        </span>

                        Notifications
                    </button>


                    <button
                        type="button"
                        class="settings-nav-item"
                        onclick="showSettings('property', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-building"></i>
                        </span>

                        Property Settings
                    </button>


                    <button
                        type="button"
                        class="settings-nav-item"
                        onclick="showSettings('security', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-padlock1"></i>
                        </span>

                        Security
                    </button>


                    <button
                        type="button"
                        class="settings-nav-item"
                        onclick="showSettings('system', this)"
                    >
                        <span class="settings-nav-icon">
                            <i class="icon-copy dw dw-computer"></i>
                        </span>

                        System
                    </button>

                </div>

            </div>


            {{-- =====================================
                 SETTINGS CONTENT
            ====================================== --}}
            <div class="col-lg-9">


                {{-- =====================================
                     GENERAL SETTINGS
                ====================================== --}}
                <div id="settings-general" class="settings-section">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-settings"></i>
                            </div>

                            <div>
                                <h5>General Settings</h5>

                                <p>
                                    Basic information about your platform
                                </p>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Application Name
                                    </label>

                                    <input
                                        type="text"
                                        name="app_name"
                                        class="settings-input"
                                        value="{{ config('app.name') }}"
                                        placeholder="Application name"
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Support Email
                                    </label>

                                    <input
                                        type="email"
                                        name="support_email"
                                        class="settings-input"
                                        placeholder="support@example.com"
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Phone Number
                                    </label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="settings-input"
                                        placeholder="+234 800 000 0000"
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Website
                                    </label>

                                    <input
                                        type="url"
                                        name="website"
                                        class="settings-input"
                                        placeholder="https://example.com"
                                    >

                                </div>

                            </div>


                            <div class="col-md-12">

                                <div class="form-group mb-0">

                                    <label class="settings-label">
                                        Business Address
                                    </label>

                                    <textarea
                                        name="address"
                                        class="settings-textarea"
                                        placeholder="Enter your business address"
                                    ></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     PROFILE
                ====================================== --}}
                <div id="settings-profile"
                     class="settings-section"
                     style="display:none;">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-user1"></i>
                            </div>

                            <div>
                                <h5>Administrator Profile</h5>

                                <p>
                                    Update your personal account information
                                </p>
                            </div>

                        </div>


                        <div class="profile-box">

                            <img
                                src="{{ auth()->user()->profile_photo_url ?? asset('vendors/images/photo1.jpg') }}"
                                class="profile-avatar"
                                alt="Profile"
                            >

                            <div>

                                <div class="profile-name">
                                    {{ auth()->user()->name }}
                                </div>

                                <div class="profile-role">
                                    Administrator
                                </div>

                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="settings-input"
                                        value="{{ auth()->user()->name }}"
                                    >

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="settings-input"
                                        value="{{ auth()->user()->email }}"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     NOTIFICATIONS
                ====================================== --}}
                <div id="settings-notifications"
                     class="settings-section"
                     style="display:none;">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-notification"></i>
                            </div>

                            <div>
                                <h5>Notifications</h5>

                                <p>
                                    Control how you receive system notifications
                                </p>
                            </div>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    Email Notifications
                                </div>

                                <div class="setting-description">
                                    Receive important platform updates by email.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="email_notifications"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    New Property Notifications
                                </div>

                                <div class="setting-description">
                                    Get notified when a new property is added.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="property_notifications"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    New Agent Notifications
                                </div>

                                <div class="setting-description">
                                    Receive notifications when a new agent registers.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="agent_notifications"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    System Alerts
                                </div>

                                <div class="setting-description">
                                    Receive important system and security alerts.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="system_alerts"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     PROPERTY SETTINGS
                ====================================== --}}
                <div id="settings-property"
                     class="settings-section"
                     style="display:none;">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-building"></i>
                            </div>

                            <div>
                                <h5>Property Settings</h5>

                                <p>
                                    Configure default property preferences
                                </p>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Default Currency
                                    </label>

                                    <select
                                        name="currency"
                                        class="settings-select"
                                    >

                                        <option value="NGN">
                                            Nigerian Naira (₦)
                                        </option>

                                        <option value="USD">
                                            US Dollar ($)
                                        </option>

                                        <option value="GBP">
                                            British Pound (£)
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Default Country
                                    </label>

                                    <select
                                        name="country"
                                        class="settings-select"
                                    >

                                        <option value="Nigeria">
                                            Nigeria
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Default Property Status
                                    </label>

                                    <select
                                        name="property_status"
                                        class="settings-select"
                                    >

                                        <option value="pending">
                                            Pending
                                        </option>

                                        <option value="available">
                                            Available
                                        </option>

                                    </select>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-group mb-20">

                                    <label class="settings-label">
                                        Default Size Unit
                                    </label>

                                    <select
                                        name="size_unit"
                                        class="settings-select"
                                    >

                                        <option value="sqm">
                                            Square Metres (sqm)
                                        </option>

                                        <option value="sqft">
                                            Square Feet (sqft)
                                        </option>

                                        <option value="plot">
                                            Plot
                                        </option>

                                        <option value="acre">
                                            Acre
                                        </option>

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     SECURITY
                ====================================== --}}
                <div id="settings-security"
                     class="settings-section"
                     style="display:none;">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-padlock1"></i>
                            </div>

                            <div>
                                <h5>Security</h5>

                                <p>
                                    Protect your administrator account
                                </p>
                            </div>

                        </div>


                        <div class="security-item">

                            <div class="security-left">

                                <div class="security-icon">
                                    <i class="dw dw-padlock1"></i>
                                </div>

                                <div>

                                    <div class="security-title">
                                        Change Password
                                    </div>

                                    <div class="security-description">
                                        Update your administrator password.
                                    </div>

                                </div>

                            </div>

                            <a href="#"
                               class="btn btn-outline-primary btn-sm">
                                Change
                            </a>

                        </div>


                        <div class="security-item">

                            <div class="security-left">

                                <div class="security-icon">
                                    <i class="dw dw-shield"></i>
                                </div>

                                <div>

                                    <div class="security-title">
                                        Two-Factor Authentication
                                    </div>

                                    <div class="security-description">
                                        Add an extra layer of security to your account.
                                    </div>

                                </div>

                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="two_factor"
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="security-item">

                            <div class="security-left">

                                <div class="security-icon">
                                    <i class="dw dw-computer"></i>
                                </div>

                                <div>

                                    <div class="security-title">
                                        Login Activity
                                    </div>

                                    <div class="security-description">
                                        Review recent account login activity.
                                    </div>

                                </div>

                            </div>

                            <a href="#"
                               class="btn btn-outline-secondary btn-sm">
                                View
                            </a>

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     SYSTEM
                ====================================== --}}
                <div id="settings-system"
                     class="settings-section"
                     style="display:none;">

                    <div class="settings-card">

                        <div class="settings-card-header">

                            <div class="settings-card-icon">
                                <i class="icon-copy dw dw-computer"></i>
                            </div>

                            <div>
                                <h5>System Settings</h5>

                                <p>
                                    Configure system behaviour
                                </p>
                            </div>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    Maintenance Mode
                                </div>

                                <div class="setting-description">
                                    Temporarily prevent users from accessing the platform.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="maintenance_mode"
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    User Registration
                                </div>

                                <div class="setting-description">
                                    Allow new users and agents to register.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="user_registration"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>


                        <div class="setting-row">

                            <div>
                                <div class="setting-title">
                                    Property Listings
                                </div>

                                <div class="setting-description">
                                    Allow properties to be published on the platform.
                                </div>
                            </div>

                            <label class="switch">

                                <input
                                    type="checkbox"
                                    name="property_listings"
                                    checked
                                >

                                <span class="switch-slider"></span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- SAVE BAR --}}
        <div class="save-bar">

            <div class="save-info">

                <strong>
                    Save your settings
                </strong>

                <span>
                    Changes will take effect after saving.
                </span>

            </div>

            <button
                type="submit"
                class="btn btn-primary"
            >
                <i class="icon-copy dw dw-save mr-1"></i>
                Save Changes
            </button>

        </div>

    </div>

</div>


<script>
    function showSettings(section, button) {

        // Hide all sections
        document.querySelectorAll('.settings-section').forEach(function (item) {
            item.style.display = 'none';
        });

        // Show selected section
        const selected = document.getElementById('settings-' + section);

        if (selected) {
            selected.style.display = 'block';
        }

        // Remove active state
        document.querySelectorAll('.settings-nav-item').forEach(function (item) {
            item.classList.remove('active');
        });

        // Add active state
        button.classList.add('active');
    }
</script>

@endsection