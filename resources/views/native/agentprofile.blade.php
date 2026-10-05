<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">
    <column class="w-full gap-5 p-4 pb-8">

        {{-- Profile Header Card --}}
        <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4 shadow-sm">

            <row class="w-full items-center gap-4">

                {{-- Avatar --}}
                <column class="w-16 h-16 rounded-full bg-green-900 dark:bg-green-800 items-center justify-center">
                    <text class="text-xl font-extrabold text-white">
                        {{ strtoupper(substr($user['name'] ?? 'A', 0, 1)) }}
                    </text>
                </column>

                {{-- Name --}}
                <column class="flex-1 gap-1">
                    <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
                        {{ $user['name'] ?? 'Agent User' }}
                    </text>

                    <text class="text-sm font-medium text-zinc-500 dark:text-zinc-400 capitalize">
                        {{ $user['role'] ?? 'Property Agent' }}
                    </text>
                </column>

                {{-- Edit --}}
                <pressable
                    class="rounded-xl bg-green-950 dark:bg-green-800 px-3 py-2"
                    @press="edit"
                >
                    <text class="text-xs font-bold text-white">
                        Edit Your Profile
                    </text>
                </pressable>

            </row>

            {{-- Stats --}}
            <row class="w-full gap-3">

                <column class="flex-1 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900 dark:text-white">
                        24
                    </text>
                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Listings
                    </text>
                </column>

                <column class="flex-1 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900 dark:text-white">
                        18
                    </text>
                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Leads
                    </text>
                </column>

                <column class="flex-1 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900 dark:text-white">
                        4.9
                    </text>
                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        Rating
                    </text>
                </column>

            </row>

        </column>


        {{-- Contact Information --}}
        <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Contact Information
            </text>

            <column class="w-full gap-3">

                {{-- Email --}}
                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3">

                    <column class="w-10 h-10 rounded-xl bg-green-900 dark:bg-green-800 items-center justify-center">
                        <text class="text-sm font-bold text-white">
                            @
                        </text>
                    </column>

                    <column class="flex-1">

                        <text class="text-xs uppercase text-zinc-500 dark:text-zinc-400">
                            Email
                        </text>

                        <text class="text-sm font-semibold text-zinc-900 dark:text-white capitalize">
                            {{ $user['email'] ?? 'agent@example.com' }}
                        </text>

                    </column>

                </row>


                {{-- Phone --}}
                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3">

                    <column class="w-10 h-10 rounded-xl bg-green-900 dark:bg-green-800 items-center justify-center">
                        <text class="text-sm font-bold text-white">
                            ☎
                        </text>
                    </column>

                    <column class="flex-1">

                        <text class="text-xs uppercase text-zinc-500 dark:text-zinc-400">
                            Phone
                        </text>

                        <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                            {{ $user['phone'] ?? '+234 800 000 0000' }}
                        </text>

                    </column>

                </row>


                {{-- Office --}}
                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 p-3">

                    <column class="w-10 h-10 rounded-xl bg-green-900 dark:bg-green-800 items-center justify-center">
                        <text class="text-sm font-bold text-white">
                            ⌂
                        </text>
                    </column>

                    <column class="flex-1">

                        <text class="text-xs uppercase text-zinc-500 dark:text-zinc-400">
                            Office
                        </text>

                        <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                            Lekki Phase 1, Lagos
                        </text>

                    </column>

                </row>

            </column>

        </column>


        {{-- Account Details --}}
        <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Account Details
            </text>


            {{-- Membership --}}
            <row class="w-full items-center justify-between py-2 border-b border-zinc-200 dark:border-zinc-800">

                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Membership
                </text>

                <text class="text-sm font-bold text-zinc-900 dark:text-white">
                    Premium Agent
                </text>

            </row>

            <native:divider />


            {{-- Verification --}}
            <row class="w-full items-center justify-between py-2 border-b border-zinc-200 dark:border-zinc-800">

                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Verification
                </text>

                <pressable 
                @navigate.slideFromBottom='/verifyagent'
                >

                    <text class="text-sm font-bold text-red-600 dark:text-red-400 underline">
                        Not Verified
                    </text>

                </pressable>

            </row>

            <native:divider />


            {{-- Status --}}
            <row class="w-full items-center justify-between py-2">

                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Status
                </text>

                <text class="text-sm font-bold text-green-900 dark:text-green-400">
                    Active
                </text>

            </row>

        </column>


        {{-- Action Buttons --}}
        <column class="w-full gap-3">

            {{-- Dashboard --}}
            <native:button
                @press="navigate('/agentdashboard')"
                class="w-full rounded-2xl text-green-900 dark:text-green-500 py-4 items-center justify-center"
                size="lg"
                variant="ghost"
            >
                View Dashboard
            </native:button>


            {{-- Logout --}}
            <native:button
                @press="logout"
                size="lg"
                variant="destructive"
                icon="exit"
                class="w-full h-[50px] rounded-0 mb-4 text-white"
            >
                Logout
            </native:button>

        </column>

    </column>
</native:scroll-view>