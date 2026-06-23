<nav style="background: #ffffff; border-bottom: 1px solid #fee2e2; box-shadow: 0 4px 18px rgba(153, 27, 27, 0.08);">
    <div style="max-width: 1280px; margin: 0 auto; padding: 0 28px;">
        <div style="height: 72px; display: flex; justify-content: space-between; align-items: center;">

            {{-- Left Navbar --}}
            <div style="display: flex; align-items: center; gap: 34px;">

                {{-- Brand --}}
                <a
                    href="{{ route('dashboard') }}"
                    style="display: flex; align-items: center; gap: 12px; text-decoration: none;"
                >
                    <img
                        src="{{ asset('images/1.png') }}"
                        alt="Logo BAPENDA"
                        style="
                            height: 52px;
                            width: auto;
                            object-fit: contain;
                            display: block;
                        "
                    >
                </a>

                {{-- Main Navigation --}}
                <div style="display: flex; align-items: center; gap: 8px;">
                    @if (auth()->user()->isAdmin())
                    @else
                    @endif
                </div>
            </div>

            {{-- Right Navbar --}}
            <div style="display: flex; align-items: center; gap: 14px;">
                <div style="text-align: right;">
                    <div style="font-size: 13px; font-weight: 900; color: #0f172a;">
                        {{ Auth::user()->name }}
                    </div>

                    <div style="font-size: 11px; color: #64748b; margin-top: 2px;">
                        {{ auth()->user()->isAdmin() ? 'Admin Bapenda' : 'Staff Pelayanan' }}
                    </div>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            style="
                                width: 42px;
                                height: 42px;
                                border-radius: 50%;
                                border: none;
                                background: linear-gradient(135deg, #dc2626, #f87171);
                                color: #ffffff;
                                font-weight: 900;
                                font-size: 14px;
                                cursor: pointer;
                                box-shadow: 0 10px 20px rgba(239, 68, 68, 0.25);
                            "
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>