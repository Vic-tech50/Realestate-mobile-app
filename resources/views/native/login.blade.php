<native:scroll-view class="w-full h-full bg-zinc-100 safe-area">
    <column class="w-full p-5 gap-6">
        <column class="w-full gap-3 pt-8">
            <column class="w-16 h-16 rounded-2xl bg-zinc-900 items-center justify-center shadow-sm">
                <text class="text-2xl font-black text-white">V</text>
            </column>

            <text class="text-[30px] font-black tracking-[-0.04em] text-zinc-900">
                Welcome back
            </text>

            <text class="text-base font-medium text-zinc-500">
                Sign in to your Victechs agent account.
            </text>
        </column>

        <column class="w-full rounded-3xl bg-white border border-zinc-200 p-5 gap-5 shadow-sm">
            <column class="w-full gap-1">
                <text class="text-[24px] font-bold text-zinc-900">
                    Sign In
                </text>

                <text class="text-sm font-medium text-zinc-500">
                    Enter your details to continue.
                </text>
            </column>

            @php $email=''; $password = '' @endphp

            <column class="w-full gap-2">
               

                <native:outlined-text-input
                    label="Email Address"
                    placeholder="agent@example.com"
                    keyboard="email"
                    leading-icon="email"
                    native:model="email"
                />
            </column>

            <column class="w-full gap-2">
                <column class="w-full flex-row items-center justify-between">
                    <text class="text-sm font-semibold text-zinc-700">
                        {{-- Password --}}
                    </text>

                    <pressable>
                        <text class="text-xs font-semibold text-zinc-500">
                            Forgot password?
                        </text>
                    </pressable>
                </column>

                <native:outlined-text-input
                    label="Password"
                    placeholder="Enter your password"
                    keyboard="text"
                    leading-icon="lock"
                    secure="true"
                    native:model="password"
                />
            </column>

            <column class="w-full pt-2 gap-3">
                @if ($errorMessage)
                    <text class="text-sm text-red-600 text-center">
                        {{ $errorMessage }}
                    </text>
                @endif

                <native:button
                    @press="authenticate"
                    :disabled="$isAuthenticating"
                    :loading="$isAuthenticating"
                    variant="primary"
                    size="lg"
                    class="w-full"
                >
                    {{ $isAuthenticating ? 'Signing in…' : 'Sign In' }}
                </native:button>
            </column>

            <column class="w-full flex-row items-center justify-center gap-1 pt-1">
                <text class="text-sm text-zinc-500">
                    Don’t have an account?
                </text>

                <pressable @press="register">
                    <text class="text-sm font-bold text-zinc-900">
                        Register
                    </text>
                </pressable>

                
            </column>
        </column>

        <column>
        <pressable @press="property">
                    <text class="text-sm font-bold text-zinc-900">
                        Go Back
                    </text>
                </pressable>
        </column>

        <column class="w-full items-center px-4">
            <text class="text-xs text-zinc-400 text-center leading-4">
                By continuing, you agree to the Terms of Service and Privacy Policy.
            </text>
        </column>
    </column>
</native:scroll-view>
