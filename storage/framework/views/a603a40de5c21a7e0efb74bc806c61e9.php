<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>
</head>
<body class="bg-gray-100 flex"
      x-data="{ open: localStorage.getItem('sidebarOpen') == 'true', isOpen: false }"
      x-init="$watch('open', value => localStorage.setItem('sidebarOpen', value))">

      <?php
        use Illuminate\Support\Str;
      ?>

    <div :class="{'-translate-x-full': !open, 'translate-x-0': open}"
         class="w-48 bg-indigo-700 text-white shadow-md h-screen transform transition-transform duration-300 ease-in-out fixed left-0 top-0 z-10">
        <div class="p-4 border-b border-indigo-800">
            <h2 class="text-2xl font-semibold text-center">My-Rest</h2>
        </div>

        <div class="mt-5">
            <div class="flex flex-col space-y-2">
          
                <div class="h-20 flex items-center justify-center text-center">
                    <a href="<?php echo e(route('menus.index')); ?>" class="rounded hover:bg-blue-600 px-4 py-2 border-b w-[500px] text-center">
                        Menu Makanan
                    </a>
                </div>

                <div class="h-20 flex items-center justify-center text-center">
                    <a href="<?php echo e(route('myorders.index')); ?>" class="rounded hover:bg-blue-600 px-4 py-2 border-b w-[500px] text-center">
                        Pesanan Saya
                    </a>
                </div>

                <?php if(Auth::check() && Auth::user()->isAdmin()): ?>
                    <div class="h-20 flex items-center justify-center text-center">
                        <a href="<?php echo e(route('orders.index')); ?>" class="rounded hover:bg-blue-600 px-4 py-2 border-b w-[500px] text-center <?php echo e(request()->is('orders') ? 'bg-blue-600' : ''); ?>">
                            Daftar Pesanan
                        </a>
                    </div>
                    <div class="h-20 flex items-center justify-center text-center">
                        <a href="<?php echo e(route('reports.index')); ?>" class="rounded hover:bg-blue-600 px-4 py-2 border-b w-[500px] text-center">
                            Laporan
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div :class="{'ml-48': open, 'ml-0': !open}" class="flex-1 transition-all duration-300">
        <nav class="bg-white shadow mb-4 flex justify-between items-center p-3" style="min-height: 64px;">
            <div class="flex items-center">
                <button @click="open = !open" class="text-lg font-semibold text-black focus:outline-none">☰</button>
            </div>

            <div class="relative ml-4 flex items-center">
                <div class="mr-2">
                    <span class="font-semibold text-gray-800"><?php echo e(Auth::check() ? Auth::user()->name : 'Guest'); ?></span>
                    <div class="text-sm text-gray-600">
                        <?php echo e(Auth::check() && Auth::user()->isAdmin() ? 'Admin' : 'Customer'); ?>

                    </div>
                </div>
                <button type="button" @click="isOpen = !isOpen" class="flex items-center rounded-full focus:outline-none mr-2">
                    <img class="h-10 w-12 rounded-full" src="<?php echo e(asset('img/profile.png')); ?>" alt="Profile Picture">
                </button>

                <div x-show="isOpen"
                     x-transition:enter="transition ease-out duration-100 transform"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75 transform"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 z-10 mt-20 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="block px-4 py-2 text-sm text-gray-700">Sign out</button>
                    </form>
                </div>
            </div>
        </nav>

        <main class="p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <script>
        if (localStorage.getItem('sidebarOpen') === null) {
            localStorage.setItem('sidebarOpen', 'true');
        }
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\examrestaurant\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>