

<?php
    use Illuminate\Support\Str;
?>

<?php $__env->startSection('title', 'Daftar Menu'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Daftar Menu</h2>

    <?php if(session('success')): ?>
    <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded" role="alert">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(Auth::check() && Str::endsWith(Auth::user()->email, '@admin.com')): ?>
        <a href="<?php echo e(route('menus.create')); ?>" class="font-bold mb-4 inline-block bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700" aria-label="Tambah Menu">Tambah Menu</a>
    <?php endif; ?>
    
    <?php if(Auth::check()): ?>
        <div class="bg-blue-100 p-6 rounded-lg shadow-lg mb-6">

                <label class="text-sm text-gray-700">Apakah Anda ingin memesan? Silahkan klik "Pesan" terlebih dahulu</label>
                <div class="mt-2">
                <a href="<?php echo e(route('myorders.create')); ?>" class="font-bold inline-block bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600" aria-label="Pesan Menu" disabled>Pesan</a>
                </div>         
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img 
                    src="<?php echo e($menu->image_url ? asset('storage/' . $menu->image_url) : asset('storage/default.jpg')); ?>" 
                    alt="<?php echo e($menu->name); ?>" 
                    class="w-full h-48 object-cover"
                >

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800"><?php echo e($menu->name); ?></h3>
                    <p class="text-sm text-gray-600">Stock: <?php echo e($menu->stock); ?></p>
                    <p class="text-xl text-green-600 font-bold">Rp <?php echo e(number_format($menu->price, 2, ',', '.')); ?></p>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-100">
                    <a href="<?php echo e(route('menus.show', $menu->id)); ?>" class="font-bold bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700" aria-label="Lihat menu <?php echo e($menu->name); ?>">Detail</a>

                    <?php if(Auth::check() && Str::endsWith(Auth::user()->email, '@admin.com')): ?>
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('menus.edit', $menu->id)); ?>" class="font-bold bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600" aria-label="Edit menu <?php echo e($menu->name); ?>">Edit</a>

                            <form action="<?php echo e(route('menus.destroy', $menu->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="font-bold bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" aria-label="Hapus menu <?php echo e($menu->name); ?>">Hapus</button>
                            </form>
                        </div>
                    <?php endif; ?>

             
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-3 text-center text-gray-600 p-4">
                Tidak ada menu tersedia
            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/menus/index.blade.php ENDPATH**/ ?>