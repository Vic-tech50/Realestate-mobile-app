@extends('web.main')

@section('title', $property->title)

@section('content')

<style>
    .property-page {
        padding-bottom: 40px;
    }

    /* Header */
    .property-header {
        margin-bottom: 20px;
    }

    .property-header h4 {
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .property-id {
        font-size: 13px;
        color: #8a94a6;
    }

    .property-actions .btn {
        border-radius: 8px;
        font-weight: 600;
        margin-left: 5px;
    }

    /* Hero */
    .property-hero {
        position: relative;
        height: 430px;
        border-radius: 14px;
        overflow: hidden;
        background: #eef1f5;
        margin-bottom: 20px;
    }

    .property-hero img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-hero-overlay {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 30px;
        color: #fff;
        background: linear-gradient(
            to top,
            rgba(0, 0, 0, .75),
            rgba(0, 0, 0, .05)
        );
    }

    .property-hero-overlay h2 {
        color: #fff;
        font-weight: 800;
        margin-bottom: 8px;
        font-size: 28px;
    }

    .property-location {
        font-size: 14px;
        color: rgba(255, 255, 255, .85);
    }

    .property-location i {
        margin-right: 5px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 7px 13px;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
        margin-bottom: 12px;
    }

    .status-available {
        background: #dff7e8;
        color: #198754;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-sold {
        background: #f8d7da;
        color: #842029;
    }

    .status-rented {
        background: #dbeafe;
        color: #1d4ed8;
    }

    /* Price */
    .price-card {
        background: #fff;
        border-radius: 14px;
        padding: 22px;
        border: 1px solid #edf0f4;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .04);
        margin-bottom: 20px;
    }

    .price-label {
        font-size: 12px;
        color: #8a94a6;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: .4px;
        margin-bottom: 7px;
    }

    .property-price {
        font-size: 26px;
        font-weight: 800;
        color: #0d6efd;
        margin-bottom: 4px;
    }

    .price-period {
        font-size: 13px;
        color: #8a94a6;
    }

    /* Stats */
    .property-stat {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 12px;
        padding: 18px 15px;
        text-align: center;
        height: 100%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, .03);
    }

    .property-stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 19px;
    }

    .property-stat-value {
        font-size: 18px;
        font-weight: 800;
        color: #273142;
        margin-bottom: 3px;
    }

    .property-stat-label {
        font-size: 11px;
        color: #929baa;
        text-transform: uppercase;
        font-weight: 600;
    }

    /* Cards */
    .property-card {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .property-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        font-weight: 800;
        color: #273142;
        margin-bottom: 22px;
    }

    .property-card-title .title-icon {
        width: 35px;
        height: 35px;
        border-radius: 9px;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Information rows */
    .info-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        padding: 13px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .info-row:last-child {
        border-bottom: 0;
    }

    .info-label {
        color: #8a94a6;
        font-size: 13px;
    }

    .info-value {
        color: #303846;
        font-size: 13px;
        font-weight: 600;
        text-align: right;
    }

    /* Amenities */
    .amenity-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 7px;
        background: #f4f7fb;
        color: #4b5563;
        font-size: 12px;
        font-weight: 600;
        margin: 0 6px 8px 0;
    }

    .amenity-badge i {
        color: #0d6efd;
        margin-right: 6px;
    }

    /* Description */
    .property-description {
        color: #697386;
        font-size: 14px;
        line-height: 1.9;
        margin-bottom: 0;
        white-space: pre-line;
    }

    /* Agent */
    .agent-box {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .agent-avatar {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        object-fit: cover;
        background: #eef1f5;
    }

    .agent-name {
        font-size: 14px;
        font-weight: 700;
        color: #273142;
        margin-bottom: 3px;
    }

    .agent-role {
        font-size: 12px;
        color: #929baa;
    }

    /* Gallery */
    .gallery-image {
        width: 100%;
        height: 190px;
        object-fit: cover;
        border-radius: 10px;
        transition: transform .2s ease;
    }

    .gallery-item {
        overflow: hidden;
        border-radius: 10px;
        background: #f2f4f7;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.03);
    }

    .empty-image {
        height: 430px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f4f6f8;
        color: #9aa3b2;
        border-radius: 14px;
    }

    .empty-image i {
        font-size: 45px;
        margin-bottom: 10px;
    }

    /* Responsive */
    @media (max-width: 767px) {

        .property-actions {
            margin-top: 15px;
        }

        .property-actions .btn {
            margin-left: 0;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .property-header {
            display: block !important;
        }

        .property-hero {
            height: 330px;
        }

        .property-hero-overlay {
            padding: 20px;
        }

        .property-hero-overlay h2 {
            font-size: 22px;
        }

        .property-card {
            padding: 18px;
        }

        .info-row {
            display: block;
        }

        .info-value {
            text-align: left;
            margin-top: 4px;
        }
    }
</style>


<div class="main-container property-page">

    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- ========================================
             PAGE HEADER
        ========================================= --}}
        <div class="property-header d-flex justify-content-between align-items-center">

            <div>
                <h4>
                    {{ $property->title }}
                </h4>

                <div class="property-id">
                    Property ID:
                    <strong>{{ $property->property_id }}</strong>
                </div>
            </div>

            <div class="property-actions">

                <a href="{{ route('properties.edit', $property) }}"
                   class="btn btn-primary">
                    <i class="icon-copy dw dw-edit2 mr-1"></i>
                    Edit Property
                </a>

                <a href="{{ route('properties.index') }}"
                   class="btn btn-outline-secondary">
                    <i class="icon-copy dw dw-left-arrow2 mr-1"></i>
                    Back
                </a>

            </div>

        </div>


        {{-- ========================================
             HERO SECTION
        ========================================= --}}
        <div class="property-hero">

            @if ($property->thumbnail)

                <img
                    src="{{ $property->thumbnail }}"
                    alt="{{ $property->title }}"
                >

                <div class="property-hero-overlay">

                    @php
                        $statusClass = match($property->status) {
                            'available' => 'status-available',
                            'pending' => 'status-pending',
                            'sold' => 'status-sold',
                            'rented' => 'status-rented',
                            default => 'status-pending',
                        };
                    @endphp

                    <span class="status-badge {{ $statusClass }}">
                        {{ ucfirst($property->status) }}
                    </span>

                    <h2>
                        {{ $property->title }}
                    </h2>

                    <div class="property-location">
                        <i class="icon-copy dw dw-map-1"></i>

                        {{ $property->address }},
                        {{ $property->city }},
                        {{ $property->state }}
                    </div>

                </div>

            @else

                <div class="empty-image">
                    <div class="text-center">

                        <i class="icon-copy dw dw-building"></i>

                        <p class="mb-0">
                            No property image available
                        </p>

                    </div>
                </div>

            @endif

        </div>


        <div class="row">

            {{-- ========================================
                 LEFT COLUMN
            ========================================= --}}
            <div class="col-lg-8">


                {{-- PRICE --}}
                <div class="price-card">

                    <div class="price-label">
                        Property Price
                    </div>

                    <div class="property-price">
                        ₦{{ number_format($property->price) }}
                    </div>

                    <div class="price-period">
                        {{ ucfirst(str_replace('_', ' ', $property->price_period)) }}
                    </div>

                </div>


                {{-- QUICK STATS --}}
                <div class="row mb-20">

                    <div class="col-6 col-md-3 mb-15">
                        <div class="property-stat">

                            <div class="property-stat-icon">
                                <i class="icon-copy dw dw-house"></i>
                            </div>

                            <div class="property-stat-value">
                                {{ $property->bedrooms }}
                            </div>

                            <div class="property-stat-label">
                                Bedrooms
                            </div>

                        </div>
                    </div>


                    <div class="col-6 col-md-3 mb-15">
                        <div class="property-stat">

                            <div class="property-stat-icon">
                                <i class="icon-copy dw dw-bathroom"></i>
                            </div>

                            <div class="property-stat-value">
                                {{ $property->bathrooms }}
                            </div>

                            <div class="property-stat-label">
                                Bathrooms
                            </div>

                        </div>
                    </div>


                    <div class="col-6 col-md-3 mb-15">
                        <div class="property-stat">

                            <div class="property-stat-icon">
                                <i class="icon-copy dw dw-toilet"></i>
                            </div>

                            <div class="property-stat-value">
                                {{ $property->toilets }}
                            </div>

                            <div class="property-stat-label">
                                Toilets
                            </div>

                        </div>
                    </div>


                    <div class="col-6 col-md-3 mb-15">
                        <div class="property-stat">

                            <div class="property-stat-icon">
                                <i class="icon-copy dw dw-car"></i>
                            </div>

                            <div class="property-stat-value">
                                {{ $property->garage }}
                            </div>

                            <div class="property-stat-label">
                                Parking
                            </div>

                        </div>
                    </div>

                </div>


                {{-- PROPERTY DETAILS --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-building"></i>
                        </span>

                        Property Details

                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Property Type
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->type) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Listing Type
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->listing_type) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Property Size
                        </span>

                        <span class="info-value">
                            {{ number_format($property->size) }}
                            {{ $property->size_unit }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Status
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->status) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Property ID
                        </span>

                        <span class="info-value">
                            {{ $property->property_id }}
                        </span>
                    </div>

                </div>


                {{-- DESCRIPTION --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-file-60"></i>
                        </span>

                        Description

                    </div>

                    <p class="property-description">
                        {{ $property->description ?: 'No description provided for this property.' }}
                    </p>

                </div>


                {{-- AMENITIES --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-star"></i>
                        </span>

                        Amenities

                    </div>


                    @if (!empty($property->amenities))

                        @foreach ($property->amenities as $amenity)

                            <span class="amenity-badge">
                                <i class="icon-copy dw dw-check"></i>
                                {{ $amenity }}
                            </span>

                        @endforeach

                    @else

                        <span class="text-muted small">
                            No amenities listed.
                        </span>

                    @endif

                </div>


                {{-- GALLERY --}}
                @if (!empty($property->images))

                    <div class="property-card">

                        <div class="property-card-title">

                            <span class="title-icon">
                                <i class="icon-copy dw dw-picture"></i>
                            </span>

                            Property Gallery

                        </div>


                        <div class="row">

                            @foreach ($property->images as $image)

                                <div class="col-md-4 col-sm-6 mb-15">

                                    <div class="gallery-item">

                                        <img
                                            src="{{ $image }}"
                                            alt="{{ $property->title }}"
                                            class="gallery-image"
                                        >

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                @endif

            </div>


            {{-- ========================================
                 RIGHT COLUMN
            ========================================= --}}
            <div class="col-lg-4">


                {{-- LOCATION --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-map-1"></i>
                        </span>

                        Location

                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Address
                        </span>

                        <span class="info-value">
                            {{ $property->address }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            City
                        </span>

                        <span class="info-value">
                            {{ $property->city }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            State
                        </span>

                        <span class="info-value">
                            {{ $property->state }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Country
                        </span>

                        <span class="info-value">
                            {{ $property->country }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Landmark
                        </span>

                        <span class="info-value">
                            {{ $property->landmark ?: 'Not provided' }}
                        </span>
                    </div>

                </div>


                {{-- AGENT --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-user1"></i>
                        </span>

                        Property Agent

                    </div>


                    @if ($property->user)

                        <div class="agent-box">

                            <img
                                src="{{ $property->user->profile_photo_url ?? asset('vendors/images/photo1.jpg') }}"
                                alt="{{ $property->user->name }}"
                                class="agent-avatar"
                            >

                            <div>

                                <div class="agent-name">
                                    {{ $property->user->name }}
                                </div>

                                <div class="agent-role">
                                    Property Agent
                                </div>

                            </div>

                        </div>

                    @else

                        <div class="text-muted small">
                            No agent assigned to this property.
                        </div>

                    @endif

                </div>


                {{-- LISTING SUMMARY --}}
                <div class="property-card">

                    <div class="property-card-title">

                        <span class="title-icon">
                            <i class="icon-copy dw dw-info"></i>
                        </span>

                        Listing Summary

                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Type
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->type) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            For
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->listing_type) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Price
                        </span>

                        <span class="info-value">
                            ₦{{ number_format($property->price) }}
                        </span>
                    </div>


                    <div class="info-row">
                        <span class="info-label">
                            Status
                        </span>

                        <span class="info-value">
                            {{ ucfirst($property->status) }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection