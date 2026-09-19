<native:scroll-view class="w-full h-full bg-zinc-50 safe-area">

    <column class="w-full p-4 gap-5">

        {{-- Header --}}
        <column class="w-full gap-1">

            <text class="text-2xl font-extrabold text-zinc-900">
                Edit Profile
            </text>

            <text class="text-sm text-zinc-500">
                Update your agent profile information.
            </text>

        </column>


        {{-- Profile Photo --}}
        <column
            class="w-full rounded-2xl bg-white border border-zinc-200 p-5 items-center gap-3"
        >

            {{-- <native:image
                src="{{ $avatarPreview ?: asset('images/default-avatar.png') }}"
                :width="100"
                :height="100"
                :fit="2"
                class="rounded-full"
            /> --}}

            <pressable
                @press="selectAvatar"
                class="rounded-xl bg-zinc-100 px-4 py-3"
            >
                <text class="text-sm font-bold text-zinc-900">
                    Change Profile Photo
                </text>
            </pressable>

        </column>


        {{-- Personal Information --}}
        <column
            class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4"
        >

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Personal Information
                </text>

                <text class="text-xs text-zinc-500">
                    Update your basic account information.
                </text>

            </column>

            @php $name = $user['name']; $email = $user['email']; $phone = $user['phone']; @endphp

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
            class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4"
        >

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Agent Information
                </text>

                <text class="text-xs text-zinc-500">
                    Tell clients a little about yourself.
                </text>

            </column>


            {{-- Bio --}}
            <column class="w-full gap-2">

               

                <native:outlined-text-input
                    label="About Me"
                    placeholder="Tell clients about yourself and your experience..."
                    value="{{ $user['bio'] ?? '' }}"
                    {{-- native:model="bio" --}}
                />

            </column>

        </column>


        {{-- Change Password --}}
        <column
            class="w-full rounded-2xl bg-white border border-zinc-200 p-4 gap-4"
        >

            <column class="gap-1">

                <text class="text-lg font-extrabold text-zinc-900">
                    Change Password
                </text>

                <text class="text-xs text-zinc-500">
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
                    {{-- native:model="current_password" --}}
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
                    {{-- native:model="password" --}}
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
                    {{-- native:model="password_confirmation" --}}
                />

            </column>

        </column>


        {{-- Save --}}
        <column class="w-full gap-3 pb-6">

            @if ($errorMessage)
                    <text class="text-sm text-red-600 text-center">
                        {{ $errorMessage }}
                    </text>
                @endif

            <native:button
                label="Save Changes"
                @press="save"
                :loading="$isSaving"
                :disabled="$isSaving"
                class="w-full rounded-xl bg-black py-4 items-center justify-center">
               {{ $isSaving ? 'Saving Changes…' : 'Save Changes' }}
                </native:button>

            <pressable
                {{-- @navigate="/dashboard" --}}
                class="w-full items-center justify-center py-2"
            >
                <text class="text-sm font-semibold text-zinc-500">
                    Cancel
                </text>
            </pressable>

        </column>

    </column>

</native:scroll-view>