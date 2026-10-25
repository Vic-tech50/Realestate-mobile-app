<native:refreshable @refresh="loadLatest" class="flex-1 w-full bg-zinc-50 dark:bg-zinc-950 safe-area">
    <column class="w-full p-4 gap-5">

        {{-- Header --}}
        <native:row class="gap-3 items-center ios:justify-between">

            <column class="w-full gap-1">
                <text class="text-3xl font-extrabold text-zinc-900 dark:text-white">
                    Properties
                </text>

                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Find your perfect home
                </text>
            </column>

            <column>

                <native:button
                    label="Become An Agent"
                    @press="agent"
                    class="cursor-pointer bg-linear-to-b from-indigo-500 to-indigo-600 shadow-[0px_4px_32px_0_rgba(99,102,241,.70)] px-6 py-3 rounded-xl border border-slate-500 dark:border-slate-700 text-white font-medium group"
                />

            </column>

        </native:row>


        {{-- Search / Filter --}}
        <row class="w-full items-center gap-3">
            <row class="flex-1 items-center gap-2">
                <native:outlined-text-input
                    placeholder="Search by title, city, agent..."
                    native:model.live="search"
                    keyboard="text"
                    class="w-full"
                    leading-icon="search"
                />
            </row>
        </row>


        {{-- Section Header --}}
        <row class="w-full items-center justify-between">

            <text class="text-lg font-bold text-zinc-900 dark:text-white">
                Featured Properties
            </text>

            <text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                See all
            </text>

        </row>

        {{-- Property Cards --}}
        @if ($properties->isEmpty())
            <column class="w-full items-center justify-center rounded-3xl border border-dashed border-zinc-300 bg-white px-5 py-8 dark:border-zinc-700 dark:bg-zinc-900">
                <text class="text-lg font-bold text-zinc-900 dark:text-white">
                    No properties found
                </text>
                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Try another title, city, or agent name.
                </text>
            </column>
        @else
        @foreach($properties as $property)

        <pressable
            class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden"
            {{-- @press="viewProperty({{ $property->id }})" --}}
        >

            {{-- Property Image --}}
            <column class="w-full relative">

                <native:image
                    src="{{ $property->thumbnail ?: 'https://picsum.photos/seed/property-'.$property->id.'/800/600' }}"
                    :height="220"
                    :fit="2"
                    class="w-full object-cover bg-zinc-200 dark:bg-zinc-800"
                />


                 <text class="absolute top-3 right-3 rounded-full {{ $property->status === 'available' ? 'bg-green-700' :  'bg-zinc-700' }} px-3 py-1 text-xs font-bold text-white capitalize">
                            {{ $property->status ?? 'Pending' }}
                        </text>
                {{-- Favorite --}}
                {{-- <pressable
                    class="absolute top-3 right-3 w-10 h-10 rounded-full bg-black/40 dark:bg-black/60 items-center justify-center"
                >
                    <text class="text-xl text-white">
                        ♡
                    </text>
                </pressable> --}}


                {{-- Property Type --}}
                <text
                    class="absolute bottom-3 left-3 rounded-full bg-black/50 dark:bg-black/70 px-3 capitalize py-1 text-xs font-semibold text-white"
                >
                    {{ $property->type }}
                </text>

            </column>


            {{-- Card Content --}}
            <column class="w-full p-4 gap-3">


                {{-- Title + Price --}}
                <row class="w-full items-start justify-between gap-3">

                    <column class="flex-1 gap-1">

                        <text class="text-lg font-bold text-zinc-900 dark:text-white">
                            {{ $property->title }}
                        </text>

                        <text class="text-sm text-zinc-500 dark:text-zinc-400">
                            {{ $property->address }} {{ $property->city }},{{ $property->state }}
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

                        <text class="text-xs text-zinc-600 dark:text-zinc-400 capitalize">
                            {{ $property->size }} {{ $property->size_unit ?? 'sqft' }}
                        </text>

                    </row>

                </row>


                {{-- Divider --}}
                <column class="w-full h-px bg-zinc-100 dark:bg-zinc-800"></column>


                {{-- Footer --}}
                <row class="w-full items-center justify-between">

                    <row class="items-center gap-2">

                        <column
                            class="w-8 h-8 rounded-full bg-zinc-200 dark:bg-zinc-700 items-center justify-center"
                        >
                            <text class="text-xs font-bold text-zinc-600 dark:text-zinc-300">
                                {{ Str::charAt(Str::trim($property->user->name ?? 'No Agent'), 0) ?? 'U' }}
                            </text>
                        </column>


                        <column>

                            <text class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">
                                {{ $property->user->name ?? 'No Agent' }}
                            </text>

                            <text class="text-[11px] text-zinc-400 dark:text-zinc-500">
                                Listed {{ $property->created_at->diffForHumans() }}
                            </text>

                        </column>

                    </row>


                    {{-- View Button --}}
                    <pressable
                        @press="viewProperty({{$property->id }})"
                        class="rounded-xl bg-green-950 dark:bg-green-800 px-4 py-2"
                    >
                        <text class="text-xs font-bold text-white">
                            View
                        </text>
                    </pressable>

                </row>

            </column>

        </pressable>

        @endforeach
        @endif
    </column>

    <native:fab icon="chat" @tap="askai" label="AI Bot" size="large" bottom-offset="30"  edge-offset="30" />
</native:refreshable>