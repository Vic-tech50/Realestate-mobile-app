@extends('web.main')

@section('content')

<style>
    /* =========================================
       REGISTERED AGENTS PAGE
    ========================================= */

    .agents-page {
        background: #f6f8fb;
    }

    .page-header-modern {
        margin-bottom: 25px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 700;
        color: #17221a;
        margin-bottom: 5px;
    }

    .page-subtitle {
        color: #7b8794;
        font-size: 14px;
        margin-bottom: 0;
    }

    .breadcrumb-modern {
        background: transparent;
        padding: 0;
        margin: 0;
    }

    .breadcrumb-modern .breadcrumb-item {
        font-size: 13px;
    }

    .breadcrumb-modern a {
        color: #7b8794;
    }

    .breadcrumb-modern .active {
        color: #093411;
        font-weight: 600;
    }

    /* =========================================
       STAT CARDS
    ========================================= */

    .agent-stat-card {
        background: #fff;
        border: 0;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .045);
        height: 100%;
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        border-radius: 11px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 15px;
    }

    .stat-icon.green {
        background: #eaf7ed;
        color: #16803a;
    }

    .stat-icon.blue {
        background: #eaf2ff;
        color: #2563eb;
    }

    .stat-icon.orange {
        background: #fff4e5;
        color: #d97706;
    }

    .stat-icon.red {
        background: #fff0f0;
        color: #dc2626;
    }

    .stat-number {
        font-size: 25px;
        line-height: 1;
        font-weight: 700;
        color: #17221a;
        margin-bottom: 5px;
    }

    .stat-label {
        color: #87919a;
        font-size: 12px;
    }

    /* =========================================
       MAIN CARD
    ========================================= */

    .agents-card {
        background: #fff;
        border: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, .05);
    }

    .agents-card-header {
        padding: 23px 25px;
        border-bottom: 1px solid #edf0f2;
    }

    .agents-title {
        font-size: 18px;
        font-weight: 700;
        color: #17221a;
        margin-bottom: 4px;
    }

    .agents-description {
        color: #89949c;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* =========================================
       TABLE
    ========================================= */

    .agents-table-wrapper {
        padding: 0 10px 15px;
    }

    .agents-table {
        margin-bottom: 0 !important;
    }

    .agents-table thead th {
        background: #fafbfc;
        border-top: 0 !important;
        border-bottom: 1px solid #edf0f2 !important;
        color: #7b8794;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 15px 12px !important;
    }

    .agents-table tbody td {
        border-top: 1px solid #f0f2f4 !important;
        padding: 16px 12px !important;
        vertical-align: middle !important;
        color: #4a5560;
        font-size: 13px;
    }

    .agents-table tbody tr {
        transition: background .2s ease;
    }

    .agents-table tbody tr:hover {
        background: #fafcfb;
    }

    /* =========================================
       AGENT NAME
    ========================================= */

    .agent-info {
        display: flex;
        align-items: center;
        min-width: 190px;
    }

    .agent-avatar {
        width: 40px;
        height: 40px;
        min-width: 40px;
        border-radius: 50%;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        font-weight: 700;
        margin-right: 11px;
        text-transform: uppercase;
    }

    .agent-name {
        font-weight: 600;
        color: #25312a;
        margin-bottom: 2px;
        text-transform: capitalize;
    }

    .agent-label {
        font-size: 11px;
        color: #98a2a9;
    }

    /* =========================================
       STATUS BADGES
    ========================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 20px;
        padding: 6px 11px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-badge:before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-verified {
        background: #eaf7ed;
        color: #16803a;
    }

    .status-verified:before {
        background: #22c55e;
    }

    .status-unverified {
        background: #fff1f1;
        color: #dc2626;
    }

    .status-unverified:before {
        background: #ef4444;
    }

    /* =========================================
       ACTION BUTTON
    ========================================= */

    .agent-action-btn {
        width: 34px;
        height: 34px;
        border: 0;
        border-radius: 8px;
        background: #f5f7f6;
        color: #65716a;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all .2s ease;
    }

    .agent-action-btn:hover {
        background: #edf7ef;
        color: #093411;
    }

    .dropdown-menu {
        border: 0;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        padding: 7px;
    }

    .dropdown-menu .dropdown-item {
        border-radius: 7px;
        padding: 9px 12px;
        font-size: 13px;
    }

    .dropdown-menu .dropdown-item i {
        width: 20px;
        color: #7b8794;
    }

    .dropdown-menu .dropdown-item:hover {
        background: #edf7ef;
        color: #093411;
    }

    .dropdown-menu .dropdown-item:hover i {
        color: #093411;
    }

    .dropdown-menu .delete-item:hover {
        background: #fff1f1;
        color: #dc2626;
    }

    .dropdown-menu .delete-item:hover i {
        color: #dc2626;
    }

    /* =========================================
       EMPTY STATE
    ========================================= */

    .empty-state {
        padding: 70px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 15px;
    }

    .empty-state h6 {
        font-weight: 700;
        color: #27322c;
        margin-bottom: 6px;
    }

    .empty-state p {
        color: #98a2a9;
        font-size: 13px;
        margin: 0;
    }

    /* =========================================
       RESPONSIVE
    ========================================= */

    @media (max-width: 767px) {

        .page-title {
            font-size: 20px;
        }

        .breadcrumb-modern {
            margin-top: 12px;
        }

        .agent-stat-card {
            margin-bottom: 15px;
        }

        .agents-card-header {
            padding: 20px;
        }

        .agents-table-wrapper {
            overflow-x: auto;
        }

        .agents-table {
            min-width: 850px;
        }
    }
</style>

<div class="main-container agents-page">

<div class="pd-ltr-20 xs-pd-20-10">

    <div class="min-height-200px">

        {{-- =========================================
             PAGE HEADER
        ========================================== --}}
        <div class="page-header-modern">

            <div class="row align-items-center">

                <div class="col-md-7 col-sm-12">

                    <h4 class="page-title">
                        Registered Agents
                    </h4>

                    <p class="page-subtitle">
                        Manage, monitor and review all agents registered on the platform.
                    </p>

                </div>

                <div class="col-md-5 col-sm-12">

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb breadcrumb-modern justify-content-md-end">

                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.home') }}">
                                    Home
                                </a>
                            </li>

                            <li class="breadcrumb-item active">
                                Agents
                            </li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>


        {{-- =========================================
             STATISTICS
        ========================================== --}}
        <div class="row mb-30">

            {{-- Total Agents --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="agent-stat-card">

                    <div class="stat-icon green">
                        <i class="fa fa-users"></i>
                    </div>

                    <div class="stat-number">
                        {{ $agents->count() }}
                    </div>

                    <div class="stat-label">
                        Total Registered Agents
                    </div>

                </div>

            </div>


            {{-- Verified --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="agent-stat-card">

                    <div class="stat-icon blue">
                        <i class="fa fa-user-check"></i>
                    </div>

                    <div class="stat-number">
                        {{ $agents->where('verification_status', 'verified')->count() }}
                    </div>

                    <div class="stat-label">
                        Verified Agents
                    </div>

                </div>

            </div>


            {{-- Not Verified --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="agent-stat-card">

                    <div class="stat-icon red">
                        <i class="fa fa-user-times"></i>
                    </div>

                    <div class="stat-number">
                        {{ $agents->where('verification_status', '!=', 'verified')->count() }}
                    </div>

                    <div class="stat-label">
                        Pending Verification
                    </div>

                </div>

            </div>


            {{-- New Agents --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="agent-stat-card">

                    <div class="stat-icon orange">
                        <i class="fa fa-user-plus"></i>
                    </div>

                    <div class="stat-number">
                        {{ $agents->where('created_at', '>=', now()->startOfMonth())->count() }}
                    </div>

                    <div class="stat-label">
                        Registered This Month
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================
             AGENTS TABLE
        ========================================== --}}
        <div class="agents-card mb-30">

            <div class="agents-card-header">

                <h5 class="agents-title">
                    All Agents
                </h5>

                <p class="agents-description">
                    View and manage registered agents from one place.
                </p>

            </div>


            <div class="agents-table-wrapper">

                <table class="data-table table stripe hover nowrap agents-table">

                    <thead>

                        <tr>

                            <th class="table-plus datatable-nosort">
                                Agent
                            </th>

                            <th>
                                Email
                            </th>

                            <th>
                                Phone
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Member Since
                            </th>

                            <th class="datatable-nosort text-right">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($agents as $agent)

                            <tr>

                                {{-- Agent --}}
                                <td class="table-plus">

                                    <div class="agent-info">

                                        <div class="agent-avatar">

                                            {{ strtoupper(substr($agent->name, 0, 1)) }}

                                        </div>

                                        <div>

                                            <div class="agent-name">
                                                {{ $agent->name }}
                                            </div>

                                            <div class="agent-label">
                                                Registered Agent
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Email --}}
                                <td>

                                    <span>
                                        {{ $agent->email ?? 'Not provided' }}
                                    </span>

                                </td>


                                {{-- Phone --}}
                                <td>

                                    <span>
                                        {{ $agent->phone ?? 'Not provided' }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($agent->verification_status == 'verified')

                                        <span class="status-badge status-verified">
                                            Verified
                                        </span>

                                    @else

                                        <span class="status-badge status-unverified">
                                            Not Verified
                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div style="font-weight: 500; color:#4a5560;">

                                        {{ \Carbon\Carbon::parse($agent->created_at)->format('M j, Y') }}

                                    </div>

                                    <small class="text-muted">

                                        {{ \Carbon\Carbon::parse($agent->created_at)->diffForHumans() }}

                                    </small>

                                </td>


                                {{-- Actions --}}
                                <td class="text-right">

                                    <div class="dropdown">

                                        <button
                                            class="agent-action-btn dropdown-toggle"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >

                                            <i class="dw dw-more"></i>

                                        </button>


                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a
                                                class="dropdown-item"
                                                href="#"
                                            >
                                                <i class="dw dw-eye"></i>
                                                View Profile
                                            </a>


                                            <a
                                                class="dropdown-item"
                                                href="#"
                                            >
                                                <i class="dw dw-edit2"></i>
                                                Edit Agent
                                            </a>


                                            <div class="dropdown-divider"></div>


                                            <a
                                                class="dropdown-item delete-item"
                                                href="#"
                                            >
                                                <i class="dw dw-delete-3"></i>
                                                Delete Agent
                                            </a>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">

                                        <i class="fa fa-users"></i>

                                    </div>

                                    <h6>
                                        No registered agents
                                    </h6>

                                    <p>
                                        There are currently no agents registered in the system.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
