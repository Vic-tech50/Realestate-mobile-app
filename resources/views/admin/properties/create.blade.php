@extends('web.main')

@section('title', 'Add Property')

@section('content')

<div class="main-container">

<div class="pd-ltr-20 xs-pd-20-10">

    {{-- =========================
         PAGE HEADER
    ========================== --}}
    <div class="page-header mb-20">

        <div class="row align-items-center">

            <div class="col-md-8">

                <h4 class="mb-5 font-weight-700">
                    Add New Property
                </h4>

                <p class="text-muted mb-0">
                    Add a new property to the platform.
                </p>

            </div>

            <div class="col-md-4 text-md-right mt-15 mt-md-0">

                <a href="{{ route('properties.index') }}"
                    class="btn btn-outline-secondary">

                    <i class="dw dw-left-arrow-2 mr-1"></i>

                    Back to Properties

                </a>

            </div>

        </div>

    </div>


    {{-- Validation Errors --}}

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>
                Please fix the following errors:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form method="POST"
        action="{{ route('properties.store') }}"
        enctype="multipart/form-data">

        @csrf


        <div class="row">

            {{-- =====================================================
                 LEFT COLUMN
            ====================================================== --}}

            <div class="col-lg-8">


                {{-- =========================
                     PROPERTY INFORMATION
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-building text-primary mr-2"></i>

                            Property Information

                        </h5>

                        <p class="text-muted mb-0 font-12">
                            Enter the basic information about the property.
                        </p>

                    </div>


                    <div class="pd-20">

                        <div class="row">

                            {{-- Property Title --}}

                            <div class="col-md-12 mb-20">

                                <label class="font-weight-600">
                                    Property Title
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="title"
                                    value="{{ old('title') }}"
                                    class="form-control"
                                    placeholder="e.g. Modern 4 Bedroom Duplex">

                                @error('title')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            {{-- Property Type --}}

                            <div class="col-md-6 mb-20">

                                <label class="font-weight-600">
                                    Property Type
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="type"
                                    class="custom-select">

                                    <option value="">
                                        Select property type
                                    </option>

                                    <option value="house"
                                        {{ old('type') == 'house' ? 'selected' : '' }}>
                                        House
                                    </option>

                                    <option value="apartment"
                                        {{ old('type') == 'apartment' ? 'selected' : '' }}>
                                        Apartment
                                    </option>

                                    <option value="land"
                                        {{ old('type') == 'land' ? 'selected' : '' }}>
                                        Land
                                    </option>

                                    <option value="office"
                                        {{ old('type') == 'office' ? 'selected' : '' }}>
                                        Office
                                    </option>

                                    <option value="shop"
                                        {{ old('type') == 'shop' ? 'selected' : '' }}>
                                        Shop
                                    </option>

                                    <option value="warehouse"
                                        {{ old('type') == 'warehouse' ? 'selected' : '' }}>
                                        Warehouse
                                    </option>

                                </select>

                                @error('type')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>


                            {{-- Listing Type --}}

                            <div class="col-md-6 mb-20">

                                <label class="font-weight-600">
                                    Listing Type
                                    <span class="text-danger">*</span>
                                </label>

                                <select name="listing_type"
                                    class="custom-select">

                                    <option value="">
                                        Select listing type
                                    </option>

                                    <option value="sale"
                                        {{ old('listing_type') == 'sale' ? 'selected' : '' }}>
                                        For Sale
                                    </option>

                                    <option value="rent"
                                        {{ old('listing_type') == 'rent' ? 'selected' : '' }}>
                                        For Rent
                                    </option>

                                    <option value="lease"
                                        {{ old('listing_type') == 'lease' ? 'selected' : '' }}>
                                        For Lease
                                    </option>

                                </select>

                            </div>


                            {{-- Description --}}

                            <div class="col-md-12 mb-10">

                                <label class="font-weight-600">
                                    Description
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    name="description"
                                    rows="6"
                                    class="form-control"
                                    placeholder="Describe the property, its condition, surroundings and other important information...">{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================
                     LOCATION
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-map text-primary mr-2"></i>

                            Property Location

                        </h5>

                        <p class="text-muted mb-0 font-12">
                            Provide the property's exact location.
                        </p>

                    </div>


                    <div class="pd-20">

                        <div class="row">

                            <div class="col-md-12 mb-20">

                                <label class="font-weight-600">
                                    Address
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="address"
                                    value="{{ old('address') }}"
                                    class="form-control"
                                    placeholder="e.g. 15 Ikot Ekpene Road">

                            </div>


                            <div class="col-md-6 mb-20">

                                <label class="font-weight-600">
                                    City
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="city"
                                    value="{{ old('city') }}"
                                    class="form-control"
                                    placeholder="e.g. Uyo">

                            </div>


                            <div class="col-md-6 mb-20">

                                <label class="font-weight-600">
                                    State
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text"
                                    name="state"
                                    value="{{ old('state') }}"
                                    class="form-control"
                                    placeholder="e.g. Akwa Ibom">

                            </div>


                            <div class="col-md-6">

                                <label class="font-weight-600">
                                    Country
                                </label>

                                <input type="text"
                                    name="country"
                                    value="{{ old('country', 'Nigeria') }}"
                                    class="form-control">

                            </div>


                            <div class="col-md-6">

                                <label class="font-weight-600">
                                    Landmark
                                </label>

                                <input type="text"
                                    name="landmark"
                                    value="{{ old('landmark') }}"
                                    class="form-control"
                                    placeholder="Nearby landmark">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================
                     PROPERTY FEATURES
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-house text-primary mr-2"></i>

                            Property Features

                        </h5>

                        <p class="text-muted mb-0 font-12">
                            Add the major features of the property.
                        </p>

                    </div>


                    <div class="pd-20">

                        <div class="row">

                            {{-- Bedrooms --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Bedrooms
                                </label>

                                <input type="number"
                                    name="bedrooms"
                                    value="{{ old('bedrooms') }}"
                                    min="0"
                                    class="form-control"
                                    placeholder="0">

                            </div>


                            {{-- Bathrooms --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Bathrooms
                                </label>

                                <input type="number"
                                    name="bathrooms"
                                    value="{{ old('bathrooms') }}"
                                    min="0"
                                    class="form-control"
                                    placeholder="0">

                            </div>


                            {{-- Toilets --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Toilets
                                </label>

                                <input type="number"
                                    name="toilets"
                                    value="{{ old('toilets') }}"
                                    min="0"
                                    class="form-control"
                                    placeholder="0">

                            </div>


                            {{-- Parking --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Parking Spaces
                                </label>

                                <input type="number"
                                    name="parking_spaces"
                                    value="{{ old('parking_spaces') }}"
                                    min="0"
                                    class="form-control"
                                    placeholder="0">

                            </div>


                            {{-- Property Size --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Property Size
                                </label>

                                <input type="number"
                                    name="size"
                                    value="{{ old('size') }}"
                                    min="0"
                                    class="form-control"
                                    placeholder="e.g. 500">

                            </div>


                            {{-- Size Unit --}}

                            <div class="col-md-4 mb-20">

                                <label class="font-weight-600">
                                    Size Unit
                                </label>

                                <select name="size_unit"
                                    class="custom-select">

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


                        {{-- Amenities --}}

                        <label class="font-weight-600 mb-15">
                            Amenities
                        </label>

                        <div class="row">

                            @php

                                $amenities = [
                                    'Parking',
                                    'Swimming Pool',
                                    'Security',
                                    'Generator',
                                    'Borehole',
                                    'Electricity',
                                    'Air Conditioning',
                                    'Furnished',
                                    'Garden',
                                    'CCTV',
                                    'Internet',
                                    'Gate'
                                ];

                            @endphp

                            @foreach($amenities as $amenity)

                                <div class="col-md-4 col-sm-6 mb-10">

                                    <div class="custom-control custom-checkbox">

                                        <input type="checkbox"
                                            name="amenities[]"
                                            value="{{ $amenity }}"
                                            class="custom-control-input"
                                            id="amenity_{{ Str::slug($amenity) }}">

                                        <label
                                            class="custom-control-label"
                                            for="amenity_{{ Str::slug($amenity) }}">

                                            {{ $amenity }}

                                        </label>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>


                {{-- =========================
                     PROPERTY IMAGES
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-image text-primary mr-2"></i>

                            Property Images

                        </h5>

                        <p class="text-muted mb-0 font-12">
                            Upload clear images of the property.
                        </p>

                    </div>


                    <div class="pd-20">

                        <div class="property-upload-box text-center">

                            <i class="dw dw-image"
                                style="
                                    font-size:45px;
                                    color:#94a3b8;
                                ">
                            </i>

                            <h6 class="font-weight-600 mt-15">
                                Upload Property Images
                            </h6>

                            <p class="text-muted font-12">
                                JPG, JPEG or PNG. Maximum 5MB per image.
                            </p>

                            <input type="file"
                                name="images[]"
                                class="form-control-file mt-15"
                                accept="image/jpeg,image/png,image/jpg"
                                multiple>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 RIGHT COLUMN
            ====================================================== --}}

            <div class="col-lg-4">


                {{-- =========================
                     PRICE
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-money-2 text-primary mr-2"></i>

                            Pricing

                        </h5>

                    </div>


                    <div class="pd-20">

                        <label class="font-weight-600">
                            Property Price
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text">
                                    ₦
                                </span>

                            </div>

                            <input type="number"
                                name="price"
                                value="{{ old('price') }}"
                                min="0"
                                class="form-control"
                                placeholder="0.00">

                        </div>


                        <div class="mt-15">

                            <label class="font-weight-600">
                                Payment Period
                            </label>

                            <select name="payment_period"
                                class="custom-select">

                                <option value="one_time">
                                    One Time Payment
                                </option>

                                <option value="monthly">
                                    Monthly
                                </option>

                                <option value="yearly">
                                    Yearly
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                {{-- =========================
                     AGENT
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-user1 text-primary mr-2"></i>

                            Property Agent

                        </h5>

                    </div>


                    <div class="pd-20">

                        <label class="font-weight-600">
                            Assign Agent
                        </label>

                        <select name="user_id"
                            class="custom-select">

                            <option value="">
                                Select Agent
                            </option>

                            {{-- @foreach($agents ?? [] as $agent)

                                <option value="{{ $agent->id }}"
                                    {{ old('user_id') == $agent->id ? 'selected' : '' }}>

                                    {{ $agent->name }}

                                </option>

                            @endforeach --}}

                        </select>

                        <small class="text-muted d-block mt-10">
                            Select the agent responsible for this property.
                        </small>

                    </div>

                </div>


                {{-- =========================
                     STATUS
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20 border-bottom">

                        <h5 class="h5 mb-1 font-weight-700">

                            <i class="dw dw-check text-primary mr-2"></i>

                            Property Status

                        </h5>

                    </div>


                    <div class="pd-20">

                        <label class="font-weight-600">
                            Status
                        </label>

                        <select name="status"
                            class="custom-select">

                            <option value="pending"
                                {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>

                                Pending Review

                            </option>

                            <option value="available"
                                {{ old('status') == 'available' ? 'selected' : '' }}>

                                Available

                            </option>

                            <option value="sold"
                                {{ old('status') == 'sold' ? 'selected' : '' }}>

                                Sold

                            </option>

                            <option value="rented"
                                {{ old('status') == 'rented' ? 'selected' : '' }}>

                                Rented

                            </option>

                        </select>

                    </div>

                </div>


                {{-- =========================
                     PUBLISH
                ========================== --}}
                <div class="card-box mb-20">

                    <div class="pd-20">

                        <h6 class="font-weight-700 mb-10">
                            Ready to add property?
                        </h6>

                        <p class="text-muted font-12 mb-20">
                            Review the information before submitting
                            this property.
                        </p>


                        <button type="submit"
                            class="btn btn-primary btn-block">

                            <i class="dw dw-save mr-1"></i>

                            Save Property

                        </button>


                        <a href="{{ route('properties.index') }}"
                            class="btn btn-outline-secondary btn-block mt-10">

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

</div>

@endsection

@push('styles')

<style>

    /* Form cards */

    .card-box {
        border-radius: 14px;
        border: 1px solid #edf0f4;
        box-shadow: 0 3px 15px rgba(15, 23, 42, .04);
    }

    /* Form controls */

    .form-control,
    .custom-select {
        border-radius: 8px;
        min-height: 43px;
        border-color: #e2e8f0;
        font-size: 13px;
    }

    textarea.form-control {
        min-height: auto;
    }

    .form-control:focus,
    .custom-select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
    }

    /* Upload box */

    .property-upload-box {
        border: 2px dashed #dbe2ea;
        border-radius: 12px;
        padding: 35px 20px;
        background: #f8fafc;
        transition: .2s ease;
    }

    .property-upload-box:hover {
        border-color: #2563eb;
        background: #f8fbff;
    }

    /* Section headings */

    .card-box h5 {
        color: #1e293b;
    }

    /* Labels */

    label {
        font-size: 12px;
        color: #374151;
        margin-bottom: 7px;
    }

    /* Mobile */

    @media(max-width: 767px) {

        .page-header .btn {
            width: 100%;
        }

        .card-box {
            border-radius: 10px;
        }

    }

</style>

@endpush
