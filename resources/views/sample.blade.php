

@php
    $gallery = [];

    if ($property) {
        $gallery = is_array($property->images) ? $property->images : json_decode($property->images ?? '[]', true) ?: [];
    }
@endphp

<native:scroll-view class="w-full h-full bg-zinc-50 safe-area">

<native:top-bar title="Property" subtitle="Property Details" back="true" display-mode="inline" elevation="5">
</native:top-bar>

    <column class="w-full gap-5 pb-8">

        <column class="w-full">

            <column class="w-full h-72 bg-zinc-200">

                <native:image
                    src="{{ $property->thumbnail ?? 'https://picsum.photos/seed/property-main/900/650' }}"
                    :height="280"
                    :fit="2"
                    class="w-full h-full object-cover"
                />

            </column>

            <native:scroll-view
                class="w-full px-4 py-3"
                horizontal
            >

                <column class="flex-row gap-3">

                    @forelse ($gallery ?: [
                        'https://picsum.photos/seed/property-1/400/300',
                        'https://picsum.photos/seed/property-2/400/300',
                        'https://picsum.photos/seed/property-3/400/300',
                    ] as $galleryImage)
                        <native:image
                            src="{{ $galleryImage }}"
                            :width="110"
                            :height="80"
                            :fit="2"
                            class="rounded-xl object-cover"
                        />
                    @empty
                        <native:image
                            src="https://picsum.photos/seed/property-1/400/300"
                            :width="110"
                            :height="80"
                            :fit="2"
                            class="rounded-xl object-cover"
                        />
                    @endforelse

                </column>

            </native:scroll-view>

        </column>

        <column class="w-full px-4 gap-4">

            <column class="w-full flex-row items-start justify-between gap-3">

                <column class="flex-1 gap-1">

                    <text class="text-2xl font-extrabold text-zinc-900">
                        {{ $property->title ?? 'Property Details' }}
                    </text>

                    <text class="text-sm text-zinc-500">
                        {{ trim(($property->address ?? '').' '.($property->city ?? '').', '.($property->state ?? '')) }}
                    </text>

                </column>

                <pressable
                    class="w-11 h-11 rounded-full bg-white border border-zinc-200 items-center justify-center"
                >
                    <text class="text-xl">
                        ♡
                    </text>
                </pressable>

            </column>

            <column class="gap-1">

                <text class="text-2xl font-extrabold text-zinc-900">
                    ₦{{ number_format((float) ($property->price ?? 0), 0) }}
                </text>

                <text class="text-sm text-zinc-500">
                    {{ $property->listing_type ?? 'For Sale' }}
                </text>

            </column>


            {{-- Property Features --}}
            <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4">

                <text class="text-lg font-bold text-zinc-900 mb-4">
                    Property Features
                </text>

                <column class="w-full flex-row flex-wrap gap-4">

                    {{-- Bedrooms --}}
                    <row class=" items-center gap-2 ">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🛏
                            </text>
                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                        {{ $property->bedrooms ?? 0 }}

                            <text class="text-xs text-zinc-500">
                                Bedrooms
                            </text>

                        </column>

                    </row>


                    {{-- Bathrooms --}}
                    <row class="items-center gap-2">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🚿
                            </text>
                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                        {{ $property->bathrooms ?? 0 }}

                            <text class="text-xs text-zinc-500">
                                Bathrooms
                            </text>

                        </column>

                    </row>


                    {{-- Parking --}}
                    <column class="flex-row items-center gap-2">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🚗
                            </text>
                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                        {{ $property->garage ?? 0 }}

                            <text class="text-xs text-zinc-500">
                                Parking
                            </text>

                        </column>

                    </column>


                    {{-- Property Type --}}
                    <column class="flex-row items-center gap-2 ">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🏠
                            </text>

                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                        {{ $property->type ?? 'Property' }}

                            <text class="text-xs text-zinc-500">
                                Property Type
                            </text>

                        </column>

                    </column>

                </column>

            </column>


            {{-- ============================= --}}
            {{-- DESCRIPTION --}}
            {{-- ============================= --}}

            <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-2">

                <text class="text-lg font-bold text-zinc-900">
                    Description
                </text>

                <text class="text-sm leading-6 text-zinc-600">
                    {{ $property->description ?? 'No description available for this property yet.' }}
                </text>

            </column>


            {{-- ============================= --}}
            {{-- LOCATION --}}
            {{-- ============================= --}}

            <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-3">

                <text class="text-lg font-bold text-zinc-900">
                    Location
                </text>

                <column class="flex-row items-center gap-3">

                    <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">

                        <text class="text-lg">
                            📍
                        </text>

                    </column>

                    <column class="flex-1 gap-1">

                        <text class="text-sm font-bold text-zinc-900">
                            {{ $property->city ?? 'Location not set' }}
                        </text>

                        <text class="text-xs text-zinc-500">
                            {{ $property->state ?? 'State not set' }}
                        </text>

                    </column>

                </column>

            </column>


            {{-- ============================= --}}
            {{-- AGENT INFORMATION --}}
            {{-- ============================= --}}

            <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

                <column class="gap-1">

                    <text class="text-lg font-bold text-zinc-900">
                        Listed By
                    </text>

                    <text class="text-sm text-zinc-500">
                        Contact the property agent
                    </text>

                </column>


                {{-- Agent Profile --}}
                <column class="w-full flex-row items-center gap-3">

                    <native:image
                        src="https://i.pravatar.cc/150?img=12"
                        :width="60"
                        :height="60"
                        :fit="2"
                        class="rounded-full"
                    />

                    <column class="flex-1 gap-1">

                        <text class="text-base font-bold text-zinc-900">
                            Victor Okenyi
                        </text>

                        <text class="text-sm text-zinc-500">
                            Licensed Property Agent
                        </text>

                        <text class="text-xs text-zinc-400">
                            4.9 ★ · 38 Properties
                        </text>

                    </column>

                </column>


                {{-- Agent Phone --}}
                <column class="w-full flex-row items-center gap-3">

                    <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">

                        <text class="text-lg">
                            ☎
                        </text>

                    </column>

                    <column class="flex-1 gap-1">

                        <text class="text-xs text-zinc-500">
                            Phone Number
                        </text>

                        <text class="text-sm font-semibold text-zinc-900">
                            +234 801 234 5678
                        </text>

                    </column>

                    <pressable @press="callAgent" class="px-3 py-2 rounded-lg bg-zinc-100">

                        <text class="text-xs font-bold text-zinc-900">
                            Call
                        </text>

                    </pressable>

                </column>


                {{-- Agent Email --}}
                <column class="w-full flex-row items-center gap-3">

                    <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">

                        <text class="text-lg">
                            ✉
                        </text>

                    </column>

                    <column class="flex-1 gap-1">

                        <text class="text-xs text-zinc-500">
                            Email Address
                        </text>

                        <text class="text-sm font-semibold text-zinc-900">
                            agent@example.com
                        </text>

                    </column>

                </column>


                {{-- WhatsApp --}}
                <pressable @press="whatsappAgent"
                    class="w-full rounded-xl bg-zinc-100 py-3 items-center justify-center"
                >

                    <text class="text-sm font-bold text-zinc-900">
                        Contact Agent on WhatsApp
                    </text>

                </pressable>

            </column>


            {{-- ============================= --}}
            {{-- ACTIONS --}}
            {{-- ============================= --}}

            <column class="w-full gap-3 pt-2">

                <pressable @press="emailAgent"
                    class="w-full rounded-xl bg-black py-4 items-center justify-center"
                >

                    <text class="text-base font-bold text-white">
                        Contact Agent
                    </text>

                </pressable>


                <pressable
                    class="w-full rounded-xl border border-zinc-300 bg-white py-4 items-center justify-center"
                >

                    <text class="text-base font-bold text-zinc-900">
                        Schedule a Viewing
                    </text>

                </pressable>

            </column>

        </column>

    </column>

</native:scroll-view>









//////////////////////////////////////////////////


<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">

    <column class="w-full gap-5" padding="16">

        {{-- Header --}}
        <column class="w-full gap-1">

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Welcome back,
            </text>

            <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                {{ $user['name'] ?? 'Agent' }}
            </text>

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Manage your properties and listings.
            </text>

        </column>


        {{-- Statistics --}}
        <row class="w-full gap-3">

            {{-- Total Properties --}}
            <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-1">

                <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                    Properties
                </text>

                <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                    {{ $properties->count() ?? '0' }}
                </text>

            </column>


            {{-- Active --}}
            <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-1">

                <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                    Active
                </text>

                <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                    {{ $properties->where('status', 'active')->count() ?? 0 }}
                </text>

            </column>

        </row>


        {{-- No Properties --}}
        @if ($properties->isEmpty())

            <column
                class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-6 items-center justify-center gap-4"
                :elevation="4"
            >

                {{-- Icon --}}
                <column
                    class="w-16 h-16 rounded-full bg-zinc-100 dark:bg-zinc-800 items-center justify-center"
                >
                    <text class="text-3xl">
                        🏠
                    </text>
                </column>


                {{-- Title --}}
                <text class="text-xl font-extrabold text-zinc-900 dark:text-white text-center">
                    No Properties Yet
                </text>


                {{-- Description --}}
                <text class="text-sm text-zinc-500 dark:text-zinc-400 text-center">
                    You haven't added any properties yet.
                    Add your first property to start reaching potential clients.
                </text>


                {{-- Add Property --}}
                <pressable
                    @press="addProperty"
                    class="w-full rounded-xl bg-black dark:bg-white py-4 items-center justify-center"
                >
                    <text class="text-base font-bold text-white dark:text-black">
                        + Add Property
                    </text>
                </pressable>

            </column>

        @else

            {{-- Properties Header --}}
            <row class="w-full items-center justify-between">

                <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                    My Properties
                </text>

                <pressable
                    @press="addProperty"
                    class="rounded-lg bg-black dark:bg-white px-3 py-2"
                >
                    <text class="text-xs font-bold text-white dark:text-black">
                        + Add
                    </text>
                </pressable>

            </row>


            {{-- Property List --}}
            <native:scroll-view
                axis="horizontal"
                :shows-indicators="true"
                scroll-anchor="bottom"
            >

                <row
                    :gap="10"
                    class="w-full h-[400px] p-2"
                >

                    @foreach ($properties as $property)

                        <pressable
                            class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden"
                        >

                            {{-- Property Image --}}
                            <column class="w-full relative">

                                <native:image
                                    src="{{ $property->thumbnail ?: 'https://picsum.photos/seed/property-'.$property->id.'/800/600' }}"
                                    :height="220"
                                    :fit="2"
                                    class="w-full object-cover bg-zinc-200 dark:bg-zinc-800"
                                />


                                {{-- Property Type --}}
                                <text
                                    class="absolute bottom-3 left-3 rounded-full bg-black/50 px-3 py-1 text-xs font-semibold text-white capitalize"
                                >
                                    {{ $property->type }}
                                </text>

                                 <text
                                    class="absolute bottom-3 right-3 rounded-full bg-black/50 px-3 py-1 text-xs font-semibold text-white"
                                >
                                    {{ $property->views_count }} {{ $property->views_count == 1 || $property->views_count == 0 ? 'view' : 'views' }}
                                </text>

                            </column>


                            {{-- Card Content --}}
                            <column class="w-full p-4 gap-3">

                                {{-- Title + Price --}}
                                <row class="w-full items-start justify-between gap-3">

                                    <column class="flex-1 gap-1">

                                        <text class="text-lg font-bold text-zinc-900 dark:text-white capitalize">
                                            {{ $property->title }}
                                        </text>

                                        <text class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $property->address }}
                                            {{ $property->city }},
                                            {{ $property->state }}
                                        </text>

                                    </column>

                                    <column class="items-end">

                                        <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                                            &#8358;{{ Number::format($property->price, precision: 2) ?? 0.00 }}
                                        </text>

                                        <text class="text-xs text-zinc-400 dark:text-zinc-500">
                                            {{ $property->listing_type }}
                                        </text>

                                    </column>

                                </row>


                                {{-- Property Features --}}
                                <row class="w-full items-center gap-4">

                                    <row class="items-center gap-1">

                                        <text class="text-sm">
                                            🛏
                                        </text>

                                        <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                            {{ $property->bedrooms ?? 'No' }} Beds
                                        </text>

                                    </row>


                                    <row class="items-center gap-1">

                                        <text class="text-sm">
                                            🚿
                                        </text>

                                        <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                            {{ $property->bathrooms ?? 'No' }} Baths
                                        </text>

                                    </row>


                                    <row class="items-center gap-1">

                                        <text class="text-sm">
                                            📐
                                        </text>

                                        <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                            {{ $property->size }} {{ $property->size_unit ?? 'sqft' }}
                                        </text>

                                    </row>

                                </row>


                                {{-- Divider --}}
                                <column class="w-full h-px bg-zinc-100 dark:bg-zinc-800"></column>


                                {{-- Footer --}}
                                <row class="w-full items-center justify-between">

                                    {{-- Delete --}}
                                    <pressable
                                        @press="confirmDelete({{ $property->id }})"
                                        class="rounded-xl bg-red-500 dark:bg-red-600 px-4 py-2"
                                    >

                                        <text class="text-xs font-bold text-white">
                                            Delete Property
                                        </text>

                                    </pressable>


                                    {{-- Edit --}}
                                    <pressable
                                        @press="editProperty({{ $property->id }})"
                                        class="rounded-xl bg-zinc-900 dark:bg-white px-4 py-2"
                                    >

                                        <text class="text-xs font-bold text-white dark:text-black">
                                            Edit Property
                                        </text>

                                    </pressable>

                                </row>

                                <column>
                                     <native:button
        label="View Statistics"
        @press="property"
        variant="ghost"
        size="sm"
        icon="analytics"
        class="w-full py-4"
    />
                                </column>

                            </column>

                        </pressable>
                    

                    @endforeach

                </row>

            </native:scroll-view>

        @endif


        {{-- Quick Actions --}}
        <column class="w-full gap-3">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Quick Actions
            </text>

            <row class="w-full gap-3">

                {{-- Add Property --}}
                <pressable
                    @press="addProperty"
                    class="flex-1 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 items-center justify-center"
                >

                    <text class="text-xl text-zinc-900 dark:text-white">
                        +
                    </text>

                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        Add Property
                    </text>

                </pressable>


                {{-- My Profile --}}
                <pressable
                    class="flex-1 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 items-center justify-center"
                >

                    <text class="text-xl">
                        👤
                    </text>

                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        My Profile
                    </text>

                </pressable>

            </row>

        </column>

    </column>

</native:scroll-view>



/////////////////////////////////


<native:scroll-view class=" bg-zinc-50 safe-area">

    <column class="w-full p-4 gap-5">

        {{-- Header --}}
        <column class="w-full gap-1">

            <text class="text-2xl font-extrabold text-zinc-900">
                Edit Property
            </text>

            <text class="text-sm text-zinc-500">
                Edit details about the property you want to list. 
            </text>

        </column>


        {{-- ============================= --}}
        {{-- PROPERTY INFORMATION --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Property Information
                </text>

                <text class="text-xs text-zinc-500">
                    Basic information about your property.
                </text>

            </column>


            {{-- Title --}}
            <column class="w-full gap-2">

              

                <native:outlined-text-input label="Property Title" placeholder="e.g. Luxury 4 Bedroom Duplex"
                    native:model="title" />

            </column>


            {{-- Property Type --}}
            <column class="w-100 gap-2">

       <native:select label="Property Type" placeholder="Select property type"
                    :options="['House', 'Duplex', 'Apartment', 'Flat', 'Bungalow', 'Land', 'Office', 'Shop', 'Warehouse']"
                    native:model="property_type" />


            </column>


            {{-- Listing Type --}}
            <column class="w-full gap-2">



                <native:select label="Listing Type" placeholder="Select listing type"
                    :options="['For Sale', 'For Rent', 'For Lease']" class="w-full" native:model="listing_type" />



            </column>

        </column>


        {{-- ============================= --}}
        {{-- LOCATION --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Location
                </text>

                <text class="text-xs text-zinc-500">
                    Where is this property located?
                </text>

            </column>


            {{-- Address --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Address" placeholder="e.g. 12 Admiralty Way"
                    native:model="address" />

            </column>

            <column class="w-full gap-2">

                <native:outlined-text-input label="Country" placeholder="e.g. Nigeria" native:model="country" />

            </column>

            <column class="w-full gap-2">

                <native:outlined-text-input label="Nearby Landmark" placeholder="e.g. Near the stadium"
                    native:model="landmark" />

            </column>


            {{-- City --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="City" placeholder="e.g. Lagos" native:model="city" />

            </column>


            {{-- State --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="State" placeholder="e.g. Lagos State" native:model="state" />

            </column>

        </column>


        {{-- ============================= --}}
        {{-- PROPERTY FEATURES --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Property Features
                </text>

                <text class="text-xs text-zinc-500">
                    Tell buyers what the property offers.
                </text>

            </column>


            {{-- Bedrooms --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Bedrooms" placeholder="e.g. 4" keyboard="number"
                    native:model="bedrooms" />

            </column>


            {{-- Bathrooms --}}
            <column class="w-full gap-2">


                <native:outlined-text-input label="Bathrooms" placeholder="e.g. 3" keyboard="number"
                    native:model="bathrooms" />

            </column>

            <column class="w-full gap-2">

                <native:outlined-text-input label="Toilets" placeholder="e.g. 4" keyboard="number"
                    native:model="toilets" />

            </column>


            {{-- Parking --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Parking Spaces" placeholder="e.g. 2" keyboard="number"
                    native:model="parking" />

            </column>


            {{-- Property Size --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Property Size" placeholder="e.g. 500" keyboard="number"
                    native:model="size" />

            </column>

            <column class="w-full gap-2">

                <native:select label="Size Unit" placeholder="Select size unit"
                    :options="['sqm', 'sqft', 'plot', 'acre']" native:model="size_unit" />

            </column>

            <column class="w-full gap-2">

                <text class="text-sm font-bold text-zinc-900">Amenities</text>

                <row class="flex justify-between">
                    <native:checkbox label="Parking" native:model="amenityParking" />
                    <native:checkbox label="Swimming Pool" native:model="amenitySwimmingPool" />
                    <native:checkbox label="Security" native:model="amenitySecurity" />
                </row>

                <row class="flex justify-between">
                    <native:checkbox label="Generator" native:model="amenityGenerator" />
                    <native:checkbox label="Borehole" native:model="amenityBorehole" />
                    <native:checkbox label="Electricity" native:model="amenityElectricity" />
                </row>

                <row class="flex justify-between">
                    <native:checkbox label="Air Conditioning" native:model="amenityAirConditioning" />
                    <native:checkbox label="Furnished" native:model="amenityFurnished" />
                    <native:checkbox label="Garden" native:model="amenityGarden" />
                </row>

                <row class="flex justify-between">
                    <native:checkbox label="CCTV" native:model="amenityCctv" />
                    <native:checkbox label="Internet" native:model="amenityInternet" />
                    <native:checkbox label="Gate" native:model="amenityGate" />
                </row>

            </column>

        </column>


        {{-- ============================= --}}
        {{-- PRICE --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Pricing
                </text>

                <text class="text-xs text-zinc-500">
                    Set the asking price for this property.
                </text>

            </column>


            <column class="w-full gap-2">



                <native:outlined-text-input label="Price" placeholder="e.g. 85000000" keyboard="number"
                    native:model="price" />

            </column>


            {{-- Price Period --}}
            <column class="w-full gap-2">

                <native:select label="Price Period" placeholder="Select property type"
                    :options="['Total Price', 'Per Month', 'Per Year']" native:model="price_period" />



            </column>

        </column>


        {{-- ============================= --}}
        {{-- PROPERTY IMAGES --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Property Images
                </text>

                <text class="text-xs text-zinc-500">
                    Add clear images of the property.
                </text>

            </column>


            {{-- Upload Button --}}
            <pressable @press="selectImages"
                class="w-full rounded-xl border-2 border-dashed border-zinc-300 p-6 items-center justify-center gap-2">

                <text class="text-2xl">
                    📷
                </text>

                <text class="text-sm font-bold text-zinc-900">
                    Add Property Images
                </text>

                <text class="text-xs text-zinc-500">
                    Select multiple images
                </text>

            </pressable>


            {{-- Selected Images --}}
            @if (!empty($images))

                <native:scroll-view horizontal class="w-full">

                    <row class="gap-3">

                        @foreach ($images as $image)

                            <native:image src="{{ $image }}" :width="110" :height="90" :fit="2"
                                class="rounded-xl object-cover" />

                        @endforeach

                    </row>

                </native:scroll-view>

            @endif

        </column>


        {{-- ============================= --}}
        {{-- DESCRIPTION --}}
        {{-- ============================= --}}

        <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4">

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Description
                </text>

                <text class="text-xs text-zinc-500">
                    Give potential clients more information.
                </text>

            </column>


            <native:outlined-text-input label="Property Description"
                placeholder="Describe the property, facilities, environment and other important details..."
                native:model="description" />

        </column>


        {{-- ============================= --}}
        {{-- SUBMIT --}}
        {{-- ============================= --}}

        {{-- <column>
            @if ($errorMessage)
                <text class="text-sm text-red-600 text-center">
                    {{ $errorMessage }}
                </text>
            @endif
            :loading="$isSaving" :disabled="$isSaving"
            {{ $isSaving ? 'Publishing Property...' : 'Publish Property' }}
        </column> --}}

        <column class="w-full">

            <native:button @press="save" class="w-full rounded-xl h-15 bg-black py-4 items-center justify-center">
                Edit Property
            </native:button>

        </column>

    </column>

</native:scroll-view>