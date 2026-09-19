<native:scroll-view class="w-full h-full bg-zinc-50 safe-area">
    <column class="w-full gap-5 p-4 pb-8">

        {{-- Profile Header Card --}}
        <column class="w-full rounded-3xl bg-white border border-zinc-200 p-5 gap-4 shadow-sm">
            <row class="w-full items-center gap-4">
                <column class="w-16 h-16 rounded-full bg-zinc-900 items-center justify-center">
                    <text class="text-xl font-extrabold text-white">
                        {{ strtoupper(substr($user['name'] ?? 'A', 0, 1)) }}
                    </text>
                </column>

                <column class="flex-1 gap-1">
                    <text class="text-2xl font-black text-zinc-900">
                        {{ $user['name'] ?? 'Agent User' }}
                    </text>
                    <text class="text-sm font-medium text-zinc-500">
                        {{ $user['role'] ?? 'Property Agent' }}
                    </text>
                </column>

                <pressable class="rounded-xl bg-zinc-900 px-3 py-2" @press='edit'>
                    <text class="text-xs font-bold text-white">
                        Edit
                    </text>
                </pressable>
            </row>

            <row class="w-full gap-3">
                <column class="flex-1 rounded-2xl bg-zinc-50 border border-zinc-200 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900">24</text>
                    <text class="text-xs text-zinc-500">Listings</text>
                </column>

                <column class="flex-1 rounded-2xl bg-zinc-50 border border-zinc-200 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900">18</text>
                    <text class="text-xs text-zinc-500">Leads</text>
                </column>

                <column class="flex-1 rounded-2xl bg-zinc-50 border border-zinc-200 p-3 items-center">
                    <text class="text-2xl font-black text-zinc-900">4.9</text>
                    <text class="text-xs text-zinc-500">Rating</text>
                </column>
            </row>
        </column>

        {{-- Contact Information --}}
        <column class="w-full rounded-3xl bg-white border border-zinc-200 p-5 gap-4">
            <text class="text-lg font-extrabold text-zinc-900">
                Contact Information
            </text>

            <column class="w-full gap-3">
                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 border border-zinc-200 p-3">
                    <column class="w-10 h-10 rounded-xl bg-zinc-900 items-center justify-center">
                        <text class="text-sm font-bold text-white">@</text>
                    </column>
                    <column class="flex-1">
                        <text class="text-xs uppercase text-zinc-500">Email</text>
                        <text class="text-sm font-semibold text-zinc-900">
                            {{ $user['email'] ?? 'agent@example.com' }}
                        </text>
                    </column>
                </row>

                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 border border-zinc-200 p-3">
                    <column class="w-10 h-10 rounded-xl bg-zinc-900 items-center justify-center">
                        <text class="text-sm font-bold text-white">☎</text>
                    </column>
                    <column class="flex-1">
                        <text class="text-xs uppercase text-zinc-500">Phone</text>
                        <text class="text-sm font-semibold text-zinc-900">
                            {{ $user['phone'] ?? '+234 800 000 0000' }}
                        </text>
                    </column>
                </row>

                <row class="w-full items-center gap-3 rounded-2xl bg-zinc-50 border border-zinc-200 p-3">
                    <column class="w-10 h-10 rounded-xl bg-zinc-900 items-center justify-center">
                        <text class="text-sm font-bold text-white">⌂</text>
                    </column>
                    <column class="flex-1">
                        <text class="text-xs uppercase text-zinc-500">Office</text>
                        <text class="text-sm font-semibold text-zinc-900">
                            Lekki Phase 1, Lagos
                        </text>
                    </column>
                </row>
            </column>
        </column>

        {{-- Account Details --}}
        <column class="w-full rounded-3xl bg-white border border-zinc-200 p-5 gap-4">
            <text class="text-lg font-extrabold text-zinc-900">
                Account Details
            </text>

            <row class="w-full items-center justify-between py-2 border-b border-zinc-200">
                <text class="text-sm text-zinc-500">Membership</text>
                <text class="text-sm font-bold text-zinc-900">Premium Agent</text>
            </row>

            <row class="w-full items-center justify-between py-2 border-b border-zinc-200">
                <text class="text-sm text-zinc-500">Verification</text>
                <text class="text-sm font-bold text-emerald-600">Verified</text>
            </row>

            <row class="w-full items-center justify-between py-2">
                <text class="text-sm text-zinc-500">Status</text>
                <text class="text-sm font-bold text-emerald-600">Active</text>
            </row>
        </column>

        {{-- Action Buttons --}}
        <column class="w-full gap-3">
            <native:button
                @press="navigate('/agentdashboard')"
                class="w-full rounded-2xl bg-zinc-900 py-4 items-center justify-center"
            >
                View Dashboard
            </native:button>

            <native:button
                @press="logout"
                class="w-full rounded-2xl border border-zinc-200 bg-white py-4 items-center justify-center"
            >
                Logout
            </native:button>
        </column>
    </column>
</native:scroll-view>