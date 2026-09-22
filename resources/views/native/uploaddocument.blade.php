<native:scroll-view class="flex-1 bg-white">

    <column class="p-5">

        {{-- Header --}}
        <column class="mb-6">

            <text class="text-2xl font-bold text-zinc-900">
                Verify Your Identity
            </text>

            <text class="mt-2 text-sm text-zinc-500">
                To become a verified agent, upload a valid government-issued
                identification document.
            </text>

        </column>


        {{-- Security notice --}}
        <column class="mb-6 rounded-2xl bg-blue-50 p-4">

            <row class="items-center">

                <column class="h-10 w-10 items-center justify-center rounded-full bg-blue-100">

                    <text class="text-lg text-blue-600">
                        ✓
                    </text>

                </column>

                <column class="ml-3 flex-1">

                    <text class="text-sm font-bold text-blue-900">
                        Your information is protected
                    </text>

                    <text class="mt-1 text-xs text-blue-700">
                        Your identity document will only be used for
                        verification purposes.
                    </text>

                </column>

            </row>

        </column>


        {{-- Document type --}}
        <column>

            <text class="mb-3 text-base font-bold text-zinc-900">
                Select Document Type
            </text>


            {{-- National ID --}}
            <pressable
                @press="selectNationalId"
                class="mb-3 rounded-2xl border p-4
                    {{ $documentType === 'national_id'
                        ? 'border-blue-500 bg-blue-50'
                        : 'border-zinc-200 bg-white' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100">

                        <text class="text-lg">
                            🪪
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900">
                            National ID / NIN
                        </text>

                        <text class="mt-1 text-xs text-zinc-500">
                            National identification card
                        </text>

                    </column>

                    @if ($documentType === 'national_id')
                        <text class="text-lg text-blue-600">
                            ✓
                        </text>
                    @endif

                </row>

            </pressable>


            {{-- Passport --}}
            <pressable
                @press="selectPassport"
                class="mb-3 rounded-2xl border p-4
                    {{ $documentType === 'passport'
                        ? 'border-blue-500 bg-blue-50'
                        : 'border-zinc-200 bg-white' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100">

                        <text class="text-lg">
                            📘
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900">
                            International Passport
                        </text>

                        <text class="mt-1 text-xs text-zinc-500">
                            Valid Nigerian passport
                        </text>

                    </column>

                    @if ($documentType === 'passport')
                        <text class="text-lg text-blue-600">
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
                        ? 'border-blue-500 bg-blue-50'
                        : 'border-zinc-200 bg-white' }}"
            >

                <row class="items-center">

                    <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100">

                        <text class="text-lg">
                            🗳️
                        </text>

                    </column>

                    <column class="ml-4 flex-1">

                        <text class="text-sm font-bold text-zinc-900">
                            Voter's Card
                        </text>

                        <text class="mt-1 text-xs text-zinc-500">
                            Valid voter's identification card
                        </text>

                    </column>

                    @if ($documentType === 'voters_card')
                        <text class="text-lg text-blue-600">
                            ✓
                        </text>
                    @endif

                </row>

            </pressable>

        </column>


        {{-- Document upload --}}
        @if ($documentType)

            <column class="mt-8">

                <text class="mb-3 text-base font-bold text-zinc-900">
                    Upload Your Document
                </text>


                @if ($documentPath)

                    {{-- Document selected --}}
                    <column class="rounded-2xl bg-green-50 p-5">

                        <row class="items-center">

                            <column class="h-12 w-12 items-center justify-center rounded-xl bg-green-100">

                                <text class="text-xl text-green-600">
                                    ✓
                                </text>

                            </column>

                            <column class="ml-4 flex-1">

                                <text class="text-sm font-bold text-green-800">
                                    Document Ready
                                </text>

                                <text class="mt-1 text-xs text-green-700">
                                    Your document has been captured.
                                </text>

                            </column>

                        </row>

                    </column>

                @else

                    {{-- Camera --}}
                    <pressable
                        @press="takePhoto"
                        class="mb-3 rounded-2xl bg-blue-600 p-5"
                    >

                        <row class="items-center">

                            <column class="h-11 w-11 items-center justify-center rounded-xl bg-blue-500">

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
                        class="rounded-2xl border border-zinc-200 bg-white p-5"
                    >

                        <row class="items-center">

                            <column class="h-11 w-11 items-center justify-center rounded-xl bg-zinc-100">

                                <text class="text-lg">
                                    🖼️
                                </text>

                            </column>

                            <column class="ml-4">

                                <text class="text-sm font-bold text-zinc-900">
                                    Choose From Gallery
                                </text>

                                <text class="mt-1 text-xs text-zinc-500">
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

            <column class="mt-5 rounded-xl bg-zinc-100 p-4">

                <text class="text-sm text-zinc-700">
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


        <text class="mt-5 mb-8 text-center text-xs text-zinc-400">
            Make sure the document is clear, readable and belongs to you.
        </text>

    </column>

</native:scroll-view>