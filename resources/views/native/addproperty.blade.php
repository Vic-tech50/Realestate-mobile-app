<native:scroll-view class=" bg-zinc-50 safe-area">

    <column class="w-full p-4 gap-5">

        {{-- Header --}}
        <column class="w-full gap-1">

            <text class="text-2xl font-extrabold text-zinc-900">
                Add Property
            </text>

            <text class="text-sm text-zinc-500">
                Add details about the property you want to list. 
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

                @php $title = '';
                    $property_type = '';
                    $listing_type;
                    $address = '';
                    $city = '';
                    $state = '';
                    $bedrooms = '';
                    $bathrooms = '';
                    $parking = '';
                    $size = '';
                    $price = '';
                    $price_period = '';
                $description = '';  @endphp

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


            {{-- Parking --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Parking Spaces" placeholder="e.g. 2" keyboard="number"
                    native:model="parking" />

            </column>


            {{-- Property Size --}}
            <column class="w-full gap-2">



                <native:outlined-text-input label="Property Size" placeholder="e.g. 500 sqm" native:model="size" />

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

        <column>
            @if ($errorMessage)
                <text class="text-sm text-red-600 text-center">
                    {{ $errorMessage }}
                </text>
            @endif
        </column>

        <column class="w-full">

            <native:button @press="save" :loading="$isSaving" :disabled="$isSaving"
                class="w-full rounded-xl h-15 bg-black py-4 items-center justify-center">
                {{ $isSaving ? 'Publishing Property...' : 'Publish Property' }}</native:button>

        </column>

    </column>

</native:scroll-view>