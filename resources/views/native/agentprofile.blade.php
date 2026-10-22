
<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">
    <column class="w-full gap-5 p-4 pb-10">

        {{-- Page Heading --}}
        <column class="w-full gap-1">
            <text class="text-sm font-semibold text-green-800 dark:text-green-400">
                AGENT ACCOUNT
            </text>

            <text class="text-3xl font-black text-zinc-950 dark:text-white">
                My Profile
            </text>

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Manage your personal information and account.
            </text>
        </column>


        {{-- Profile Hero --}}
        <column class="w-full rounded-3xl bg-green-950 p-5 gap-5">

            <row class="w-full items-center gap-4">

                {{-- Avatar --}}
                <column class="w-[72px] h-[72px] rounded-2xl bg-white/15 border border-white/20 items-center justify-center">
                    <text class="text-3xl font-black text-white">
                        {{ strtoupper(substr($user['name'] ?? 'A', 0, 1)) }}
                    </text>
                </column>

                {{-- Name and Role --}}
                <column class="flex-1 gap-1">
                    <text class="text-xl font-extrabold text-white">
                        {{ $user['name'] ?? 'Agent User' }}
                    </text>

                    <text class="text-sm text-green-100 capitalize">
                        {{ $user['role'] ?? 'Property Agent' }}
                    </text>

                    <row class="items-center gap-1 mt-1">
                        <column class="w-2 h-2 rounded-full bg-green-400" />
                        <text class="text-xs font-semibold text-green-200">
                            Account Active
                        </text>
                    </row>
                </column>

            </row>

            {{-- Edit Profile Button --}}
            <pressable
                class="w-full rounded-xl bg-white py-3 items-center justify-center"
                @press="edit"
            >
                <text class="text-sm font-extrabold text-green-950">
                    Edit Profile
                </text>
            </pressable>

        </column>


        {{-- Account Overview --}}
        <column class="w-full gap-3">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Account Overview
            </text>

            <row class="w-full gap-3">

                {{-- Listings --}}
                <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-3">
                    <column class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-950 items-center justify-center">
                        <text class="text-lg font-black text-green-900 dark:text-green-400">
                            H
                        </text>
                    </column>

                    <text class="text-2xl font-black text-zinc-950 dark:text-white">
                        {{ $totalListings ?? 0 }}
                    </text>

                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        Listings
                    </text>
                </column>

                {{-- Leads --}}
                <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-3">
                    <column class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-950 items-center justify-center">
                        <text class="text-lg font-black text-blue-800 dark:text-blue-400">
                            L
                        </text>
                    </column>

                    <text class="text-2xl font-black text-zinc-950 dark:text-white">
                        {{ $totalLeads ?? 0 }}
                    </text>

                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        Leads
                    </text>
                </column>

                {{-- Verification --}}
                <column class="flex-1 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-3">
                    <column class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950 items-center justify-center">
                        <text class="text-lg font-black text-amber-800 dark:text-amber-400">
                            V
                        </text>
                    </column>

                    <text class="text-sm font-black text-zinc-950 dark:text-white">
                        {{ !empty($user['verified_at']) ? 'Verified' : 'Pending' }}
                    </text>

                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        Identity
                    </text>
                </column>

            </row>
        </column>


        {{-- Contact Information --}}
        <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4">

            <column class="gap-1">
                <text class="text-lg font-extrabold text-zinc-950 dark:text-white">
                    Contact Information
                </text>

                <text class="text-sm text-zinc-500 dark:text-zinc-400">
                    Your contact details for clients.
                </text>
            </column>

            {{-- Email --}}
            <row class="w-full items-center gap-3">
                <column class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-lg font-bold text-green-900 dark:text-green-400">
                        @
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        EMAIL ADDRESS
                    </text>

                    <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                        {{ $user['email'] ?? 'No email added' }}
                    </text>
                </column>
            </row>

            <native:divider />

            {{-- Phone --}}
            <row class="w-full items-center gap-3">
                <column class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-lg font-bold text-green-900 dark:text-green-400">
                        ☎
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        PHONE NUMBER
                    </text>

                    <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                        {{ $user['phone'] ?? 'No phone number added' }}
                    </text>
                </column>
            </row>

            <native:divider />

            {{-- Office Location --}}
            <row class="w-full items-center gap-3">
                <column class="w-11 h-11 rounded-xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-lg font-bold text-green-900 dark:text-green-400">
                        ⌂
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        OFFICE LOCATION
                    </text>

                    <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                        {{ $user['office_address'] ?? 'No office address added' }}
                    </text>
                </column>
            </row>

        </column>


        {{-- Account Details --}}
        <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4">

            <text class="text-lg font-extrabold text-zinc-950 dark:text-white">
                Account Details
            </text>

            {{-- Membership --}}
            <row class="w-full items-center gap-3">
                <column class="w-10 h-10 rounded-xl bg-zinc-100 dark:bg-zinc-800 items-center justify-center">
                    <text class="text-base font-black text-zinc-700 dark:text-zinc-300">
                        M
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        MEMBERSHIP
                    </text>

                    <text class="text-sm font-bold text-zinc-900 dark:text-white">
                        {{ $user['membership'] ?? 'Standard Agent' }}
                    </text>
                </column>
            </row>

            <native:divider />

            {{-- Verification --}}
            <pressable
                class="w-full"
                @navigate.slideFromBottom='/verifyagent'
            >
                <row class="w-full items-center gap-3">
                    <column class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-950 items-center justify-center">
                        <text class="text-base font-black text-amber-800 dark:text-amber-400">
                            !
                        </text>
                    </column>

                    <column class="flex-1 gap-1">
                        <text class="text-xs text-zinc-500 dark:text-zinc-400">
                            IDENTITY VERIFICATION
                        </text>

                        <text class="text-sm font-bold text-zinc-900 dark:text-white">
                            {{ !empty($user['verified_at']) ? 'Your account is verified' : 'Complete verification' }}
                        </text>
                    </column>

                    <text class="text-lg font-bold text-zinc-400">
                        ›
                    </text>
                </row>
            </pressable>

            <native:divider />

            {{-- Account Status --}}
            <row class="w-full items-center gap-3">
                <column class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="text-base font-black text-green-900 dark:text-green-400">
                        ✓
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-xs text-zinc-500 dark:text-zinc-400">
                        ACCOUNT STATUS
                    </text>

                    <text class="text-sm font-bold text-green-800 dark:text-green-400">
                        Active
                    </text>
                </column>
            </row>

        </column>


        {{-- Dashboard Action --}}
        <pressable
            class="w-full rounded-2xl bg-green-950 dark:bg-green-800 p-4"
            @press="navigate('agentdashboard')"
        >
            <row class="w-full items-center gap-3">
                <column class="w-11 h-11 rounded-xl bg-white/15 items-center justify-center">
                    <text class="text-xl font-black text-white">
                        ↗
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-base font-extrabold text-white">
                        Agent Dashboard
                    </text>

                    <text class="text-xs text-green-100">
                        Manage your properties and performance
                    </text>
                </column>

                <text class="text-2xl font-bold text-white">
                    ›
                </text>
            </row>
        </pressable>


        {{-- Logout --}}
        <native:button
            @press="logout"
            size="lg"
            variant="destructive"
            icon="exit"
            class="w-full h-[52px] rounded-2xl mb-3 text-white"
        >
            Log Out
        </native:button>

        <text class="w-full text-center text-xs text-zinc-400">
            Keep your profile details up to date.
        </text>

    </column>
</native:scroll-view> 
