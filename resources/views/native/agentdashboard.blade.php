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
                                    class="absolute bottom-3 left-3 rounded-full bg-black/50 px-3 py-1 text-xs font-semibold text-white"
                                >
                                    {{ $property->type }}
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
                                            {{ $property->size }} {{ $property->size_unit }}
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