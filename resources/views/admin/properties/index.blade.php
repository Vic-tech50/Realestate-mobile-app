@extends('web.main')

@section('content')

<style>
    /* =========================================
       PROPERTIES PAGE
    ========================================= */

    .properties-page {
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
       STATISTICS
    ========================================= */

    .property-stat-card {
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

    .properties-card {
        background: #fff;
        border: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 25px rgba(0, 0, 0, .05);
    }

    .properties-card-header {
        padding: 23px 25px;
        border-bottom: 1px solid #edf0f2;
    }

    .properties-title {
        font-size: 18px;
        font-weight: 700;
        color: #17221a;
        margin-bottom: 4px;
    }

    .properties-description {
        color: #89949c;
        font-size: 13px;
        margin-bottom: 0;
    }

    /* =========================================
       TABLE
    ========================================= */

    .properties-table-wrapper {
        padding: 0 10px 15px;
    }

    .properties-table {
        margin-bottom: 0 !important;
    }

    .properties-table thead th {
        background: #fafbfc;
        border-top: 0 !important;
        border-bottom: 1px solid #edf0f2 !important;
        color: #7b8794;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        padding: 15px 12px !important;
        white-space: nowrap;
    }

    .properties-table tbody td {
        border-top: 1px solid #f0f2f4 !important;
        padding: 14px 12px !important;
        vertical-align: middle !important;
        color: #4a5560;
        font-size: 13px;
    }

    .properties-table tbody tr {
        transition: background .2s ease;
    }

    .properties-table tbody tr:hover {
        background: #fafcfb;
    }

    /* =========================================
       PROPERTY IMAGE
    ========================================= */

    .property-image {
        width: 75px;
        height: 58px;
        border-radius: 9px;
        object-fit: cover;
        display: block;
        background: #f1f4f2;
    }

    .property-image-placeholder {
        width: 75px;
        height: 58px;
        border-radius: 9px;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* =========================================
       PROPERTY DETAILS
    ========================================= */

    .property-info {
        min-width: 190px;
    }

    .property-title {
        font-weight: 700;
        color: #25312a;
        margin-bottom: 4px;
        max-width: 240px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .property-id {
        font-size: 11px;
        color: #98a2a9;
    }

    .property-type {
        font-weight: 600;
        color: #334155;
        margin-bottom: 3px;
    }

    .listing-type {
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        color: #16803a;
        background: #eaf7ed;
        padding: 4px 8px;
        border-radius: 5px;
        text-transform: capitalize;
    }

    /* =========================================
       LOCATION
    ========================================= */

    .property-location {
        min-width: 180px;
        max-width: 230px;
        line-height: 1.5;
    }

    .location-main {
        font-weight: 500;
        color: #475569;
        margin-bottom: 3px;
    }

    .location-state {
        color: #98a2a9;
        font-size: 11px;
    }

    /* =========================================
       PRICE
    ========================================= */

    .property-price {
        font-size: 14px;
        font-weight: 700;
        color: #093411;
        white-space: nowrap;
    }

    /* =========================================
       STATUS
    ========================================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 20px;
        padding: 6px 11px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge:before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .status-approved {
        background: #eaf7ed;
        color: #16803a;
    }

    .status-approved:before {
        background: #22c55e;
    }

    .status-pending {
        background: #fff4e5;
        color: #b45309;
    }

    .status-pending:before {
        background: #f59e0b;
    }

    .status-rejected {
        background: #fff0f0;
        color: #dc2626;
    }

    .status-rejected:before {
        background: #ef4444;
    }

    /* =========================================
       DATE
    ========================================= */

    .property-date {
        white-space: nowrap;
    }

    .property-date-main {
        color: #475569;
        font-weight: 500;
    }

    .property-date-relative {
        font-size: 11px;
        color: #98a2a9;
        margin-top: 2px;
    }

    /* =========================================
       ACTIONS
    ========================================= */

    .property-action-btn {
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

    .property-action-btn:hover {
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
        padding: 75px 20px !important;
        text-align: center;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: #edf7ef;
        color: #093411;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 16px;
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

        .property-stat-card {
            margin-bottom: 15px;
        }

        .properties-card-header {
            padding: 20px;
        }

        .properties-table-wrapper {
            overflow-x: auto;
        }

        .properties-table {
            min-width: 1150px;
        }
    }
</style>

<div class="main-container properties-page">


<div class="pd-ltr-20 xs-pd-20-10">

    <div class="min-height-200px">

        {{-- =========================================
             PAGE HEADER
        ========================================== --}}
        <div class="page-header-modern">

            <div class="row align-items-center">

                <div class="col-md-7 col-sm-12">

                    <h4 class="page-title">
                        Properties
                    </h4>

                    <p class="page-subtitle">
                        Manage, review and monitor all properties listed on the platform.
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
                                Properties
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

            {{-- Total --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="property-stat-card">

                    <div class="stat-icon green">
                        <i class="fa fa-building"></i>
                    </div>

                    <div class="stat-number">
                        {{ $properties->count() }}
                    </div>

                    <div class="stat-label">
                        Total Properties
                    </div>

                </div>

            </div>


            {{-- Approved --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="property-stat-card">

                    <div class="stat-icon blue">
                        <i class="fa fa-check-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $properties->where('status', 'active')->count() }}
                    </div>

                    <div class="stat-label">
                        Approved Properties
                    </div>

                </div>

            </div>


            {{-- Pending --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="property-stat-card">

                    <div class="stat-icon orange">
                        <i class="fa fa-clock"></i>
                    </div>

                    <div class="stat-number">
                        {{ $properties->where('status', 'pending')->count() }}
                    </div>

                    <div class="stat-label">
                        Pending Review
                    </div>

                </div>

            </div>


            {{-- Rejected --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-15">

                <div class="property-stat-card">

                    <div class="stat-icon red">
                        <i class="fa fa-times-circle"></i>
                    </div>

                    <div class="stat-number">
                        {{ $properties->where('status', 'rejected')->count() }}
                    </div>

                    <div class="stat-label">
                        Rejected Properties
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================
             PROPERTIES TABLE
        ========================================== --}}
        <div class="properties-card mb-30">

            <div class="properties-card-header">

                <h5 class="properties-title">
                    Property Listings
                </h5>

                <p class="properties-description">
                    View property details, pricing, location and approval status.
                </p>

            </div>


            <div class="properties-table-wrapper">

                <table class="data-table table stripe hover nowrap properties-table">

                    <thead>

                        <tr>

                            <th>
                                Property
                            </th>

                            <th class="datatable-nosort">
                                Image
                            </th>

                            <th>
                                Type
                            </th>

                            <th>
                                Location
                            </th>

                            <th>
                                Price
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date Added
                            </th>

                            <th class="datatable-nosort text-right">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse ($properties as $property)

                            <tr>

                                {{-- Property --}}
                                <td class="table-plus">

                                    <div class="property-info">

                                        <div class="property-title">

                                            {{ $property->title }}

                                        </div>

                                        <div class="property-id">

                                            ID: #{{ $property->property_id }}

                                        </div>

                                    </div>

                                </td>


                                {{-- Image --}}
                                <td>

                                    @if ($property->thumbnail)

                                        <img
                                            src="{{ $property->thumbnail }}"
                                            alt="{{ $property->title }}"
                                            class="property-image"
                                        >

                                    @else

                                        <img
                                            src="https://picsum.photos/seed/property-{{ $property->id }}/800/600"
                                            alt="{{ $property->title }}"
                                            class="property-image"
                                        >

                                    @endif

                                </td>


                                {{-- Type --}}
                                <td>

                                    <div class="property-type">
                                        {{ $property->type }}
                                    </div>

                                    @if($property->listing_type)

                                        <span class="listing-type">
                                            {{ $property->listing_type }}
                                        </span>

                                    @endif

                                </td>


                                {{-- Location --}}
                                <td>

                                    <div class="property-location">

                                        <div class="location-main">

                                            <i class="fa fa-map-marker-alt mr-1"
                                               style="color:#093411;">
                                            </i>

                                            {{ $property->address }}

                                        </div>

                                        <div class="location-state">

                                            {{ $property->city }},
                                            {{ $property->state }}

                                        </div>

                                    </div>

                                </td>


                                {{-- Price --}}
                                <td>

                                    <div class="property-price">

                                        ₦{{ number_format($property->price, 2) }}

                                    </div>

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($property->status === 'active')

                                        <span class="status-badge status-approved">
                                            Approved
                                        </span>

                                    @elseif($property->status === 'pending')

                                        <span class="status-badge status-pending">
                                            Pending
                                        </span>

                                    @else

                                        <span class="status-badge status-rejected">
                                            Rejected
                                        </span>

                                    @endif

                                </td>


                                {{-- Date --}}
                                <td>

                                    <div class="property-date">

                                        <div class="property-date-main">

                                            {{ \Carbon\Carbon::parse($property->created_at)->format('M j, Y') }}

                                        </div>

                                        <div class="property-date-relative">

                                            {{ \Carbon\Carbon::parse($property->created_at)->diffForHumans() }}

                                        </div>

                                    </div>

                                </td>


                                {{-- Actions --}}
                                <td class="text-right">

                                    <div class="dropdown">

                                        <button
                                            class="property-action-btn dropdown-toggle"
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
                                                View Property
                                            </a>


                                            <a
                                                class="dropdown-item"
                                                href="#"
                                            >
                                                <i class="dw dw-edit2"></i>
                                                Edit Property
                                            </a>


                                            <div class="dropdown-divider"></div>


                                            <a
                                                class="dropdown-item delete-item"
                                                href="#"
                                            >
                                                <i class="dw dw-delete-3"></i>
                                                Delete Property
                                            </a>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="empty-state"
                                >

                                    <div class="empty-icon">

                                        <i class="fa fa-building"></i>

                                    </div>

                                    <h6>
                                        No Properties Found
                                    </h6>

                                    <p>
                                        There are currently no properties listed in the system.
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
