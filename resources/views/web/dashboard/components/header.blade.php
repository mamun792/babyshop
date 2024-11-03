<div class="navbar-header">
    <div class="row align-items-center justify-content-between">
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-4">
                <button type="button" class="sidebar-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
                    <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
                </button>
                <button type="button" class="sidebar-mobile-toggle">
                    <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
                </button>
                {{-- <form class="navbar-search">
                    <input type="text" name="search" placeholder="Search">
                    <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
                </form> --}}
            </div>
        </div>
        <div class="col-auto">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <button type="button" data-theme-toggle
                    class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
            
       


                <div class="dropdown">
                    <button class="d-flex justify-content-center align-items-center rounded-circle" type="button"
                        data-bs-toggle="dropdown">

                        {{-- <img src="{{ asset($user->avatar ) ??: '' }}" alt="image not found"
                            class="w-40-px h-40-px object-fit-cover rounded-circle"> --}}
                            {{-- <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : asset('path/to/default-avatar.png') }}" 
                            alt="User Avatar" 
                            class="w-40-px h-40-px object-fit-cover rounded-circle"> --}}

                            @if (auth()->user()->avatar)
                         
                            <img src="{{ asset(auth()->user()->avatar)  }}" alt="Avatar" width="100"  class="w-40-px h-40-px object-fit-cover rounded-circle">
                        @else
                            <!-- Generate avatar from user name if uploaded avatar is not available -->
                            <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}"
                                alt="Generated Avatar" width="100"  class="w-40-px h-40-px object-fit-cover rounded-circle" >
                        @endif
                       

                    </button>
                    <div class="dropdown-menu to-top dropdown-menu-sm">
                        <div
                            class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                            <div>
                                <h6 class="text-lg text-primary-light fw-semibold mb-2">{{ auth()->user()->name }}</h6>
                                <span class="text-secondary-light fw-medium text-sm">{{ authUserRoles() }}</span>
                            </div>
                            <button type="button" class="hover-text-danger">
                                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                            </button>
                        </div>
                        <ul class="to-top-list">
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                    href="{{ route('dashboard.roles.profileView') }}">
                                    <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon> My
                                    Profile</a>
                            </li>
                            {{-- <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                    href="email.html">
                                    <iconify-icon icon="tabler:message-check" class="icon text-xl"></iconify-icon>
                                    Inbox</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3"
                                    href="company.html">
                                    <iconify-icon icon="icon-park-outline:setting-two"
                                        class="icon text-xl"></iconify-icon> Setting</a>
                            </li> --}}
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="cursor: pointer" class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3">
                                  @csrf
                                    <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>
                                    
                                <button type="submit">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div><!-- Profile dropdown end -->
            </div>
        </div>
    </div>
</div>
