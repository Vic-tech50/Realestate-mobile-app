<native:scroll-view class="flex-1 bg-white dark:bg-zinc-950">

    <column class="p-5">

        {{-- Header --}}
        <column class="mb-6">

            <text class="text-2xl font-bold text-zinc-900 dark:text-white">
                Verify Your Identity
            </text>

            <text class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                To become a verified agent, upload a valid government-issued
                identification document.
            </text>

        </column>


        {{-- Security notice --}}
        <column class="mb-6 rounded-2xl bg-blue-50 p-4 dark:bg-blue-950">

            <row class="items-center">

                <column class="h-10 w-10 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900">

                    <text class="text-lg text-blue-600 dark:text-blue-300">
                        ✓
                    </text>

                </column>

                <column class="ml-3 flex-1">

                    <text class="text-sm font-bold text-blue-900 dark:text-blue-200">
                        Your information is protected
                    </text>

                    <text class="mt-1 text-xs text-blue-700 dark:text-blue-300">
                        Your identity document will only be used for
                        verification purposes.
                    </text>

                </column>

            </row>

        </column>


        {{-- Document type --}}
        <column>

            <text class="mb-3 text-base font-bold text-zinc-900 dark:text-white">
                Select Document Type
            </text>


            {{-- National ID --}}
            <pressable
                @press="selectNationalId"
                class="mb-3 rounded-2xl border p-4
                    {{ $documentType === 'national_id'
                        ? 'border-blue-500 bg-blue-50 dark:border-blue-400 dark:bg-blue-950'
                        : 'border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800">

                        <text class="text-lg">
                            🪪
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900 dark:text-white">
                            National ID / NIN
                        </text>

                        <text class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            National identification card
                        </text>

                    </column>

                    @if ($documentType === 'national_id')
                        <text class="text-lg text-blue-600 dark:text-blue-400">
                            ✓
                        </text>
                    @endif

                </row>

            </pressable>


            {{-- International Passport --}}
            <pressable
                @press="selectPassport"
                class="mb-3 rounded-2xl border p-4
                    {{ $documentType === 'passport'
                        ? 'border-blue-500 bg-blue-50 dark:border-blue-400 dark:bg-blue-950'
                        : 'border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800">

                        <text class="text-lg">
                            📘
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900 dark:text-white">
                            International Passport
                        </text>

                        <text class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            Valid Nigerian passport
                        </text>

                    </column>

                    @if ($documentType === 'passport')
                        <text class="text-lg text-blue-600 dark:text-blue-400">
                            ✓
                        </text>
                    @endif

                </row>

            </pressable>


            {{-- Voter's Card --}}
            <pressable
                @press="selectVotersCard"
                class="rounded-2xl border p-4
                    {{ $documentType === 'voters_card'
                        ? 'border-blue-500 bg-blue-50 dark:border-blue-400 dark:bg-blue-950'
                        : 'border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800">

                        <text class="text-lg">
                            🗳️
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900 dark:text-white">
                            Voter's Card
                        </text>

                        <text class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            Valid voter's identification card
                        </text>

                    </column>

                    @if ($documentType === 'voters_card')
                        <text class="text-lg text-blue-600 dark:text-blue-400">
                            ✓
                        </text>
                    @endif

                </row>

            </pressable>

        </column>


        {{-- Document upload --}}
        @if ($documentType)

            <column class="mt-8">

                <text class="mb-3 text-base font-bold text-zinc-900 dark:text-white">
                    Upload Your Document
                </text>


                @if ($documentPath)

                    {{-- Document selected --}}
                    <column class="rounded-2xl bg-green-50 p-5 dark:bg-green-950">

                        <row class="items-center">

                            <column class="h-12 w-12 items-center justify-center rounded-xl bg-green-100 dark:bg-green-900">

                                <text class="text-xl text-green-600 dark:text-green-300">
                                    ✓
                                </text>

                            </column>

                            <column class="ml-4 flex-1">

                                <text class="text-sm font-bold text-green-800 dark:text-green-200">
                                    Document Ready
                                </text>

                                <text class="mt-1 text-xs text-green-700 dark:text-green-300">
                                    Your document has been captured.
                                </text>

                            </column>

                        </row>

                    </column>

                @else

                    {{-- Camera --}}
                    <pressable
                        @press="takePhoto"
                        class="mb-3 w-full rounded-2xl bg-blue-600 p-5 dark:bg-blue-700"
                    >

                        <row class="items-center">

                            <column class="h-11 w-11 items-center justify-center rounded-xl bg-blue-500 dark:bg-blue-600">

                                <text class="text-lg text-white">
                                    📷
                                </text>

                            </column>

                            <column class="ml-4">

                                <text class="text-sm font-bold text-white">
                                    Take Photo
                                </text>

                                <text class="mt-1 text-xs text-blue-100">
                                    Use your camera
                                </text>

                            </column>

                        </row>

                    </pressable>


                    {{-- Gallery --}}
                    <pressable
                        @press="chooseFromGallery"
                        class="w-full rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900"
                    >

                        <row class="items-center">

                            <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100 dark:bg-zinc-800">

                                <text class="text-lg">
                                    🖼️
                                </text>

                            </column>

                            <column class="ml-4">

                                <text class="text-sm font-bold text-zinc-900 dark:text-white">
                                    Choose From Gallery
                                </text>

                                <text class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                    Select an existing photo
                                </text>

                            </column>

                        </row>

                    </pressable>

                @endif

            </column>

        @endif


        {{-- Message --}}
        @if ($message)

            <column class="mt-5 rounded-xl bg-zinc-100 p-4 dark:bg-zinc-900">

                <text class="text-sm text-zinc-700 dark:text-zinc-300">
                    {{ $message }}
                </text>

            </column>

        @endif


        {{-- Submit --}}
        @if ($documentPath)

            <column class="mt-8">

                <native:button
                    label="Submit For Verification"
                    @press="submitVerification"
                />

            </column>

        @endif


        {{-- Footer note --}}
        <text class="mt-5 mb-8 text-center text-xs text-zinc-400 dark:text-zinc-500">
            Make sure the document is clear, readable and belongs to you.
        </text>

    </column>

</native:scroll-view>