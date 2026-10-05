<native:scroll-view class="w-full h-full bg-zinc-50 dark:bg-zinc-950 safe-area">


<column class="w-full p-4 gap-5">

    {{-- Header --}}
    <column class="w-full gap-1">

        <text class="text-2xl font-extrabold text-zinc-900 dark:text-white">
            Edit Profile
        </text>

        <text class="text-sm text-zinc-500 dark:text-zinc-400">
            Update your agent profile information.
        </text>

    </column>


    {{-- Profile Photo --}}
    <column
        class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-5 items-center gap-3"
    >

        <native:image
            src="{{ $avatarPreview ?: 'https://picsum.photos/seed/default-agent-avatar/300/300' }}"
            :width="100"
            :height="100"
            :fit="2"
            class="rounded-full"
        />

        <pressable
            @press="selectAvatar"
            class="rounded-xl bg-zinc-100 dark:bg-zinc-800 px-4 py-3"
        >
            <text class="text-sm font-bold text-zinc-900 dark:text-white">
                Change Profile Photo
            </text>
        </pressable>

    </column>


    {{-- Personal Information --}}
    <column
        class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-4"
    >

        <column class="gap-1">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Personal Information
            </text>

            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                Update your basic account information.
            </text>

        </column>

        @php
            $name = $user['name'];
            $email = $user['email'];
            $phone = $user['phone'];
        @endphp

        {{-- Name --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="Full Name"
                placeholder="name"
                leading-icon="account"
                native:model="name"
            />

        </column>


        {{-- Email --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="Email"
                placeholder="agent@example.com"
                keyboard="email"
                leading-icon="email"
                native:model="email"
            />

        </column>


        {{-- Phone --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="Phone Number"
                placeholder="08012345678"
                keyboard="phone"
                leading-icon="phone"
                native:model="phone"
            />

        </column>

    </column>


    {{-- Agent Information --}}
    <column
        class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-4"
    >

        <column class="gap-1">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Agent Information
            </text>

            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                Tell clients a little about yourself.
            </text>

        </column>


        {{-- Bio --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="About Me"
                placeholder="Tell clients about yourself and your experience..."
                value="{{ $user['bio'] ?? '' }}"
            />

        </column>

    </column>


    {{-- Change Password --}}
    <column
        class="w-full rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 p-4 gap-4"
    >

        <column class="gap-1">

            <text class="text-lg font-extrabold text-zinc-900 dark:text-white">
                Change Password
            </text>

            <text class="text-xs text-zinc-500 dark:text-zinc-400">
                Leave these fields empty if you don't want to change your password.
            </text>

        </column>


        {{-- Current Password --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="Current Password"
                placeholder="Enter current password"
                keyboard="text"
                leading-icon="lock"
                secure="true"
            />

        </column>


        {{-- New Password --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="New Password"
                placeholder="Enter new password"
                keyboard="text"
                leading-icon="lock"
                secure="true"
            />

        </column>


        {{-- Confirm Password --}}
        <column class="w-full gap-2">

            <native:outlined-text-input
                label="Confirm Password"
                placeholder="Confirm new password"
                keyboard="text"
                leading-icon="lock"
                secure="true"
            />

        </column>

    </column>


    {{-- Save --}}
    <column class="w-full gap-3 pb-6">

        @if ($errorMessage)

            <text class="text-sm text-red-600 dark:text-red-400 text-center">
                {{ $errorMessage }}
            </text>

        @endif

        <native:button
            label="Save Changes"
            @press="save"
            :loading="$isSaving"
            :disabled="$isSaving"
            size="lg"
            class="w-full rounded-xl bg-black dark:bg-white py-4 items-center justify-center"
        >
            {{ $isSaving ? 'Saving Changes…' : 'Save Changes' }}
        </native:button>

        <pressable
            class="w-full items-center justify-center py-2"
        >
            <text class="text-sm font-semibold text-zinc-500 dark:text-zinc-400">
                Cancel
            </text>
        </pressable>

    </column>

</column>


</native:scroll-view>
