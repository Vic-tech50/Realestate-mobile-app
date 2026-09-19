

<native:scroll-view class="w-full h-full bg-zinc-50 safe-area">
    <native:top-bar title="View Property"  back = "true"> 
</native:top-bar>

    <column class="w-full gap-5 pb-8">

        {{-- ============================= --}}
        {{-- IMAGE GALLERY --}}
        {{-- ============================= --}}

        <column class="w-full">

            {{-- Main Property Image --}}
            <column class="w-full h-72 bg-zinc-200">

                <native:image
                    src="https://picsum.photos/seed/property-main/900/650"
                    :height="280"
                    :fit="2"
                    class="w-full h-full object-cover"
                />

            </column>


            {{-- Property Images --}}
            <native:scroll-view
                class="w-full px-4 py-3"
                horizontal
            >

                <column class="flex-row gap-3">

                    <native:image
                        src="https://picsum.photos/seed/property-1/400/300"
                        :width="110"
                        :height="80"
                        :fit="2"
                        class="rounded-xl object-cover"
                    />

                    <native:image
                        src="https://picsum.photos/seed/property-2/400/300"
                        :width="110"
                        :height="80"
                        :fit="2"
                        class="rounded-xl object-cover"
                    />

                    <native:image
                        src="https://picsum.photos/seed/property-3/400/300"
                        :width="110"
                        :height="80"
                        :fit="2"
                        class="rounded-xl object-cover"
                    />

                    <native:image
                        src="https://picsum.photos/seed/property-4/400/300"
                        :width="110"
                        :height="80"
                        :fit="2"
                        class="rounded-xl object-cover"
                    />

                    <native:image
                        src="https://picsum.photos/seed/property-5/400/300"
                        :width="110"
                        :height="80"
                        :fit="2"
                        class="rounded-xl object-cover"
                    />

                </column>

            </native:scroll-view>

        </column>


        {{-- ============================= --}}
        {{-- PROPERTY INFORMATION --}}
        {{-- ============================= --}}

        <column class="w-full px-4 gap-4">

            {{-- Title + Favorite --}}
            <column class="w-full flex-row items-start justify-between gap-3">

                <column class="flex-1 gap-1">

                    <text class="text-2xl font-extrabold text-zinc-900 capitalize">
                        {{ $property->title }}
                    </text>

                    <text class="text-sm text-zinc-500">
                        {{ $property->address }} {{ $property->city }}, {{ $property->state }}
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


            {{-- Price --}}
            <column class="gap-1">

                <text class="text-2xl font-extrabold text-zinc-900">
                    ₦{{ Number::format($property->price, precision: 2)  ?? 0.00}}
                </text>

                <text class="text-sm text-zinc-500">
                    For Sale
                </text>

            </column>


            {{-- Property Features --}}
            <column class="w-full rounded-2xl bg-white border border-zinc-200 p-4">

                <text class="text-lg font-bold text-zinc-900 mb-4">
                    Property Features
                </text>

                <column class="w-full flex-row flex-wrap gap-4">

                    {{-- Bedrooms --}}
                    <column class="flex-row items-center gap-2 ">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🛏
                            </text>
                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                                {{ $property->bedrooms ?? 0 }}
                            </text>

                            <text class="text-xs text-zinc-500">
                                Bedrooms
                            </text>

                        </column>

                    </column>


                    {{-- Bathrooms --}}
                    <column class="flex-row items-center gap-2">

                        <column class="w-10 h-10 rounded-xl bg-zinc-100 items-center justify-center">
                            <text class="text-lg">
                                🚿
                            </text>
                        </column>

                        <column class="gap-0">

                            <text class="text-sm font-bold text-zinc-900">
                                {{ $property->bathrooms ?? 0 }}
                            </text>

                            <text class="text-xs text-zinc-500">
                                Bathrooms
                            </text>

                        </column>

                    </column>


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
                            </text>

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

                            <text class="text-sm font-bold text-zinc-900 capitalize">
                                {{ $property->type ?? 'null' }}
                            </text>

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
                    {{ $property->description ?? "Discover this beautifully designed luxury duplex located
                    in the heart of Lekki Phase 1. The property features
                    spacious bedrooms, modern bathrooms, a fully fitted
                    kitchen, ample parking space and a beautifully finished
                    living area." }}
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
                            {{ $property->address }} {{ $property->city }}
                        </text>

                        <text class="text-xs text-zinc-500">
                            {{ $property->state }}, Nigeria
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
                           {{ $property->user?->name }}
                        </text>

                        <text class="text-sm text-zinc-500">
                            Licensed Property Agent
                        </text>

                        <text class="text-xs text-zinc-400">
                            4.9 ★ · {{ $property->count() }} {{ $property->count() == 1 ? 'Property' : 'Properties' }}
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
                            {{ $property->user?->phone }}
                        </text>

                    </column>

                    <pressable class="px-3 py-2 rounded-lg bg-zinc-100" @press="callAgent">

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

                        <text class="text-sm font-semibold text-zinc-900 capitalize">
                            {{ $property->user?->email }}
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