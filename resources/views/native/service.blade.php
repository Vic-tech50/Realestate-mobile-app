<native:scroll-view>

    @php $agreed = false; @endphp

    <native:checkbox label="I agree to the terms" native:model="agreed" />

    <native:text class="text-sm text-theme-on-surface-variant">
        {{ $agreed ? 'Thanks for agreeing!' : 'Tap the box to agree' }}
    </native:text>

    <native:stack class="w-[200] h-[200] rounded-2xl">
    <native:column class="w-full h-full bg-theme-primary rounded-2xl" />
    <native:column class="w-full h-full items-center justify-center">
        <native:text class="text-xl font-bold text-theme-on-primary">Overlay Text</native:text>
    </native:column>
</native:stack>

{{-- A chat bubble with its tail corner squared off toward its sender --}}
<native:column class="rounded-2xl rounded-br-none bg-theme-primary px-4 py-2">
    <native:text class="text-theme-on-primary">Yep — 7pm works</native:text>
</native:column>


@php $activeTab = 0; @endphp

<native:tab-row native:model="activeTab">
    <native:tab label="Recent" icon="history" />
    <native:tab label="Starred" icon="star" />
    <native:tab label="Archived" icon="archive-box" />
</native:tab-row>

    <native:column class="w-full items-center justify-center gap-4 safe-area">
        <native:top-bar title="Dashboard" subtitle="Welcome back">
            <native:top-bar-action id="search" label="Search" icon="search" @tap="openSearch" />
            <native:top-bar-action id="settings" icon="settings" label="Settings"
                url="https://yourapp.com/my-account" />
        </native:top-bar>

        <native:scroll-view class="w-full h-[240] rounded-xl border border-theme-outline">
            <native:column class="w-full p-4 gap-3">
                @foreach (range(1, 20) as $i)
                    <native:text class="text-theme-on-surface-variant">Scrollable row {{ $i }}</native:text>
                @endforeach
            </native:column>
        </native:scroll-view>

        <native:side-nav gestures-enabled="true">
            <native:side-nav-header title="My App" subtitle="user@example.com" icon="person" />

            <native:side-nav-item id="home" label="Home" icon="home" url="/home" :active="true" />

            <native:side-nav-group heading="Account" :expanded="false">
                <native:side-nav-item id="profile" label="Profile" icon="person" url="/profile" />
                <native:side-nav-item id="settings" label="Settings" icon="settings" url="/settings" />
            </native:side-nav-group>

            {{-- <native:horizontal-divider /> --}}

            <native:side-nav-item id="help" label="Help" icon="help" url="https://help.example.com"
                open-in-browser="true" />
        </native:side-nav>

        @php $shippingCountry = null; @endphp

        <native:select label="Country" :options="['United States', 'Canada', 'Mexico']"
            placeholder="Select your country" native:model="shippingCountry" />

            <native:progress-bar :value="20" />


        <native:text class="text-2xl font-extrabold text-red-900 text-center">service center</native:text>

        <native:image src="https://picsum.photos/seed/nativephp/400/300" :width="100" :height="150" :fit="2"
            class="rounded-xl" />

        @php $email = ''; @endphp

        <native:outlined-text-input label="Email" placeholder="you@example.com" native:model="email" keyboard="email"
            leading-icon="email" />

        <native:outlined-text-input label="Email" placeholder="you@example.com" native:model="email" keyboard="number"
            leading-icon="phone" />

        <native:outlined-text-input label="Email" placeholder="you@example.com" native:model="email" keyboard="email"
            leading-icon="email" />

        @php $drag = \Native\Mobile\Edge\SharedValue::make(); @endphp

        {{-- <native:gesture-area :pan-y="$drag">
            <native:column :translate-y="$drag" class="p-6 bg-theme-surface rounded-2xl">
                <native:text>Drag me</native:text>
            </native:column>
        </native:gesture-area> --}}

        @php
            $showDetails = false;
            $description = 'Everything about the selected item goes here.';
        @endphp

        <native:column class="w-full gap-3 items-start">
            <native:button label="View details" @press="$showDetails = true" />

            <native:modal :visible="$showDetails" @dismiss="$showDetails = false">
                <native:column class="w-full h-full p-4 gap-4 safe-area">
                    <native:text class="text-2xl font-bold text-theme-on-surface">Details</native:text>
                    <native:text class="text-base text-theme-on-surface-variant">{{ $description }}</native:text>
                </native:column>
            </native:modal>
        </native:column>

    </native:column>

    <native:column class="w-full h-[200] items-center justify-center">
        <native:activity-indicator size="sm" />
        <native:text class="text-base text-theme-on-surface-variant mt-4">Loading...</native:text>
    </native:column>

    <native:column class="w-full h-[220] p-4 justify-between bg-theme-surface-variant rounded-xl">
        <native:text class="text-theme-on-surface">Top</native:text>
        <native:text class="text-theme-on-surface">Middle</native:text>
        <native:text class="text-theme-on-surface">Bottom</native:text>
    </native:column>
    <native:fab icon="edit" position="start" @tap="compose" class="bg-red-300" />
    {{-- @
    @use('App\Icons\Ios')
    @use('App\Icons\Android') --}}

    {{--
    <native:fab :ios-icon="Ios::Plus" :android-icon="Android::Add" @tap="createTask" /> --}}
    {{-- @php $showSpecs = false; @endphp

    @php $faqs = [
    ['q' => 'How do I reset my password?', 'a' => 'Use the link on the sign-in screen.'],
    ['q' => 'Can I change my plan later?', 'a' => 'Yes — upgrades apply immediately, downgrades at renewal.'],
    ]; @endphp

    <native:column class="w-full gap-0 px-4">
        @foreach ($faqs as $faq)
        <native:accordion>
            <native:accordion-header>
                <native:text class="text-base font-medium">{{ $faq['q'] }}</native:text>
            </native:accordion-header>
            <native:accordion-content>
                <native:text class="text-sm text-theme-on-surface-variant pb-3">{{ $faq['a'] }}</native:text>
            </native:accordion-content>
        </native:accordion>
        <native:divider />
        @endforeach
    </native:column> --}}

    <native:bottom-nav label-visibility="labeled">
        <native:bottom-nav-item id="home" icon="home" label="Home" url="/service" :active="true" />
        <native:bottom-nav-item id="friends" icon="person.3.fill" label="Friends" url="/about" :news="true" />
        <native:bottom-nav-item id="profile" icon="person" label="Profile" url="/profile" badge="3" />
    </native:bottom-nav>



    {{-- <column class="p-4 gap-3 w-full h-full">
        <text class="text-theme-on-surface-variant">First item</text>
        <text class="text-theme-on-surface-variant">Second item</text>
        <text class="text-theme-on-surface-variant">Third item</text>
    </column> --}}

    @php $showActions = false; @endphp

    <native:column class="w-full gap-3 items-start">
        <native:button label="Show actions" @press="$showActions = true" />

        <native:bottom-sheet :visible="$showActions" @dismiss="$showActions = false" detents="small">
            <native:column class="w-full gap-0 pb-8">
                <native:pressable @press="$showActions = false" class="w-full px-4 py-3">
                    <native:row class="gap-3 items-center">
                        <native:icon class="text-theme-on-surface-variant" name="edit" :size="24" />
                        <native:text class="text-base text-theme-on-surface-variant">Edit</native:text>
                    </native:row>
                </native:pressable>
                <native:divider />
                <native:pressable @press="$showActions = false" class="w-full px-4 py-3">
                    <native:row class="gap-3 items-center">
                        <native:icon class="text-theme-on-surface-variant" name="share" :size="24" />
                        <native:text class="text-base text-theme-on-surface-variant">Share</native:text>
                    </native:row>
                </native:pressable>
                <native:divider />
                <native:pressable @press="$showActions = false" class="w-full px-4 py-3">
                    <native:row class="gap-3 items-center">
                        <native:icon name="delete" :size="24" color="#EF4444" />
                        <native:text class="text-base" color="#EF4444">Delete</native:text>
                    </native:row>
                </native:pressable>
            </native:column>
        </native:bottom-sheet>
    </native:column>

    <native:lazy-grid :columns="4" :gap="12" class="w-full">
        @foreach (['star', 'heart', 'bell', 'bookmark', 'camera', 'paperplane', 'flag', 'gearshape'] as $icon)
            <native:column class="items-center p-3 rounded-lg bg-theme-surface-variant">
                <native:icon :ios="$icon" :size="28" />
            </native:column>
        @endforeach
    </native:lazy-grid>

    @php $showSheet = false; @endphp

    <native:column class="w-full gap-3 items-start">
        <native:button label="Open bottom sheet" @press="$showSheet = true" />

        <native:bottom-sheet :visible="$showSheet" @dismiss="$showSheet = false">
            <native:column class="w-full p-4 gap-3">
                <native:text class="text-xl font-bold text-theme-primary">Sheet Title</native:text>
                <native:text class="text-base text-theme-on-surface-variant">Sheet content goes here.</native:text>
                <native:button label="Close" @press="$showSheet = false" />
            </native:column>
        </native:bottom-sheet>
    </native:column>

    <native:column>
        @php $filterVerified = false; @endphp

<native:chip label="Verified" icon="check" native:model="filterVerified" />

@php $filterOnSale = false; @endphp

<native:chip label="On Sale" native:model="filterOnSale" />

<native:text class="text-sm text-theme-on-surface-variant">
    {{ $filterOnSale ? 'Showing sale items only' : 'Showing everything' }}
</native:text>
    </native:column>

    <native:column class="w-full gap-4 p-4">
    <native:text class="text-lg font-bold text-theme-on-surface-variant">Section One</native:text>
    <native:text class="text-theme-on-surface-variant">Some content here.</native:text>
   <native:column class="w-full h-5 bg-theme-outline my-4" />
    <native:text class="text-lg font-bold text-theme-on-surface-variant">Section Two</native:text>
    <native:text class="text-theme-on-surface-variant">More content here.</native:text>
</native:column>


    <native:column class="w-full gap-3 p-4 mt-5">
        
        {{-- @php $planTier = 1; @endphp

        <native:button-group :options="$tiers" native:model="planTier" />

        <native:text class="text-sm text-theme-on-surface-variant">Selected plan: {{ $tiers[$planTier] }}</native:text>
        --}}

        @php $reportRange = 2; @endphp

        <native:button-group :options="['Day', 'Week', 'Month', 'Year']" native:model="reportRange" />

        <native:text class="text-sm text-theme-on-surface-variant">Report range:
            {{ ['Day', 'Week', 'Month', 'Year'][$reportRange] }}
        </native:text>
        <native:button label="Save" variant="primary" @press="save" size="lg" />
        <native:button label="Cancel" variant="secondary" @press="cancel" />
        <native:button label="Delete" variant="destructive" @press="delete" />
        <native:button label="Skip" variant="ghost" @press="skip" />
        <native:button label="Saving..." loading @press="save" />

        <native:button label="Continue" icon="check" icon-trailing="forward" @press="next" />
        @php $period = 0; @endphp

        <native:button-group :options="['Daily', 'Weekly', 'Monthly']" native:model="period"
            a11y-hint="Select time period" />

        <native:text class="text-sm text-theme-on-surface-variant">Showing {{ ['Daily', 'Weekly', 'Monthly'][$period] }}
            stats</native:text>
    </native:column>

    <column class="w-full gap-3 p-4 mt-5">
        <native:row class="gap-3 items-center">
            <native:icon name="star" color="#FBBF24" />
            <native:text class="text-lg text-theme-on-surface">4.8 Rating</native:text>
            <native:text class="text-lg text-theme-on-surface">4.8 Rating</native:text>
        </native:row>
        <native:text class="text-lg text-theme-on-surface">4.8 Rating</native:text>
        <native:row class="w-full justify-between items-center">
            <native:text class="text-base text-theme-on-surface-variant">Status</native:text>
            <native:row class="gap-1 items-center">
                <native:icon name="check" color="#22C55E" :size="16" />
                <native:text class="text-base font-semibold text-green-500">Active</native:text>
            </native:row>
        </native:row>

        <native:row class="w-full px-4 py-2 items-center">
            <native:text class="text-xl font-bold text-theme-on-surface">Title</native:text>
            <native:spacer />
            <native:icon name="search" :size="24" class="text-theme-on-surface" />
        </native:row>

        {{-- <native:canvas :width="200" :height="200" class="p-4 bg-theme-surface-variant rounded-2xl">
            <native:rect :width="100" :height="100" class="bg-theme-primary rounded-lg" />
            <native:circle :width="50" :height="50" bg="#EF4444" />
        </native:canvas> --}}
    </column>

    <native:lazy-grid :columns="4" :gap="1" class="w-full">
    @foreach (['star', 'heart', 'bell', 'bookmark', 'camera', 'paperplane', 'flag', 'gearshape'] as $icon)
        <native:column class="items-center p-3 rounded-lg bg-theme-surface-variant">
            <native:icon :ios="$icon" :size="28" />
        </native:column>
    @endforeach
</native:lazy-grid>



</native:scroll-view>