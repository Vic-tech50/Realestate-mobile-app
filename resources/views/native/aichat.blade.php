```blade
<native:column class="w-full h-full bg-zinc-50">

    {{-- =========================================================
        TOP BAR
    ========================================================== --}}
    <native:top-bar
        title="AI Bot"
        back="true"
        subtitle="Ask Okenyi about property..."
    />


    {{-- =========================================================
        CHAT CONTENT
        Only this section should scroll
    ========================================================== --}}
    <native:scroll-view class="flex-1 w-full">

        <column class="w-full px-4 py-5 gap-5">


            {{-- =================================================
                AI WELCOME MESSAGE
            ================================================== --}}
            @if(empty($messages))

                <native:row class="w-full items-start gap-3">

                    {{-- AI Avatar --}}
                    <column class="w-9 h-9 rounded-full bg-green-600 items-center justify-center">

                        <text class="text-white text-sm font-bold">
                            AI
                        </text>

                    </column>


                    {{-- Message --}}
                    <column class="flex-1 max-w-[88%] gap-2">

                        <text class="text-sm font-bold text-zinc-900">
                            Property AI
                        </text>

                        <column class="bg-white rounded-2xl p-4 border border-zinc-100">

                            <text class="text-sm leading-5 text-zinc-700">
                                Hello! 👋 I'm your property assistant.
                            </text>

                            <text class="text-sm leading-5 text-zinc-700 mt-2">
                                I can help you find properties and land,
                                understand property documents, compare
                                locations, and answer real-estate questions.
                            </text>

                        </column>

                    </column>

                </native:row>

            @endif


            {{-- =================================================
                CHAT MESSAGES
            ================================================== --}}
            @foreach($messages as $message)

                @if($message['role'] === 'user')

                    {{-- USER MESSAGE --}}
                    <native:row class="w-full justify-end">

                        <column class="max-w-[82%] gap-1 items-end">

                            <column class="bg-green-600 rounded-2xl rounded-br-sm px-4 py-3">

                                <text class="text-sm leading-5 text-white">
                                    {{ $message['message'] }}
                                </text>

                            </column>

                        </column>

                    </native:row>


                @else

                    {{-- AI MESSAGE --}}
                    <native:row class="w-full items-start gap-3">

                        {{-- AI Avatar --}}
                        <column class="w-9 h-9 rounded-full bg-green-600 items-center justify-center">

                            <text class="text-white text-xs font-bold">
                                AI
                            </text>

                        </column>


                        {{-- AI Message --}}
                        <column class="flex-1  gap-1">

                            <text class="text-sm font-bold text-zinc-900">
                                Property AI
                            </text>

                            <column class="bg-white rounded-2xl rounded-tl-sm px-4 py-3 border border-zinc-100">

                                <text class="text-sm leading-5 text-zinc-700">
                                    {{ $message['message'] }}
                                </text>

                            </column>

                        </column>

                    </native:row>

                @endif

            @endforeach


            {{-- =================================================
                SUGGESTED QUESTIONS
            ================================================== --}}
            @if(empty($messages))

                <column class="w-full gap-3 mt-3">

                    <text class="text-sm font-semibold text-zinc-800">
                        Try asking
                    </text>


                    {{-- Question 1 --}}
                    <native:button
                        class="w-full bg-white border border-zinc-200 rounded-xl p-4"
                        @press="ask('Help me find land')"
                    >

                        <native:row class="w-full items-center gap-3">

                            <column class="w-9 h-9 rounded-full bg-green-50 items-center justify-center">

                                <text class="text-green-600">
                                    ⌕
                                </text>

                            </column>

                            <column class="flex-1">

                                <text class="text-sm text-zinc-800">
                                    Help me find land
                                </text>

                            </column>

                        </native:row>

                    </native:button>


                    {{-- Question 2 --}}
                    <native:button
                        class="w-full bg-white border border-zinc-200 rounded-xl p-4"
                        @press="ask('What property documents should I check?')"
                    >

                        <native:row class="w-full items-center gap-3">

                            <column class="w-9 h-9 rounded-full bg-green-50 items-center justify-center">

                                <text class="text-green-600">
                                    ✓
                                </text>

                            </column>

                            <column class="flex-1">

                                <text class="text-sm text-zinc-800">
                                    What property documents should I check?
                                </text>

                            </column>

                        </native:row>

                    </native:button>


                    {{-- Question 3 --}}
                    <native:button
                        class="w-full bg-white border border-zinc-200 rounded-xl p-4"
                        @press="ask('What should I check before buying land?')"
                    >

                        <native:row class="w-full items-center gap-3">

                            <column class="w-9 h-9 rounded-full bg-green-50 items-center justify-center">

                                <text class="text-green-600">
                                    ?
                                </text>

                            </column>

                            <column class="flex-1">

                                <text class="text-sm text-zinc-800">
                                    What should I check before buying land?
                                </text>

                            </column>

                        </native:row>

                    </native:button>

                </column>

            @endif


        </column>

    </native:scroll-view>


    {{-- =========================================================
        BOTTOM COMPOSER
        This stays fixed at the bottom
    ========================================================== --}}
    <column class="w-full bg-white border-t border-zinc-200 px-3 pt-3 pb-3">


        {{-- Small helper text --}}
        <text class="text-[11px] text-zinc-400 text-center mb-2">
            Property AI can make mistakes. Verify important property information.
        </text>


        {{-- Input Container --}}
        <native:row
            class="w-full min-h-[52px] bg-zinc-100 rounded-2xl items-end gap-2 px-2 py-2"
        >
@php
$message = '';
@endphp
            {{-- Text Input --}}
            <native:outlined-text-input
                class="flex-1"
                placeholder="Ask about property or land..."
                native:model="message"
            />


            {{-- Send Button --}}
            <native:button
                icon="chat"
                label="Send"
                variant="primary"
                @press="sendMessage"
            />

        </native:row>

    </column>

</native:column>
```
