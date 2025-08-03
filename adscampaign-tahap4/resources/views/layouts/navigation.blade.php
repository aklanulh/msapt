<nav x-data="{ open: false }" class="pixel-nav">
    <!-- Primary Navigation Menu -->
    <div class="pixel-container">
        <div class="flex justify-between items-center" style="min-height: 60px;">
            <div class="flex items-center">
                <!-- Pixel Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="pixel-nav-item active" style="font-size: 16px; margin-right: 20px;">
                        🎮 PIXEL QUEST
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex space-x-2">
                    <a href="{{ route('dashboard') }}" class="pixel-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        🏠 Base
                    </a>
                    <a href="{{ route('tasks.index') }}" class="pixel-nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        ⚔️ Quests
                    </a>
                    <a href="{{ route('submissions.index') }}" class="pixel-nav-item {{ request()->routeIs('submissions.*') ? 'active' : '' }}">
                        📋 Progress
                    </a>
                    <a href="{{ route('redeems.index') }}" class="pixel-nav-item {{ request()->routeIs('redeems.*') ? 'active' : '' }}">
                        💰 Rewards
                    </a>
                    <a href="{{ route('contact') }}" class="pixel-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">
                        📞 Support
                    </a>
                </div>
            </div>

            <!-- Player Info & Settings -->
            <div class="hidden sm:flex sm:items-center space-x-4">
                <!-- Points Display -->
                <div class="pixel-badge pixel-badge-success pixel-pulse">
                    💎 {{ Auth::user()->points ?? 0 }} Points
                </div>
                
                <!-- User Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="pixel-btn pixel-btn-secondary" style="padding: 8px 12px;">
                        👤 {{ Auth::user()->name }} ▼
                    </button>
                    
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 pixel-card" style="z-index: 50;">
                        <a href="{{ route('profile.edit') }}" class="pixel-nav-item" style="display: block; width: 100%;">
                            ⚙️ Profile Settings
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="pixel-nav-item" style="display: block; width: 100%; text-align: left; background: none; border: none;">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="pixel-btn" style="padding: 8px;">
                    <span x-show="!open">☰</span>
                    <span x-show="open">✕</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden pixel-card" style="margin: 10px; background: rgba(0,0,0,0.9);">
        <div class="p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="pixel-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}" style="display: block; width: 100%;">
                🏠 Base
            </a>
            <a href="{{ route('tasks.index') }}" class="pixel-nav-item {{ request()->routeIs('tasks.*') ? 'active' : '' }}" style="display: block; width: 100%;">
                ⚔️ Quests
            </a>
            <a href="{{ route('submissions.index') }}" class="pixel-nav-item {{ request()->routeIs('submissions.*') ? 'active' : '' }}" style="display: block; width: 100%;">
                📋 Progress
            </a>
            <a href="{{ route('redeems.index') }}" class="pixel-nav-item {{ request()->routeIs('redeems.*') ? 'active' : '' }}" style="display: block; width: 100%;">
                💰 Rewards
            </a>
            <a href="{{ route('contact') }}" class="pixel-nav-item {{ request()->routeIs('contact') ? 'active' : '' }}" style="display: block; width: 100%;">
                📞 Support
            </a>
        </div>

        <!-- Mobile Player Info -->
        <div class="p-4 border-t-2" style="border-color: var(--pixel-accent);">
            <div class="pixel-badge pixel-badge-success" style="margin-bottom: 10px;">
                💎 {{ Auth::user()->points ?? 0 }} Points
            </div>
            <div style="color: var(--pixel-light); margin-bottom: 10px; font-size: 10px;">
                👤 {{ Auth::user()->name }}
            </div>
            <div style="color: var(--pixel-light); margin-bottom: 15px; font-size: 8px; opacity: 0.7;">
                {{ Auth::user()->email }}
            </div>
            
            <div class="space-y-2">
                <a href="{{ route('profile.edit') }}" class="pixel-nav-item" style="display: block; width: 100%;">
                    ⚙️ Profile Settings
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="pixel-nav-item" style="display: block; width: 100%; text-align: left; background: none; border: none;">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
