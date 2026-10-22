<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">
{{-- Dashboard Header --}}
<column class="w-full gap-4">

    <row class="w-full items-center justify-between gap-3">

        <column class="flex-1 gap-1">
            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Welcome back 👋
            </text>

            <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                {{ $user['name'] ?? 'Agent' }}
            </text>

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Here's how your properties are performing.
            </text>
        </column> 

        <pressable
            @press="addProperty"
            class="w-12 h-12 rounded-2xl bg-green-800 items-center justify-center"
        >
            <text class="text-2xl font-bold text-white">+</text>
        </pressable>

    </row>

    {{-- Dashboard Summary --}}
    <column class="w-full rounded-3xl bg-green-950 p-5 gap-4">

        <column class="gap-1">
            <text class="text-sm text-green-200">
                Your Property Portfolio
            </text>

            <text class="text-3xl font-extrabold text-white">
                {{ number_format($properties->count()) }}
            </text>

            <text class="text-xs text-green-200">
                Total listed properties
            </text>
        </column>

        <column class="w-full h-px bg-white/20"></column>

        <row class="w-full justify-between gap-3">

            <column class="flex-1 gap-1">
                <text class="text-xs text-green-200">Active Listings</text>
                <text class="text-xl font-bold text-white">
                    {{ $properties->where('status', 'active')->count() }}
                </text>
            </column>

            <column class="flex-1 gap-1">
                <text class="text-xs text-green-200">Total Views</text>
                <text class="text-xl font-bold text-white">
                    {{ number_format($properties->sum('views_count')) }}
                </text>
            </column>

            <column class="flex-1 gap-1">
                <text class="text-xs text-green-200">Total Likes</text>
                <text class="text-xl font-bold text-white">
                    {{ number_format($properties->sum('likes_count')) }}
                </text>
            </column>

        </row>

    </column>

    {{-- Contact Engagement --}}
    <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
        Contact Engagement
    </text>

    <row class="w-full gap-2">

        <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-3 gap-2">
            <text class="text-xl">☎</text>
            <text class="text-xl font-extrabold text-zinc-900 dark:text-white">
                {{ number_format($properties->sum('call_clicks')) }}
            </text>
            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                Call clicks
            </text>
        </column>

        <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-3 gap-2">
            <text class="text-xl">💬</text>
            <text class="text-xl font-extrabold text-zinc-900 dark:text-white">
                {{ number_format($properties->sum('whatsapp_clicks')) }}
            </text>
            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                WhatsApp
            </text>
        </column>

        <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-3 gap-2">
            <text class="text-xl">✉</text>
            <text class="text-xl font-extrabold text-zinc-900 dark:text-white">
                {{ number_format($properties->sum('email_clicks')) }}
            </text>
            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                Email clicks
            </text>
        </column>

    </row>

</column>

{{-- My Properties Header --}}
<row class="w-full items-center justify-between gap-3 mt-5">

    <column class="flex-1 gap-1 my-5">
        <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
            My Properties
        </text>

        <text class="text-xs text-zinc-500 dark:text-zinc-400">
            Manage your listings and track interest.
        </text>
    </column>

    {{-- <pressable
        @press="addProperty"
        class="rounded-xl bg-green-800 px-4 py-3"
    >
        <text class="text-sm font-bold text-white">
            + Add
        </text>
    </pressable> --}}

</row>

@if ($properties->isEmpty())

    {{-- Empty State --}}
    <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-6 items-center gap-4">

        <column class="w-16 h-16 rounded-2xl bg-green-50 dark:bg-green-950 items-center justify-center">
            <text class="text-3xl">🏠</text>
        </column>

        <text class="text-xl font-extrabold text-zinc-900 dark:text-white">
            Your listings start here
        </text>

        <text class="text-sm text-zinc-500 dark:text-zinc-400 text-center">
            Add your first property and start connecting with potential clients.
        </text>

        <pressable
            @press="addProperty"
            class="w-full rounded-xl bg-green-800 py-4 items-center"
        >
            <text class="text-sm font-bold text-white">
                + Add Your First Property
            </text>
        </pressable>

    </column>

@else

    <native:scroll-view
        axis="horizontal"
        :shows-indicators="true"
    >
        <row class="gap-3 p-1">

            @foreach ($properties as $property)

                <column
                    class="w-[320px] rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 overflow-hidden"
                >

                    {{-- Property Image --}}
                    <column class="w-full relative">

                        <native:image
                            src="{{ $property->thumbnail ?: 'https://picsum.photos/seed/property-'.$property->id.'/800/600' }}"
                            :height="190"
                            :fit="2"
                            class="w-full object-cover bg-zinc-200 dark:bg-zinc-800"
                        />

                        {{-- Listing Type --}}
                        <text class="absolute top-3 left-3 rounded-full bg-black/60 px-3 py-1 text-xs font-bold text-white capitalize">
                            {{ $property->type }}
                        </text>

                        @php 

                        $statusClass = match ($property->status) {
                            'available' => 'bg-green-700',
                            'sold' => 'bg-blue-700',
                            'rented' => 'bg-purple-700',
                            'pending' => 'bg-yellow-700',
                            'rejected' => 'bg-red-700',
                            default => 'bg-zinc-700',
                        };

                        @endphp

                        {{-- Status --}}
                        <text class="absolute top-3 right-3 rounded-full {{ $statusClass }} px-3 py-1 text-xs font-bold text-white capitalize">
                            {{ $property->status ?? 'Pending' }}
                        </text>

                        {{-- Views --}}
                        <text class="absolute bottom-3 right-3 rounded-full bg-black/70 px-3 py-1 text-xs font-bold text-white">
                            👁 {{ number_format($property->views_count ?? 0) }}
                        </text>

                    </column>

                    {{-- Property Information --}}
                    <column class="w-full p-4 gap-3">

                        <column class="gap-1">

                            <text class="text-base font-extrabold text-zinc-900 dark:text-white capitalize">
                                {{ $property->title }}
                            </text>

                            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                                {{ $property->address }}
                                {{ $property->city }}, {{ $property->state }}
                            </text>

                        </column>

                        {{-- Price --}}
                        <column class="rounded-xl bg-green-50 dark:bg-green-950 p-3 gap-1">

                            <text class="text-xs text-green-800 dark:text-green-300">
                                {{ $property->listing_type }}
                            </text>

                            <text class="text-xl font-extrabold text-green-900 dark:text-green-200">
                                ₦{{ number_format((float) $property->price, 2) }}
                            </text>

                        </column>

                        {{-- Property Features --}}
                        <row class="w-full items-center justify-between gap-2">

                            <column class="flex-1 gap-1">
                                <text class="text-sm">🛏</text>
                                <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                    {{ $property->bedrooms ?? 0 }} Beds
                                </text>
                            </column>

                            <column class="flex-1 gap-1">
                                <text class="text-sm">🚿</text>
                                <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                    {{ $property->bathrooms ?? 0 }} Baths
                                </text>
                            </column>

                            <column class="flex-1 gap-1">
                                <text class="text-sm">📐</text>
                                <text class="text-xs text-zinc-600 dark:text-zinc-400">
                                    {{ $property->size ?? 'N/A' }}
                                    {{ $property->size_unit ?? 'sqft' }}
                                </text>
                            </column>

                        </row>

                        <column class="w-full h-px bg-zinc-100 dark:bg-zinc-800"></column>

                        {{-- Engagement --}}
                        <text class="text-sm font-extrabold text-zinc-900 dark:text-white">
                            Listing Performance
                        </text>

                        <row class="w-full gap-2">

                            <column class="flex-1 rounded-xl bg-zinc-50 dark:bg-zinc-800 p-3 gap-1">
                                <text class="text-base">❤️</text>
                                <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                                    {{ number_format($property->likes_count ?? 0) }}
                                </text>
                                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                                    Likes
                                </text>
                            </column>

                            <column class="flex-1 rounded-xl bg-zinc-50 dark:bg-zinc-800 p-3 gap-1">
                                <text class="text-base">☎</text>
                                <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                                    {{ number_format($property->call_clicks ?? 0) }}
                                </text>
                                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                                    Calls
                                </text>
                            </column>

                        </row>

                        <row class="w-full gap-2">

                            <column class="flex-1 rounded-xl bg-zinc-50 dark:bg-zinc-800 p-3 gap-1">
                                <text class="text-base">💬</text>
                                <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                                    {{ number_format($property->whatsapp_clicks ?? 0) }}
                                </text>
                                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                                    WhatsApp
                                </text>
                            </column>

                            <column class="flex-1 rounded-xl bg-zinc-50 dark:bg-zinc-800 p-3 gap-1">
                                <text class="text-base">✉</text>
                                <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                                    {{ number_format($property->email_clicks ?? 0) }}
                                </text>
                                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                                    Emails
                                </text>
                            </column>

                        </row>

                        {{-- Actions --}}
                        <pressable
                            @press="editProperty({{ $property->id }})"
                            class="w-full rounded-xl bg-green-800 py-3 items-center justify-center"
                        >
                            <text class="text-sm font-bold text-white">
                                Edit Property
                            </text>
                        </pressable>

                        <pressable
                            @press="confirmDelete({{ $property->id }})"
                            class="w-full rounded-xl bg-red-50 dark:bg-red-950 py-3 items-center justify-center"
                        >
                            <text class="text-sm font-bold text-red-700 dark:text-red-300">
                                Delete Property
                            </text>
                        </pressable>

                    </column>

                </column>

            @endforeach

        </row>
    </native:scroll-view>

@endif

{{-- Quick Actions --}}
<column class="w-full gap-3">

    <column class="gap-1 my-5">
        <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
            Quick Actions
        </text>

        <text class="text-xs text-zinc-500 dark:text-zinc-400">
            Shortcuts to manage your account and listings.
        </text>
    </column>

    <pressable
        @press="addProperty"
        class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4"
    >
        <row class="items-center gap-3">

            <column class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-950 items-center justify-center">
                <text class="text-2xl text-green-800 dark:text-green-300">+</text>
            </column>

            <column class="flex-1 gap-1">
                <text class="text-sm font-bold text-zinc-900 dark:text-white">
                    Add a Property
                </text>

                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                    Create a new property listing.
                </text>
            </column>

            <text class="text-lg text-zinc-400">›</text>

        </row>
    </pressable>

</column>

</native:scroll-view>