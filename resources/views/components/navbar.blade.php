<nav class="bg-gray-800" x-data="{ isOpen: false, isProfileOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" class="size-8" />
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <x-nav-link href="/" :current="request()->is('/')">Home</x-nav-link>
              <x-nav-link href="/posts" :current="request()->is('posts')">Blog</x-nav-link>
              <x-nav-link href="/about" :current="request()->is('about')">About</x-nav-link>
              <x-nav-link href="/contact" :current="request()->is('contact')">Contact</x-nav-link>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">

            <!-- Profile dropdown -->
            <div class="relative ml-3 z-50">
              <button class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" type="button" @click="isOpen = !isOpen">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-8 rounded-full outline -outline-offset-1 outline-white/10" />
              </button>

              <div class="absolute right-0 mt-2 w-48 rounded-md bg-gray-800 py-1 outline-1 -outline-offset-1 outline-white/10 shadow-lg" x-show="isOpen" @click.outside="isOpen = false" x-transition>
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 focus:bg-white/5 focus:outline-hidden">Your profile</a>
                <a href="/settings" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 focus:bg-white/5 focus:outline-hidden">Settings</a>
                <a href="/logout" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5 focus:bg-white/5 focus:outline-hidden">Sign out</a>
              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500" @click="isOpen = !isOpen">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <svg :class="{'hidden': isOpen, 'block': !isOpen}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" class="size-6">
              <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <svg :class="{'block': isOpen, 'hidden': !isOpen}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" class="size-6">
              <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div id="mobile-menu" x-show="isOpen" x-transition class="block md:hidden">
      <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
        <x-nav-link class="block" href="/" :current="request()->is('/')">Home</x-nav-link>
        <x-nav-link class="block" href="/posts" :current="request()->is('posts')">Blog</x-nav-link>
        <x-nav-link class="block" href="/about" :current="request()->is('about')">About</x-nav-link>
        <x-nav-link class="block" href="/contact" :current="request()->is('contact')">Contact</x-nav-link>
      </div>
      <div class="border-t border-white/10 pt-4 pb-3">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="size-10 rounded-full outline -outline-offset-1 outline-white/10" />
          </div>
          <div class="ml-3">
            <div class="text-base/5 font-medium text-white">Tom Cook</div>
            <div class="text-sm font-medium text-gray-400">tom@example.com</div>
          </div>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="/profile" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your profile</a>
          <a href="/settings" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Settings</a>
          <a href="/logout" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav>
