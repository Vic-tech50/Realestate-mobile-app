
<native:scroll-view class="w-full h-full bg-zinc-100 safe-area">
    <column class="w-full p-5 gap-5">
        <column class="w-full gap-2 pt-4">
            <text class="text-4xl font-black tracking-tight text-zinc-900">
                Create agent
            </text>

            <text class="text-base text-zinc-500">
                Add a new agent profile and set up their access.
            </text>
        </column>

        <column class="w-full rounded-3xl bg-white border border-zinc-200 p-5 gap-5 shadow-sm">
            <column class="w-full gap-1">
                <text class="text-2xl font-bold text-zinc-900">
                    Agent details
                </text>

                <text class="text-sm text-zinc-500">
                    Fill in the profile information below.
                </text>
            </column>

            <column class="w-full gap-3">
                <text class="text-sm font-semibold text-zinc-700">
                    Profile photo
                </text>

                {{-- <pressable @press="selectProfileImage" class="w-full rounded-2xl border-2 border-dashed border-zinc-300 bg-zinc-50 p-4 items-center justify-center gap-3">
                    @if ($profileImage)
                        <native:image
                            src="{{ $profileImage }}"
                            :width="96"
                            :height="96"
                            :fit="2"
                            class="rounded-full"
                        />
                        <text class="text-sm font-semibold text-zinc-700">
                            Change profile image
                        </text>
                    @else
                        <column class="w-16 h-16 rounded-full bg-zinc-900 items-center justify-center">
                            <text class="text-2xl font-black text-white">+</text>
                        </column>

                        <text class="text-sm font-semibold text-zinc-700">
                            Upload profile picture
                        </text>
                    @endif
                </pressable> --}}
            </column>

            <column class="w-full gap-2">
                <native:outlined-text-input
                    label="Full Name"
                    placeholder="John Doe"
                    keyboard="text"
                    leading-icon="user"
                    native:model="name"
                />
            </column>

            <column class="w-full gap-2">
                <native:outlined-text-input
                    label="Email"
                    placeholder="agent@example.com"
                    keyboard="email"
                    leading-icon="email"
                    native:model="email"
                />
            </column>

            <column class="w-full gap-2">
                <native:outlined-text-input
                    label="Phone Number"
                    placeholder="08012345678"
                    keyboard="phone"
                    leading-icon="phone"
                    native:model="phone"
                />
            </column>

            <column class="w-full gap-2">
                <native:outlined-text-input
                    label="Password"
                    placeholder="Create a password"
                    keyboard="text"
                    leading-icon="lock"
                    secure="true"
                    native:model="password"
                />
            </column>

            @if ($errorMessage)
                <text class="text-sm text-red-600 text-center">
                    {{ $errorMessage }}
                </text>
            @endif

            <native:button
                label="{{ $isSaving ? 'Saving Agent Data…' : 'Register' }}"
                @press="save"
                :loading="$isSaving"
                :disabled="$isSaving"
                class="w-full rounded-2xl bg-zinc-900 py-4 items-center justify-center"
            />

            <column class="w-full flex-row items-center justify-center gap-1 pt-1">
                <text class="text-sm text-zinc-500">
                    Already have an account?
                </text>

                <pressable @press="login">
                    <text class="text-sm font-bold text-zinc-900">
                        Login
                    </text>
                </pressable>
            </column>
        </column>
    </column>
</native:scroll-view>

