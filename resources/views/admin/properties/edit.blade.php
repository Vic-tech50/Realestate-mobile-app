@extends('web.main')

@section('title', 'Edit Property')

@section('content')

<style>
    .edit-property-page {
        padding-bottom: 50px;
    }

    .edit-page-header {
        margin-bottom: 25px;
    }

    .edit-page-header h4 {
        font-size: 24px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .edit-page-header p {
        color: #8a94a6;
        font-size: 13px;
        margin-bottom: 0;
    }

    .property-id-badge {
        display: inline-flex;
        align-items: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 20px;
        padding: 7px 12px;
        font-size: 11px;
        font-weight: 700;
        margin-top: 10px;
    }

    /* Cards */

    .form-card {
        background: #fff;
        border: 1px solid #edf0f4;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, .035);
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 23px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f0f2f5;
    }

    .form-card-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .form-card-header h5 {
        font-size: 15px;
        font-weight: 800;
        color: #273142;
        margin: 0;
    }

    .form-card-header p {
        font-size: 11px;
        color: #929baa;
        margin: 3px 0 0;
    }

    /* Form */

    .form-group-custom {
        margin-bottom: 18px;
    }

    .form-label-custom {
        display: block;
        font-size: 12px;
        font-weight: 700;
        color: #465064;
        margin-bottom: 7px;
    }

    .required {
        color: #dc3545;
    }

    .form-control-custom,
    .custom-select-custom {
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

    textarea.form-control-custom {
        height: auto;
        min-height: 125px;
        padding: 12px 13px;
        resize: vertical;
    }

    .form-control-custom:focus,
    .custom-select-custom:focus {
        outline: none;
        background: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
    }

    .form-control-custom::placeholder {
        color: #adb5c2;
    }

    .field-help {
        display: block;
        color: #9aa3b2;
        font-size: 11px;
        margin-top: 6px;
    }

    /* Input group */

    .input-prefix {
        position: relative;
    }

    .input-prefix-symbol {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #8e98a8;
        font-size: 13px;
        font-weight: 600;
        z-index: 2;
    }

    .input-prefix .form-control-custom {
        padding-left: 32px;
    }

    /* Error */

    .validation-box {
        background: #fff5f5;
        border: 1px solid #ffd6d6;
        color: #842029;
        border-radius: 10px;
        padding: 14px 18px;
        margin-bottom: 20px;
    }

    .validation-box-title {
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    .validation-box ul {
        padding-left: 20px;
        margin-bottom: 0;
        font-size: 12px;
    }

    /* Amenities */

    .amenity-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .amenity-option {
        position: relative;
    }

    .amenity-option input {
        position: absolute;
        opacity: 0;
    }

    .amenity-label {
        display: flex;
        align-items: center;
        gap: 9px;
        padding: 11px 12px;
        border: 1px solid #e5e9ef;
        background: #fafbfc;
        border-radius: 8px;
        color: #687386;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }

    .amenity-check {
        width: 17px;
        height: 17px;
        border: 1px solid #ccd2dc;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        color: transparent;
        background: #fff;
    }

    .amenity-option input:checked + .amenity-label {
        border-color: #0d6efd;
        background: #eef5ff;
        color: #0d6efd;
    }

    .amenity-option input:checked + .amenity-label .amenity-check {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }

    /* Images */

    .current-images {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        margin-bottom: 18px;
    }

    .current-image {
        position: relative;
        height: 130px;
        overflow: hidden;
        border-radius: 9px;
        background: #f3f5f7;
    }

    .current-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .current-image-label {
        position: absolute;
        bottom: 7px;
        left: 7px;
        background: rgba(0, 0, 0, .65);
        color: #fff;
        padding: 4px 7px;
        border-radius: 4px;
        font-size: 9px;
    }

    .upload-box {
        border: 2px dashed #dce2e9;
        border-radius: 11px;
        background: #fafbfc;
        padding: 27px 20px;
        text-align: center;
        transition: .2s ease;
    }

    .upload-box:hover {
        border-color: #0d6efd;
        background: #f8fbff;
    }

    .upload-icon {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #eef5ff;
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-size: 19px;
    }

    .upload-title {
        font-size: 13px;
        font-weight: 700;
        color: #465064;
        margin-bottom: 4px;
    }

    .upload-description {
        font-size: 11px;
        color: #929baa;
        margin-bottom: 13px;
    }

    .file-input {
        font-size: 12px;
        max-width: 100%;
    }

    /* Save bar */

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
        font-size: 13px;
        color: #273142;
        margin-bottom: 3px;
    }

    .save-info span {
        color: #929baa;
        font-size: 11px;
    }

    .save-actions .btn {
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        padding: 10px 17px;
        margin-left: 5px;
    }

    /* Responsive */

    @media (max-width: 991px) {
        .amenity-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 767px) {

        .edit-page-header h4 {
            font-size: 21px;
        }

        .form-card {
            padding: 18px;
        }

        .amenity-grid {
            grid-template-columns: 1fr 1fr;
        }

        .current-images {
            grid-template-columns: 1fr 1fr;
        }

        .save-bar {
            display: block;
        }

        .save-actions {
            margin-top: 15px;
        }

        .save-actions .btn {
            margin-left: 0;
            margin-right: 5px;
        }
    }

    @media (max-width: 450px) {
        .amenity-grid {
            grid-template-columns: 1fr;
        }

        .current-images {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>


<div class="main-container edit-property-page">

    <div class="pd-ltr-20 xs-pd-20-10">

        {{-- =========================================
             PAGE HEADER
        ========================================== --}}
        <div class="edit-page-header">

            <h4>
                Edit Property
            </h4>

            <p>
                Update the information and settings for
                <strong>{{ $property->title }}</strong>.
            </p>

            <span class="property-id-badge">
                <i class="icon-copy dw dw-building mr-1"></i>
                Property ID: {{ $property->property_id }}
            </span>

        </div>


        {{-- =========================================
             VALIDATION ERRORS
        ========================================== --}}
        @if ($errors->any())

            <div class="validation-box">

                <div class="validation-box-title">
                    <i class="icon-copy dw dw-warning mr-1"></i>
                    Please correct the following errors:
                </div>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>

        @endif


        <form
            method="POST"
            action="{{ route('properties.update', $property) }}"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="row">

                {{-- =====================================
                     LEFT COLUMN
                ====================================== --}}
                <div class="col-lg-8">


                    {{-- PROPERTY INFORMATION --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-building"></i>
                            </div>

                            <div>
                                <h5>Property Information</h5>
                                <p>Basic information about the property</p>
                            </div>

                        </div>


                        <div class="row">

                            {{-- Title --}}
                            <div class="col-md-12">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Property Title
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="title"
                                        class="form-control-custom"
                                        value="{{ old('title', $property->title) }}"
                                        placeholder="e.g. Luxury 4 Bedroom Duplex"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- Type --}}
                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Property Type
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        name="type"
                                        class="custom-select-custom"
                                        required
                                    >

                                        @foreach ([
                                            'house',
                                            'apartment',
                                            'land',
                                            'office',
                                            'shop',
                                            'warehouse'
                                        ] as $type)

                                            <option
                                                value="{{ $type }}"
                                                @selected(old('type', $property->type) === $type)
                                            >
                                                {{ ucfirst($type) }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            {{-- Listing Type --}}
                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Listing Type
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        name="listing_type"
                                        class="custom-select-custom"
                                        required
                                    >

                                        @foreach ([
                                            'sale' => 'For Sale',
                                            'rent' => 'For Rent',
                                            'lease' => 'For Lease'
                                        ] as $value => $label)

                                            <option
                                                value="{{ $value }}"
                                                @selected(old('listing_type', $property->listing_type) === $value)
                                            >
                                                {{ $label }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>


                            {{-- Description --}}
                            <div class="col-md-12">

                                <div class="form-group-custom mb-0">

                                    <label class="form-label-custom">
                                        Description
                                        <span class="required">*</span>
                                    </label>

                                    <textarea
                                        name="description"
                                        class="form-control-custom"
                                        rows="5"
                                        placeholder="Describe the property..."
                                        required
                                    >{{ old('description', $property->description) }}</textarea>

                                    <span class="field-help">
                                        Provide useful information about the property.
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- LOCATION --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-map-1"></i>
                            </div>

                            <div>
                                <h5>Property Location</h5>
                                <p>Where is this property located?</p>
                            </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Address
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="address"
                                        class="form-control-custom"
                                        value="{{ old('address', $property->address) }}"
                                        placeholder="Enter property address"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        City
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="city"
                                        class="form-control-custom"
                                        value="{{ old('city', $property->city) }}"
                                        placeholder="e.g. Uyo"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        State
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="state"
                                        class="form-control-custom"
                                        value="{{ old('state', $property->state) }}"
                                        placeholder="e.g. Akwa Ibom"
                                        required
                                    >

                                </div>

                            </div>


                            <div class="col-md-4">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Country
                                    </label>

                                    <input
                                        type="text"
                                        name="country"
                                        class="form-control-custom"
                                        value="{{ old('country', $property->country) }}"
                                        placeholder="Nigeria"
                                    >

                                </div>

                            </div>


                            <div class="col-md-12">

                                <div class="form-group-custom mb-0">

                                    <label class="form-label-custom">
                                        Landmark
                                    </label>

                                    <input
                                        type="text"
                                        name="landmark"
                                        class="form-control-custom"
                                        value="{{ old('landmark', $property->landmark) }}"
                                        placeholder="e.g. Near Ibom Plaza"
                                    >

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- PROPERTY FEATURES --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-home"></i>
                            </div>

                            <div>
                                <h5>Property Features</h5>
                                <p>Rooms, size and other property measurements</p>
                            </div>

                        </div>


                        <div class="row">

                            {{-- Bedrooms --}}
                            <div class="col-md-3 col-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Bedrooms
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        name="bedrooms"
                                        class="form-control-custom"
                                        value="{{ old('bedrooms', $property->bedrooms) }}"
                                    >

                                </div>

                            </div>


                            {{-- Bathrooms --}}
                            <div class="col-md-3 col-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Bathrooms
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        name="bathrooms"
                                        class="form-control-custom"
                                        value="{{ old('bathrooms', $property->bathrooms) }}"
                                    >

                                </div>

                            </div>


                            {{-- Toilets --}}
                            <div class="col-md-3 col-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Toilets
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        name="toilets"
                                        class="form-control-custom"
                                        value="{{ old('toilets', $property->toilets) }}"
                                    >

                                </div>

                            </div>


                            {{-- Parking --}}
                            <div class="col-md-3 col-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Parking Spaces
                                    </label>

                                    <input
                                        type="number"
                                        min="0"
                                        name="parking_spaces"
                                        class="form-control-custom"
                                        value="{{ old('parking_spaces', $property->garage) }}"
                                    >

                                </div>

                            </div>


                            {{-- Size --}}
                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Property Size
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="number"
                                        min="1"
                                        name="size"
                                        class="form-control-custom"
                                        value="{{ old('size', $property->size) }}"
                                        placeholder="e.g. 500"
                                        required
                                    >

                                </div>

                            </div>


                            {{-- Size Unit --}}
                            <div class="col-md-6">

                                <div class="form-group-custom">

                                    <label class="form-label-custom">
                                        Size Unit
                                    </label>

                                    <select
                                        name="size_unit"
                                        class="custom-select-custom"
                                    >

                                        @foreach ([
                                            'sqm',
                                            'sqft',
                                            'plot',
                                            'acre'
                                        ] as $unit)

                                            <option
                                                value="{{ $unit }}"
                                                @selected(old('size_unit', $property->size_unit) === $unit)
                                            >
                                                {{ strtoupper($unit) }}
                                            </option>

                                        @endforeach

                                    </select>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- AMENITIES --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-star"></i>
                            </div>

                            <div>
                                <h5>Amenities</h5>
                                <p>Select the facilities available on this property</p>
                            </div>

                        </div>


                        <div class="amenity-grid">

                            @foreach ([
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
                            ] as $amenity)

                                <div class="amenity-option">

                                    <input
                                        type="checkbox"
                                        id="amenity_{{ Str::slug($amenity) }}"
                                        name="amenities[]"
                                        value="{{ $amenity }}"
                                        @checked(
                                            in_array(
                                                $amenity,
                                                old('amenities', $property->amenities ?? [])
                                            )
                                        )
                                    >

                                    <label
                                        for="amenity_{{ Str::slug($amenity) }}"
                                        class="amenity-label"
                                    >

                                        <span class="amenity-check">
                                            <i class="icon-copy dw dw-check"></i>
                                        </span>

                                        {{ $amenity }}

                                    </label>

                                </div>

                            @endforeach

                        </div>

                    </div>


                    {{-- IMAGES --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-picture"></i>
                            </div>

                            <div>
                                <h5>Property Images</h5>
                                <p>Manage existing images and upload new ones</p>
                            </div>

                        </div>


                        {{-- Existing Images --}}

                        @if (!empty($property->images))

                            <label class="form-label-custom">
                                Current Images
                            </label>

                            <div class="current-images">

                                @foreach ($property->images as $image)

                                    <div class="current-image">

                                        <img
                                            src="{{ $image }}"
                                            alt="{{ $property->title }}"
                                        >

                                        <span class="current-image-label">
                                            Existing image
                                        </span>

                                    </div>

                                @endforeach

                            </div>

                        @endif


                        {{-- Upload --}}

                        <div class="upload-box">

                            <div class="upload-icon">
                                <i class="icon-copy dw dw-upload"></i>
                            </div>

                            <div class="upload-title">
                                Add New Property Images
                            </div>

                            <div class="upload-description">
                                JPG or PNG images. Maximum 5MB per image.
                            </div>

                            <input
                                type="file"
                                name="images[]"
                                class="file-input"
                                accept="image/jpeg,image/png"
                                multiple
                            >

                        </div>

                    </div>

                </div>


                {{-- =====================================
                     RIGHT COLUMN
                ====================================== --}}
                <div class="col-lg-4">


                    {{-- PRICING --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-money-2"></i>
                            </div>

                            <div>
                                <h5>Pricing</h5>
                                <p>Set the property's price</p>
                            </div>

                        </div>


                        <div class="form-group-custom">

                            <label class="form-label-custom">
                                Price
                                <span class="required">*</span>
                            </label>

                            <div class="input-prefix">

                                <span class="input-prefix-symbol">
                                    ₦
                                </span>

                                <input
                                    type="number"
                                    min="0"
                                    name="price"
                                    class="form-control-custom"
                                    value="{{ old('price', $property->price) }}"
                                    placeholder="0"
                                    required
                                >

                            </div>

                        </div>


                        <div class="form-group-custom mb-0">

                            <label class="form-label-custom">
                                Payment Period
                            </label>

                            <select
                                name="payment_period"
                                class="custom-select-custom"
                            >

                                @foreach ([
                                    'one_time' => 'One Time Payment',
                                    'monthly' => 'Monthly',
                                    'yearly' => 'Yearly'
                                ] as $value => $label)

                                    <option
                                        value="{{ $value }}"
                                        @selected(
                                            old(
                                                'payment_period',
                                                $property->price_period
                                            ) === $value
                                        )
                                    >
                                        {{ $label }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    {{-- AGENT --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-user1"></i>
                            </div>

                            <div>
                                <h5>Property Agent</h5>
                                <p>Assign an agent to this property</p>
                            </div>

                        </div>


                        <div class="form-group-custom mb-0">

                            <label class="form-label-custom">
                                Agent
                            </label>

                            <select
                                name="user_id"
                                class="custom-select-custom"
                            >

                                <option value="">
                                    Keep current agent
                                </option>

                                @foreach ($agents as $agent)

                                    <option
                                        value="{{ $agent->id }}"
                                        @selected(
                                            old(
                                                'user_id',
                                                $property->agent_id
                                            ) == $agent->id
                                        )
                                    >
                                        {{ $agent->name }}
                                    </option>

                                @endforeach

                            </select>

                            @if ($property->user)

                                <span class="field-help">
                                    Current agent:
                                    <strong>{{ $property->user->name }}</strong>
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-flag"></i>
                            </div>

                            <div>
                                <h5>Property Status</h5>
                                <p>Current availability status</p>
                            </div>

                        </div>


                        <div class="form-group-custom mb-0">

                            <label class="form-label-custom">
                                Status
                            </label>

                            <select
                                name="status"
                                class="custom-select-custom"
                            >

                                @foreach ([
                                    'pending',
                                    'available',
                                    'sold',
                                    'rented'
                                ] as $status)

                                    <option
                                        value="{{ $status }}"
                                        @selected(
                                            old(
                                                'status',
                                                $property->status
                                            ) === $status
                                        )
                                    >
                                        {{ ucfirst($status) }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    {{-- QUICK SUMMARY --}}
                    <div class="form-card">

                        <div class="form-card-header">

                            <div class="form-card-icon">
                                <i class="icon-copy dw dw-info"></i>
                            </div>

                            <div>
                                <h5>Property Summary</h5>
                                <p>Current property information</p>
                            </div>

                        </div>


                        <div class="info-row">
                            <span class="text-muted small">
                                Property ID
                            </span>

                            <strong class="small">
                                {{ $property->property_id }}
                            </strong>
                        </div>


                        <div class="info-row">
                            <span class="text-muted small">
                                Type
                            </span>

                            <strong class="small">
                                {{ ucfirst($property->type) }}
                            </strong>
                        </div>


                        <div class="info-row">
                            <span class="text-muted small">
                                Listing
                            </span>

                            <strong class="small">
                                {{ ucfirst($property->listing_type) }}
                            </strong>
                        </div>


                        <div class="info-row">
                            <span class="text-muted small">
                                Location
                            </span>

                            <strong class="small text-right">
                                {{ $property->city }},
                                {{ $property->state }}
                            </strong>
                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================
                 SAVE BAR
            ========================================== --}}
            <div class="save-bar">

                <div class="save-info">

                    <strong>
                        Ready to save your changes?
                    </strong>

                    <span>
                        Make sure all property information is correct before saving.
                    </span>

                </div>


                <div class="save-actions">

                    <a
                        href="{{ route('properties.show', $property) }}"
                        class="btn btn-outline-secondary"
                    >
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="icon-copy dw dw-save mr-1"></i>
                        Save Changes
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection