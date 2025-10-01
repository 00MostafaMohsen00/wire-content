<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div aria-label="Mobile Menu Button" tabindex="0" role="button" class="lg:hidden btn bt-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6" wire:click="toggleDrawer">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
            </svg>
        </div>
        <a href="{{ route('home') }}" wire:navigate>{{ config('app.name') }}</a>
    </div>
    <div class="navbar hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="{{ route('home') }}" wire:navigate clss="p-2">
                    <x-mary-icon name="fas.home"></x-mary-icon>
                    Home
                </a>
            </li>

            <li><a href="#" wire:navigate>
                    <x-mary-icon name="fas.newspaper"></x-mary-icon>
                    Articles
                </a>
            </li>

        </ul>
    </div>
    <div class="navbar-end space-x-2">
        @guest
            <a href="{{ route('login') }}" wire:navigate class="btn btn-primary">Login</a>
            <a href="{{ route('register') }}" wire:navigate class="btn btn-secondary">Register</a>
        @endguest()
        @auth()
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img alt="{{ auth()->user()->name }} profile image" src="{{ auth()->user()->profile_photo_url }}" />
                    </div>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li>
                        <a wire:navigate href="{{ route('profile.show') }}">
                            Profile
                        </a>
                    </li>
                    <li><a href="/admin">Admin Panel</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a href="{{ route('logout') }}" @click.prevent="$root.submit()">Logout</a>
                        </form>
                    </li>
                </ul>
            </div>
        @endauth
    </div>
    <x-mary-drawer wire:mode="responsiveMenu" class="w-11/12 lg:w-1/3">
        <x-mary-menu class="p-0 m-0">
            <x-mary-menu-item title="Home" icon="fas.home"></x-mary-menu-item>
            <x-mary-menu-item title="Articlees" icon="fas.newspaper"></x-mary-menu-item>
        </x-mary-menu>
    </x-mary-drawer>
</div>
