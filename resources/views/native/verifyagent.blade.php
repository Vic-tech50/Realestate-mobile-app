<native:scroll-view class="flex-1 bg-white">

    <column class="p-5">

        {{-- Header --}}
        <column class="mb-6">

            <text class="text-2xl font-bold text-zinc-900">
                Verify Your Account
            </text>

            <text class="mt-2 text-sm text-zinc-500">
                Before adding a property, let's make sure your agent
                profile is complete.
            </text>

        </column>


        {{-- Verification status --}}
        {{-- @if ($verified) --}}

            <column class="rounded-2xl bg-green-50 p-5">

                <row class="items-center">

                    <column class="h-12 w-12 items-center justify-center rounded-full bg-green-100">
                        <text class="text-xl text-green-600">
                            ✓
                        </text>
                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-base font-bold text-green-800">
                            Account Verified
                        </text>

                        <text class="mt-1 text-sm text-green-700">
                            Your agent profile is ready.
                        </text>

                    </column>

                </row>

            </column>

        {{-- @else --}}

            <column class="rounded-2xl bg-orange-50 p-5">

                <row class="items-center">

                    <column class="h-12 w-12 items-center justify-center rounded-full bg-orange-100">
                        <text class="text-xl text-orange-600">
                            !
                        </text>
                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-base font-bold text-orange-800">
                            Profile Incomplete
                        </text>

                        <text class="mt-1 text-sm text-orange-700">
                            Please complete your agent profile before
                            adding a property.
                        </text>

                    </column>

                </row>

            </column>

        {{-- @endif --}}


        {{-- Agent information --}}
        <column class="mt-6">

            <text class="mb-3 text-base font-bold text-zinc-900">
                Agent Information
            </text>


            {{-- Name --}}
            <column class="mb-4 rounded-xl bg-zinc-50 p-4">

                <text class="text-xs text-zinc-500">
                    Full Name
                </text>

                <text class="mt-1 text-sm font-semibold text-zinc-900">
                    {{ $user['name'] ?? 'Not provided' }}
                </text>

            </column>


            {{-- Email --}}
            <column class="mb-4 rounded-xl bg-zinc-50 p-4">

                <text class="text-xs text-zinc-500">
                    Email Address
                </text>

                <text class="mt-1 text-sm font-semibold text-zinc-900">
                    {{ $user['email'] ?? 'Not provided' }}
                </text>

            </column>


            {{-- Phone --}}
            <column class="mb-4 rounded-xl bg-zinc-50 p-4">

                <text class="text-xs text-zinc-500">
                    Phone Number
                </text>

                <text class="mt-1 text-sm font-semibold text-zinc-900">
                    {{ $user['phone'] ?? 'Not provided' }}
                </text>

            </column>

        </column>


        {{-- What we checked --}}
        <column class="mt-2 rounded-2xl border border-zinc-200 p-5">

            <text class="mb-4 text-base font-bold text-zinc-900">
                Verification Checklist
            </text>


            <row class="mb-3 items-center">

                <text class="mr-3 text-green-600">
                    ✓
                </text>

                <text class="text-sm text-zinc-700">
                    National ID / NIN card
                </text>

            </row>


            <row class="mb-3 items-center">

                <text class="mr-3 text-green-600">
                    ✓
                </text>

                <text class="text-sm text-zinc-700">
                    International Passport
                </text>

            </row>


            <row class="items-center">

                <text class="mr-3 text-green-600">
                    ✓
                </text>

                <text class="text-sm text-zinc-700">
                    Voter's Card
                </text>

            </row>

        </column>


        {{-- Actions --}}
        <column class="mt-8">

            {{-- @if ($verified) --}}

                <native:button
                    label="Continue to Add Property"
                    @press="continueToAddProperty"
                />

            {{-- @else --}}

                <native:button
                    label="Complete My Profile"
                    @press="upload"
                />

            {{-- @endif --}}

        </column>


        <text class="mt-4 text-center text-xs text-zinc-400">
            Your profile information helps keep property listings
            trustworthy and secure.
        </text>

    </column>

</native:scroll-view>