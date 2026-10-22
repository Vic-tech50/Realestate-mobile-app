
<native:scroll-view class="flex-1 bg-zinc-50 dark:bg-zinc-950 safe-area">

    <column class="w-full p-5 gap-5">

        {{-- Header --}}
        <column class="gap-2">

            <text class="text-2xl font-bold text-zinc-900 dark:text-white">
                Verify Your Account
            </text>

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Before adding a property, let's make sure your agent
                profile is complete.
            </text>

        </column>


        {{-- Verification Status --}}
        @if ($verified === 'true')

            <column class="rounded-2xl bg-green-50 dark:bg-green-950 border border-green-100 dark:border-green-900 p-5">

                <row class="items-center gap-4">

                    <column class="h-12 w-12 items-center justify-center rounded-full bg-green-100 dark:bg-green-900">
                        <text class="text-xl font-bold text-green-600 dark:text-green-400">
                            ✓
                        </text>
                    </column>

                    <column class="flex-1 gap-1">

                        <text class="text-base font-bold text-green-800 dark:text-green-300">
                            Account Verified
                        </text>

                        <text class="text-sm text-green-700 dark:text-green-400">
                            Your agent profile is ready.
                        </text>

                    </column>

                </row>

            </column>

        @else

            <column class="rounded-2xl bg-orange-50 dark:bg-orange-950 border border-orange-100 dark:border-orange-900 p-5">

                <row class="items-center gap-4">

                    <column class="h-12 w-12 items-center justify-center rounded-full bg-orange-100 dark:bg-orange-900">
                        <text class="text-xl font-bold text-orange-600 dark:text-orange-400">
                            !
                        </text>
                    </column>

                    <column class="flex-1 gap-1">

                        <text class="text-base font-bold text-orange-800 dark:text-orange-300">
                            Profile Incomplete
                        </text>

                        <text class="text-sm text-orange-700 dark:text-orange-400">
                            Please complete your agent profile before
                            adding a property.
                        </text>

                    </column>

                </row>

            </column>

        @endif


        {{-- Agent Information --}}
        <column class="gap-3">

            <text class="text-base font-bold text-zinc-900 dark:text-white">
                Agent Information
            </text>

            {{-- Name --}}
            <column class="w-full rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-1">

                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                    Full Name
                </text>

                <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                    {{ $user['name'] ?? 'Not provided' }}
                </text>

            </column>

            {{-- Email --}}
            <column class="w-full rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-1">

                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                    Email Address
                </text>

                <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                    {{ $user['email'] ?? 'Not provided' }}
                </text>

            </column>

            {{-- Phone --}}
            <column class="w-full rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-1">

                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                    Phone Number
                </text>

                <text class="text-sm font-semibold text-zinc-900 dark:text-white">
                    {{ $user['phone'] ?? 'Not provided' }}
                </text>

            </column>

        </column>


        {{-- Verification Checklist --}}
        <column class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-4">

            <column class="gap-1">
                <text class="text-base font-bold text-zinc-900 dark:text-white">
                    Verification Checklist
                </text>

                <text class="text-xs text-zinc-500 dark:text-zinc-400">
                    Accepted identity documents
                </text>
            </column>

            <row class="items-center gap-3">

                <column class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="font-bold text-green-700 dark:text-green-400">
                        ✓
                    </text>
                </column>

                <text class="flex-1 text-sm text-zinc-700 dark:text-zinc-300">
                    National ID / NIN card
                </text>

            </row>

            <row class="items-center gap-3">

                <column class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="font-bold text-green-700 dark:text-green-400">
                        ✓
                    </text>
                </column>

                <text class="flex-1 text-sm text-zinc-700 dark:text-zinc-300">
                    International Passport
                </text>

            </row>

            <row class="items-center gap-3">

                <column class="h-8 w-8 rounded-lg bg-green-100 dark:bg-green-950 items-center justify-center">
                    <text class="font-bold text-green-700 dark:text-green-400">
                        ✓
                    </text>
                </column>

                <text class="flex-1 text-sm text-zinc-700 dark:text-zinc-300">
                    Voter's Card
                </text>

            </row>

        </column>


        {{-- Actions --}}
        <column class="w-full gap-3 pt-2">

            @if ($verified === 'true')

                <native:button
                    label="Continue to Add Property"
                    @press="continueToAddProperty"
                    variant="ghost"
                    class="w-full h-[50px] rounded-xl bg-green-950 dark:bg-green-800 text-white"
                />

            @else

                <native:button
                    label="Continue"
                    @press="upload"
                    size="lg"
                    variant="primary"
                    icon-trailing="forward"
                    class="w-full h-[50px] rounded-xl bg-green-950 dark:bg-green-800 text-white"
                />

            @endif

        </column>


        {{-- Footer --}}
        <text class="mt-2 text-center text-xs text-zinc-400 dark:text-zinc-500">
            Your profile information helps keep property listings
            trustworthy and secure.
        </text>

    </column>

</native:scroll-view>