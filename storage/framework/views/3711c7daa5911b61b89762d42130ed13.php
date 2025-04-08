

<?php
    use Illuminate\Support\Str;
?>

<?php $__env->startSection('title', 'Detail Menu'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Detail Menu: <?php echo e($menu->name); ?></h2>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="w-full">
                <img 
                    src="<?php echo e($menu->image_url ? asset('storage/' . $menu->image_url) : asset('storage/default.jpg')); ?>" 
                    alt="<?php echo e($menu->name); ?>" 
                    class="w-full h-80 object-cover rounded-t-lg shadow-md">
            </div>
            <div class="p-6 space-y-4"> 
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800"><?php echo e($menu->name); ?></h3>
                </div>
                <div class="flex items-center space-x-2">
                    <strong class="text-gray-700">Price:</strong>
                    <span class="text-xl text-green-600 font-bold">Rp <?php echo e(number_format($menu->price, 2, ',', '.')); ?></span>
                </div>
                <div class="flex items-center space-x-2">
                    <strong class="text-gray-700">Stock:</strong>
                    <span class="text-xl"><?php echo e($menu->stock); ?></span>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700">Description:</strong>
                    <p class="text-gray-600 text-justify">
                        <?php echo e($menu->description ?? 'No description has been provided.'); ?>

                    </p>
                </div>
                <div class="flex space-x-4 mt-6">
                    <a href="<?php echo e(route('menus.index')); ?>" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/menus/show.blade.php ENDPATH**/ ?>