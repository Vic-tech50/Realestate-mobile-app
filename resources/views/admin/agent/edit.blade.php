
@extends('web.main')

@section('title', 'Edit Agent')

@section('content')

<style>
    .card-box {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .card-box h5 {
        font-size: 1rem;
        font-weight: bold;
    }

    .card-box label {
        /* font-weight: 600; */
        font-size: 0.9rem;
    }

    .card-box small {
        font-size: 0.875rem;
    }

    .btn-block {
        width: 100%;
    }
    input{
        font-size: 0.9rem;
    }

    </style>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- Page Header --}}
        <div class="page-header mb-30">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h4 class="font-weight-700 mb-5">Edit Agent</h4>
                    <p class="text-muted mb-0">
                        Update the agent's profile and account information.
                    </p>
                </div>

                <div class="col-md-5 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('agents.show', $agent->id) }}"
                       class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left mr-1"></i>
                        Back to Agent Details
                    </a>
                </div>
            </div>
        </div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please correct the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('agents.update', $agent->id) }}"
              method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- Main Form --}}
                <div class="col-lg-8 col-md-7">

                    {{-- Personal Information --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-4">
                            <i class="fa fa-user text-success mr-2"></i>
                            Personal Information
                        </h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $agent->name) }}"
                                    placeholder="Enter full name"
                                    required
                                >
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $agent->email) }}"
                                    placeholder="Enter email address"
                                    required
                                >
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone Number</label>
                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $agent->phone) }}"
                                    placeholder="Enter phone number"
                                >
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $agent->address) }}"
                                    placeholder="Enter residential address"
                                >
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-2">
                            <i class="fa fa-lock text-success mr-2"></i>
                            Change Password
                        </h5>

                        <p class="text-muted mb-4">
                            Leave these fields empty if you do not want to change the password.
                        </p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">New Password</label>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password"
                                    autocomplete="new-password"
                                >
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    autocomplete="new-password"
                                >
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="col-lg-4 col-md-5">

                    {{-- Account Status --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-4">
                            <i class="fa fa-shield-alt text-success mr-2"></i>
                            Account Status
                        </h5>

                        <label for="role">Agent Access</label>

                        <select
                            name="role"
                            id="role"
                            class="form-control @error('role') is-invalid @enderror"
                        >
                            <option value="agent"
                                {{ (string) old('role', (string) ($agent->role ?? 'agent')) === 'agent' ? 'selected' : '' }}>
                                Active — Can Access Platform
                            </option>

                            <option value="blocked"
                                {{ (string) old('role', (string) ($agent->role ?? 'blocked')) === 'blocked' ? 'selected' : '' }}>
                                Blocked — Access Restricted
                            </option>
                        </select>

                        @error('is_blocked')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            Ensure your authentication logic enforces blocked status.
                        </small>
                    </div>

                    {{-- Agent Summary --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-3">Agent Summary</h5>

                        <div class="mb-3">
                            <small class="text-muted d-block">Agent ID</small>
                            <strong>#{{ $agent->id }}</strong>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">Registered</small>
                            <strong>
                                {{ $agent->created_at?->format('d M Y') ?? 'N/A' }}
                            </strong>
                        </div>

                        <div class="mb-0">
                            <small class="text-muted d-block">Last Updated</small>
                            <strong>
                                {{ $agent->updated_at?->format('d M Y') ?? 'N/A' }}
                            </strong>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="card-box pd-30 mb-30">
                        <button type="submit" class="btn btn-success btn-block mb-3">
                            <i class="fa fa-save mr-1"></i>
                            Save Changes
                        </button>

                        <a href="{{ route('agents.show', $agent->id) }}"
                           class="btn btn-outline-secondary btn-block">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection
