

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