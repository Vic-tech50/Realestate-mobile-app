```blade
@extends('web.main')

@section('title', 'Create Agent')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- Page Header --}}
        <div class="page-header mb-30">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h4 class="font-weight-700 mb-5">Create New Agent</h4>
                    <p class="text-muted mb-0">
                        Register a new property agent on your platform.
                    </p>
                </div>

                <div class="col-md-5 text-md-right mt-3 mt-md-0">
                    <a href="{{ route('agents.index') }}"
                       class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left mr-1"></i>
                        Back to Agents
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

        <form action="{{ route('agents.store') }}" method="POST">
            @csrf

            <div class="row">

                {{-- Main Form --}}
                <div class="col-lg-8 col-md-7">

                    {{-- Personal Information --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-2">
                            <i class="fa fa-user text-success mr-2"></i>
                            Personal Information
                        </h5>

                        <p class="text-muted mb-4">
                            Enter the agent's basic contact information.
                        </p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name">
                                    Full Name <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Enter agent's full name"
                                    required
                                    autocomplete="name"
                                >

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email">
                                    Email Address <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    placeholder="agent@example.com"
                                    required
                                    autocomplete="email"
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
                                    value="{{ old('phone') }}"
                                    placeholder="Enter phone number"
                                    autocomplete="tel"
                                >

                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address">Residential Address</label>

                                <input
                                    type="text"
                                    name="address"
                                    id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address') }}"
                                    placeholder="Enter address"
                                    autocomplete="street-address"
                                >

                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Account Credentials --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-2">
                            <i class="fa fa-lock text-success mr-2"></i>
                            Account Credentials
                        </h5>

                        <p class="text-muted mb-4">
                            Create the login password for the new agent.
                        </p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password">
                                    Password <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Minimum 8 characters"
                                    required
                                    minlength="8"
                                    autocomplete="new-password"
                                >

                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Re-enter password"
                                    required
                                    minlength="8"
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
                        <h5 class="font-weight-700 mb-2">
                            <i class="fa fa-shield-alt text-success mr-2"></i>
                            Account Status
                        </h5>

                        <p class="text-muted mb-4">
                            Choose whether the agent can access the platform.
                        </p>

                        <label for="is_blocked">Initial Status</label>

                        <select
                            name="is_blocked"
                            id="is_blocked"
                            class="form-control @error('is_blocked') is-invalid @enderror"
                            required
                        >
                            <option value="0"
                                {{ old('is_blocked', '0') === '0' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="1"
                                {{ old('is_blocked') === '1' ? 'selected' : '' }}>
                                Blocked
                            </option>
                        </select>

                        @error('is_blocked')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <small class="text-muted d-block mt-2">
                            New agents are active by default.
                        </small>
                    </div>

                    {{-- Role Information --}}
                    <div class="card-box pd-30 mb-30">
                        <h5 class="font-weight-700 mb-3">
                            <i class="fa fa-id-badge text-success mr-2"></i>
                            Agent Role
                        </h5>

                        <div class="p-3 rounded bg-light">
                            <div class="d-flex align-items-center">
                                <i class="fa fa-user-tie text-success mr-3"
                                   style="font-size:26px;"></i>

                                <div>
                                    <strong>Property Agent</strong>
                                    <small class="text-muted d-block">
                                        Standard agent account
                                    </small>
                                </div>
                            </div>
                        </div>

                        <small class="text-muted d-block mt-3">
                            The role is assigned automatically to prevent an
                            administrator from accidentally creating another admin.
                        </small>
                    </div>

                    {{-- Form Actions --}}
                    <div class="card-box pd-30 mb-30">
                        <button type="submit" class="btn btn-success btn-block mb-3">
                            <i class="fa fa-user-plus mr-1"></i>
                            Create Agent
                        </button>

                        <a href="{{ route('agents.index') }}"
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
```