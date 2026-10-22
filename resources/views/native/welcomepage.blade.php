
<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">

    <column class="w-full min-h-full p-5 gap-5">

        {{-- Brand --}}
        <row class="w-full items-center gap-3">

            <column class="w-12 h-12 rounded-2xl bg-green-950 dark:bg-green-800 items-center justify-center">
                <text class="text-2xl font-black text-white">⌂</text>
            </column>

            <column class="flex-1 gap-0">
                <text class="text-lg font-black text-green-950 dark:text-white">
                    VICTECH HOMES
                </text>

                <text class="text-xs font-semibold tracking-widest text-zinc-500 dark:text-zinc-400">
                    AGENT PORTAL
                </text>
            </column>

        </row>


        {{-- Welcome Hero --}}
        <column class="w-full rounded-3xl bg-green-950 dark:bg-green-900 p-5 gap-4">

            {{-- <column class="w-14 h-14 rounded-2xl bg-white/15 items-center justify-center">
                <text class="text-3xl text-white">⌂</text>
            </column> --}}

            <text class="text-3xl font-black text-white">
                Welcome to a smarter way to sell property.
            </text>

            <text class="text-sm leading-6 text-green-100">
                Your real estate journey starts here. Showcase properties,
                connect with clients, and grow your business from one place.
            </text>

            <row class="w-full gap-2">

                <column class="flex-1 rounded-xl bg-white/10 border border-white/15 p-3 gap-1">
                    <text class="text-lg font-black text-white">01</text>
                    <text class="text-xs font-medium text-green-100">
                        List Properties
                    </text>
                </column>

                <column class="flex-1 rounded-xl bg-white/10 border border-white/15 p-3 gap-1">
                    <text class="text-lg font-black text-white">02</text>
                    <text class="text-xs font-medium text-green-100">
                        Find Clients
                    </text>
                </column>

                <column class="flex-1 rounded-xl bg-white/10 border border-white/15 p-3 gap-1">
                    <text class="text-lg font-black text-white">03</text>
                    <text class="text-xs font-medium text-green-100">
                        Grow Your Business
                    </text>
                </column>

            </row>

        </column>


        {{-- Benefits --}}
        <column class="w-full gap-4">

            <text class="text-xl font-extrabold text-zinc-950 dark:text-white">
                Everything you need to get started
            </text>

            <row class="w-full items-center gap-3">

                <column class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-xl text-green-900 dark:text-green-400">⌂</text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        Showcase Your Listings
                    </text>

                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Present properties to people looking for their next home.
                    </text>
                </column>

            </row>

            <row class="w-full items-center gap-3">

                <column class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-xl text-green-900 dark:text-green-400">◎</text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        Connect with Clients
                    </text>

                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Make it easier for interested buyers and tenants to reach you.
                    </text>
                </column>

            </row>

            <row class="w-full items-center gap-3">

                <column class="w-12 h-12 rounded-2xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-xl text-green-900 dark:text-green-400">↗</text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        Manage Your Business
                    </text>

                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Keep your listings and agent profile organized.
                    </text>
                </column>

            </row>

        </column>


        {{-- Bottom Actions --}}
        <column class="w-full gap-3 pt-3">

            <native:button
                label="Create Agent Account"
                @press="navigate('/agent')"
                size="lg"
                class="w-full h-[54px] rounded-2xl bg-green-950 dark:bg-green-700 text-white"
            />

            <native:button
                label="Sign In to Your Account"
                @press="navigate('/login')"
                size="lg"
                variant="outline"
                class="w-full h-[54px] rounded-2xl"
            />

            <text class="w-full text-center text-xs text-zinc-500 dark:text-zinc-400">
                By continuing, you agree to our Terms of Service and Privacy Policy.
            </text>

        </column>

        
 


    </column>
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
</native:scroll-view>
