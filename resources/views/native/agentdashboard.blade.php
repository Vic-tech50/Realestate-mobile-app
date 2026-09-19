<native:scroll-view class="w-full h-full bg-zinc-50 safe-area">


    <column class="w-full gap-5" padding="16">

        {{-- Header --}}
        <column class="w-full gap-1">

            <text class="text-sm text-zinc-500">
                Welcome back,
            </text>

            <text class="text-2xl font-extrabold text-zinc-900">
                {{ $user['name'] ?? 'Agent' }} 
                {{-- Authenticated data --}}
            </text>

            <text class="text-sm text-zinc-500">
                Manage your properties and listings.
            </text>

        </column>


        {{-- Statistics --}}
        <row class="w-full gap-3">

            {{-- Total Properties --}}
            <column class="flex-1 rounded-2xl bg-white border border-zinc-200 p-4 gap-1">

                <text class="text-xs font-medium text-zinc-500">
                    Properties
                </text>

                <text class="text-2xl font-extrabold text-zinc-900">
                    {{ $properties->count() ?? '0' }}
                </text>

            </column>


            {{-- Active --}}
            <column class="flex-1 rounded-2xl bg-white border border-zinc-200 p-4 gap-1">

                <text class="text-xs font-medium text-zinc-500">
                    Active
                </text>

                <text class="text-2xl font-extrabold text-zinc-900">
                    {{ $properties->where('status', 'active')->count() ?? 0 }}
                </text>

            </column>

        </row>


        {{-- No Properties --}}
        @if ($properties->isEmpty())

            <column
                class="w-full rounded-2xl bg-white border border-zinc-200 p-6 items-center justify-center gap-4" :elevation="4"
            >

                {{-- Icon --}}
                <column
                    class="w-16 h-16 rounded-full bg-zinc-100 items-center justify-center"
                >
                    <text class="text-3xl">
                        🏠
                    </text>
                </column>


                {{-- Title --}}
                <text class="text-xl font-extrabold text-zinc-900 text-center">
                    No Properties Yet
                </text>


                {{-- Description --}}
                <text class="text-sm text-zinc-500 text-center">
                    You haven't added any properties yet.
                    Add your first property to start reaching potential clients.
                </text>


                {{-- Add Property --}}
                <pressable
                    @press="addProperty"
                    class="w-full rounded-xl bg-black py-4 items-center justify-center"
                >
                    <text class="text-base font-bold text-white">
                        + Add Property
                    </text>
                </pressable>

            </column>

        @else

            {{-- Properties Header --}}
            <row class="w-full items-center justify-between">

                <text class="text-lg font-extrabold text-zinc-900">
                    My Properties
                </text>

                <pressable
                    @press="addProperty"
                    class="rounded-lg bg-black px-3 py-2"
                >
                    <text class="text-xs font-bold text-white">
                        + Add
                    </text>
                </pressable>

            </row>


            {{-- Property List --}}
            <native:scroll-view  axis="horizontal" :shows-indicators="true" scroll-anchor="bottom">
            <row :gap="10"  class="w-full h-[400px] p-2" >
              

                @foreach ($properties as $property)

 <pressable
            class="w-full rounded-3xl bg-white border border-zinc-200 overflow-hidden"
            {{-- @press="viewProperty({{ $property->id }})" --}}
        >

            {{-- Property Image --}}
            <column class="w-full relative">

                <native:image
                    src="https://picsum.photos/seed/property1/800/600"
                    :height="220"
                    :fit="2"
                    class="w-full object-cover bg-zinc-200"
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

                        <text class="text-lg font-bold text-zinc-900 capitalize">
                           {{ $property->title }}
                        </text>

                        <text class="text-sm text-zinc-500">
                            {{ $property->address }} {{ $property->city }},{{ $property->state }}
                        </text>

                    </column>

                    <column class="items-end">

                        <text class="text-lg font-extrabold text-zinc-900">
                           &#8358;{{Number::format($property->price, precision: 2)  ?? 0.00}}
                        </text>

                        <text class="text-xs text-zinc-400">
                            {{ $property->listing_type }}
                        </text>

                    </column>

                </row>


                {{-- Property Features --}}
                <row class="w-full items-center gap-4">

                    <row class="items-center gap-1">
                        <text class="text-sm">🛏</text>

                        <text class="text-xs text-zinc-600">
                            {{ $property->bedrooms ?? 'No' }} Beds
                        </text>
                    </row>

                    <row class="items-center gap-1">
                        <text class="text-sm">🚿</text>

                        <text class="text-xs text-zinc-600">
                            {{ $property->bathrooms ?? 'No' }} Baths
                        </text>
                    </row>

                    <row class="items-center gap-1">
                        <text class="text-sm">📐</text>

                        <text class="text-xs text-zinc-600">
                            {{ $property->size }} m²
                        </text>
                    </row>

                </row>


                {{-- Divider --}}
                <column class="w-full h-px bg-zinc-100"></column>


                {{-- Footer --}}
                <row class="w-full items-center justify-between">

                    
                     <pressable @press="viewProperty({{$property->id }})"
                        class="rounded-xl bg-red-500 px-4 py-2"
                    >
                        <text class="text-xs font-bold text-white">
                            Delete Property
                        </text>
                    </pressable>

                    


                    <pressable @press="editProperty({{$property->id }})"
                        class="rounded-xl bg-zinc-900 px-4 py-2"
                    >
                        <text class="text-xs font-bold text-white">
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

            <text class="text-lg font-extrabold text-zinc-900">
                Quick Actions
            </text>

            <row class="w-full gap-3">

                <pressable
                    @press="addProperty"
                    class="flex-1 rounded-xl bg-white border border-zinc-200 p-4 items-center justify-center"
                >
                    <text class="text-xl">
                        +
                    </text>

                    <text class="text-sm font-bold text-zinc-900">
                        Add Property
                    </text>
                </pressable>


                <pressable
                    {{-- @press="agentprofile" --}}
                    class="flex-1 rounded-xl bg-white border border-zinc-200 p-4 items-center justify-center"
                >
                    <text class="text-xl">
                        👤
                    </text>

                    <text class="text-sm font-bold text-zinc-900">
                        My Profile
                    </text>
                </pressable>

            </row>

        </column>

    </column>

     

    

</native:scroll-view>



