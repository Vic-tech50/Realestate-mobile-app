<native:scroll-view class="w-full h-full bg-zinc-100 dark:bg-zinc-950 safe-area"> <column class="w-full p-5 gap-5">

```
    <column class="w-full gap-2 pt-4">
        <text class="text-4xl font-black tracking-tight text-zinc-900 dark:text-white">
            Create agent
        </text>

        <text class="text-base text-zinc-500 dark:text-zinc-400">
            Add a new agent profile and set up their access.
        </text>
    </column>

    <column class="w-full rounded-3xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 gap-5 shadow-sm">

        <column class="w-full gap-1">
            <text class="text-2xl font-bold text-zinc-900 dark:text-white">
                Agent details
            </text>

            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Fill in the profile information below.
            </text>
        </column>

        <column class="w-full gap-3">
            <text class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                Profile photo
            </text>

            {{-- Profile image section --}}
            {{--
            <pressable
                @press="selectProfileImage"
                class="w-full rounded-2xl border-2 border-dashed border-zinc-300 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 p-4 items-center justify-center gap-3"
            >
                @if ($profileImage)

                    <native:image
                        src="{{ $profileImage }}"
                        :width="96"
                        :height="96"
                        :fit="2"
                        class="rounded-full"
                    />

                    <text class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                        Change profile image
                    </text>

                @else

                    <column class="w-16 h-16 rounded-full bg-zinc-900 dark:bg-white items-center justify-center">
                        <text class="text-2xl font-black text-white dark:text-zinc-900">
                            +
                        </text>
                    </column>

                    <text class="text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                        Upload profile picture
                    </text>

                @endif
            </pressable>
            --}}
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
            <text class="text-sm text-red-600 dark:text-red-400 text-center">
                {{ $errorMessage }}
            </text>
        @endif

        <native:button
            label="{{ $isSaving ? 'Saving Agent Data…' : 'Register' }}"
            @press="save"
            :loading="$isSaving"
            :disabled="$isSaving"
            size="lg"
            class="w-full rounded-2xl bg-zinc-900 dark:bg-white py-4 items-center justify-center"
        />

        <column class="w-full flex-row items-center justify-center gap-1 pt-1">
            <text class="text-sm text-zinc-500 dark:text-zinc-400">
                Already have an account?
            </text>

            <pressable @press="login">
                <text class="text-sm font-bold text-zinc-900 dark:text-white">
                    Login
                </text>
            </pressable>
        </column>

    </column>
</column>

<native:button
    label="Back Home"
    @press="property"
    variant="ghost"
    size="sm"
    icon="home"
    class="w-full py-4"
/>
```

</native:scroll-view>
