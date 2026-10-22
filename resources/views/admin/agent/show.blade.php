
@extends('web.main')

@section('title', 'Agent Details')

@section('content')
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- Page Header --}}
        <div class="page-header mb-30">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h4 class="font-weight-700 mb-5">Agent Details</h4>
                    <p class="text-muted mb-0">
                        View agent information and manage their account.
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

        {{-- Success / Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="row">

            {{-- Agent Profile --}}
            <div class="col-lg-4 col-md-5 mb-30">
                <div class="card-box height-100-p pd-30">

                    <div class="text-center">
                        @php
                            $avatar = $agent->avatar
                                ?? $agent->profile_photo_path
                                ?? null;
                        @endphp

                        @if($avatar)
                            <img
                                src="{{ \Illuminate\Support\Str::startsWith($avatar, ['http://', 'https://']) ? $avatar : asset('storage/' . ltrim($avatar, '/')) }}"
                                alt="{{ $agent->name }}"
                                class="rounded-circle mb-3"
                                style="width:120px;height:120px;object-fit:cover;"
                            >
                        @else
                            <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center mb-3"
                                 style="width:120px;height:120px;">
                                <i class="fa fa-user text-secondary" style="font-size:50px;"></i>
                            </div>
                        @endif

                        <h4 class="font-weight-700 mb-1">
                            {{ $agent->name }}
                        </h4>

                        <p class="text-muted mb-3">
                            {{ $agent->email }}
                        </p>

                        @if($agent->is_blocked ?? false)
                            <span class="badge badge-danger px-3 py-2">
                                <i class="fa fa-ban mr-1"></i> Blocked Account
                            </span>
                        @else
                            <span class="badge badge-success px-3 py-2">
                                <i class="fa fa-check-circle mr-1"></i> Active Account
                            </span>
                        @endif
                    </div>

                    <hr>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Agent ID</small>
                        <strong>#{{ $agent->id }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Phone Number</small>
                        <strong>{{ $agent->phone ?: 'Not provided' }}</strong>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted d-block mb-1">Account Type</small>
                        <strong>{{ ucfirst($agent->role ?? 'Agent') }}</strong>
                    </div>

                    <div class="mb-0">
                        <small class="text-muted d-block mb-1">Registration Date</small>
                        <strong>
                            {{ $agent->created_at?->format('d M Y, h:i A') ?? 'Not available' }}
                        </strong>
                    </div>
                </div>
            </div>

            {{-- Agent Information and Actions --}}
            <div class="col-lg-8 col-md-7 mb-30">

                {{-- Personal Information --}}
                <div class="card-box pd-30 mb-30">
                    <h5 class="font-weight-700 mb-4">
                        <i class="fa fa-user-circle text-success mr-2"></i>
                        Personal Information
                    </h5>

                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Full Name</small>
                            <strong>{{ $agent->name ?: 'Not provided' }}</strong>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Email Address</small>
                            <strong>{{ $agent->email ?: 'Not provided' }}</strong>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Phone Number</small>
                            <strong>{{ $agent->phone ?: 'Not provided' }}</strong>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Account Status</small>
                            <strong>
                                {{ ($agent->is_blocked ?? false) ? 'Blocked' : 'Active' }}
                            </strong>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Registered On</small>
                            <strong>
                                {{ $agent->created_at?->format('d F Y') ?? 'Not available' }}
                            </strong>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <small class="text-muted d-block mb-1">Last Updated</small>
                            <strong>
                                {{ $agent->updated_at?->format('d F Y') ?? 'Not available' }}
                            </strong>
                        </div>

                        <div class="col-12">
                            <small class="text-muted d-block mb-1">Address</small>
                            <strong>{{ $agent->address ?: 'No address provided' }}</strong>
                        </div>
                    </div>
                </div>

                {{-- Account Management --}}
                <div class="card-box pd-30 mb-30">
                    <h5 class="font-weight-700 mb-2">
                        <i class="fa fa-cog text-success mr-2"></i>
                        Account Management
                    </h5>

                    <p class="text-muted mb-4">
                        Manage this agent's access to the platform.
                    </p>

                    <div class="d-flex flex-wrap" style="gap:10px;">

                        {{-- Block Agent {{ route('admin.agents.block', $agent->id) }} --}}
                        @if(!($agent->role === 'blocked'))
                            <form action="{{ route('agents.block', $agent->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to block this agent?');">
                                @csrf

                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-ban mr-1"></i>
                                    Block Agent
                                </button>
                            </form>
                        @else
                            {{-- Unblock Agent {{ route('admin.agents.unblock', $agent->id) }} --}}
                            <form action="{{ route('agents.unblock', $agent->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Do you want to unblock this agent?');">
                                @csrf

                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-unlock mr-1"></i>
                                    Unblock Agent
                                </button>
                            </form>
                        @endif

                        {{-- Delete Agent {{ route('admin.agents.destroy', $agent->id) }} --}}
                        <form action="{{ route('agents.destroy', $agent->id) }} "
                              method="POST"
                              onsubmit="return confirm('WARNING: This will permanently delete this agent account. This action may not be reversible. Continue?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash mr-1"></i>
                                Delete Agent
                            </button>
                        </form>

                    </div>

                    <div class="alert alert-warning mt-4 mb-0">
                        <i class="fa fa-exclamation-triangle mr-1"></i>
                        <strong>Important:</strong>
                        Blocking should prevent the agent from accessing the platform.
                        Deleting may also affect related property listings and records,
                        depending on your database relationships.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection