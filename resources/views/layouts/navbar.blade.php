<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- الشعار -->
            <div class="text-2xl font-bold text-blue-600">
                <a href="{{ route('home') }}">متجري</a>
            </div>

            <!-- روابط التنقل (للشاشات الكبيرة) -->
            <div class="hidden md:flex items-center space-x-6 space-x-reverse">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('home') ? 'text-blue-600 font-bold' : '' }}">
                    الرئيسية
                </a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 transition duration-300 {{ request()->routeIs('products.*') ? 'text-blue-600 font-bold' : '' }}">
                    المنتجات
                </a>
                
                <!-- قائمة المستخدم (إذا كان مسجل دخول) -->
                @auth
                <div class="relative group" id="user-menu-container">
                    <button class="flex items-center space-x-2 space-x-reverse px-4 py-2 rounded-xl
                                text-gray-700 hover:text-blue-600 
                                hover:bg-blue-50 active:bg-blue-100
                                transition-all duration-300 ease-in-out
                                focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50
                                border border-transparent hover:border-blue-200"
                            id="user-menu-button">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        
                        <!-- أيقونة مع دوران -->
                        <svg class="w-4 h-4 mr-1 transform transition-transform duration-300 ease-in-out group-hover:rotate-180" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- القائمة المنسدلة مع delay -->
                    <div class="absolute left-0 mt-3 w-56 
                                bg-white rounded-2xl shadow-xl 
                                border border-gray-100
                                opacity-0 invisible group-hover:opacity-100 group-hover:visible
                                transition-all duration-300 ease-in-out
                                transform origin-top-right scale-95 group-hover:scale-100
                                z-50 overflow-hidden"
                        id="user-menu-dropdown"
                        onmouseenter="keepMenuOpen()"
                        onmouseleave="closeMenu()">
                        
                        <!-- رأس القائمة -->
                        <div class="px-4 py-3 bg-gradient-to-l from-blue-50 to-indigo-50 border-b border-gray-100">
                            <p class="text-sm text-gray-500">مسجل كـ</p>
                            <p class="font-semibold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <!-- روابط القائمة -->
                        <div class="py-2">
                            @if(Auth::user()->email === 'admin@admin.com')
                                <a href="{{ route('admin.products.index') }}" 
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    <span>لوحة التحكم</span>
                                </a>
                            @endif
                            
                            <a href="{{ route('profile.admin') }}" 
                            class="flex items-center px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span>الملف الشخصي</span>
                            </a>
                            
                            <div class="border-t border-gray-100 my-2"></div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center w-full px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-600 transition-colors duration-200">
                                    <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    <span>تسجيل الخروج</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    let menuTimeout;

                    function keepMenuOpen() {
                        clearTimeout(menuTimeout);
                        const dropdown = document.getElementById('user-menu-dropdown');
                        dropdown.classList.remove('opacity-0', 'invisible');
                        dropdown.classList.add('opacity-100', 'visible');
                    }

                    function closeMenu() {
                        menuTimeout = setTimeout(() => {
                            const dropdown = document.getElementById('user-menu-dropdown');
                            if (!dropdown.matches(':hover') && !document.getElementById('user-menu-button').matches(':hover')) {
                                dropdown.classList.add('opacity-0', 'invisible');
                                dropdown.classList.remove('opacity-100', 'visible');
                            }
                        }, 300); // تأخير 300ms قبل الإخفاء
                    }

                    // إضافة event listeners للزر
                    document.getElementById('user-menu-button').addEventListener('mouseenter', function() {
                        clearTimeout(menuTimeout);
                        const dropdown = document.getElementById('user-menu-dropdown');
                        dropdown.classList.remove('opacity-0', 'invisible');
                        dropdown.classList.add('opacity-100', 'visible');
                    });

                    document.getElementById('user-menu-button').addEventListener('mouseleave', function() {
                        closeMenu();
                    });

                    // منع إغلاق القائمة عند النقر داخلها
                    document.getElementById('user-menu-dropdown').addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                </script>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition duration-300">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        إنشاء حساب
                    </a>
                @endauth
            </div>

            <!-- أيقونات جانبية -->
            <div class="flex items-center space-x-4 space-x-reverse">
                <!-- سلة التسوق -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ count(session('cart', [])) }}
                    </span>
                </a>

                <!-- زر القائمة للشاشات الصغيرة -->
                <button class="md:hidden text-gray-700 hover:text-blue-600" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- القائمة الجانبية للشاشات الصغيرة -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
        <div class="px-4 py-2 space-y-2">
            <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600 font-bold' : '' }}">
                الرئيسية
            </a>
            <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-blue-600 {{ request()->routeIs('products.*') ? 'text-blue-600 font-bold' : '' }}">
                المنتجات
            </a>
            
            @auth
                @if(Auth::user()->email === 'admin@admin.com')
                <a href="{{ route('admin.products.index') }}" class="block py-2 text-gray-700 hover:text-blue-600">لوحة التحكم</a>
                @endif
                <a href="{{ route('profile.admin') }}" class="block py-2 text-gray-700 hover:text-blue-600">الملف الشخصي</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-right py-2 text-gray-700 hover:text-blue-600">
                        تسجيل الخروج
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-gray-700 hover:text-blue-600">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="block py-2 text-gray-700 hover:text-blue-600">إنشاء حساب</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>