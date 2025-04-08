

<?php $__env->startSection('title', 'Edit Menu'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Edit Menu: <?php echo e($menu->name); ?></h2>

        <form action="<?php echo e(route('menus.update', $menu->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Menu Name</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $menu->name)); ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold">Price</label>
                <input type="number" name="price" id="price" value="<?php echo e(old('price', $menu->price)); ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required min="0"step="0.01">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700 font-semibold">Stock</label>
                <input type="number" name="stock" id="stock" value="<?php echo e(old('stock', $menu->stock)); ?>" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required min="0">
        
                <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4 mt-2">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="description" id="description" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" rows="4"required><?php echo e(old('description', $menu->description)); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 font-semibold">Image</label>
                <input type="file" name="image_url" id="image_url" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" accept="image/*">
                <?php if($menu->image_url): ?>
                    <div class="mt-2">
                        <strong>Current Image:</strong><br>
                        <img src="<?php echo e(asset('storage/' . $menu->image_url)); ?>" alt="Current Menu Image" class="w-32 h-32 object-cover mt-2">
                    </div>
                <?php endif; ?>
                <?php $__errorArgs = ['image_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-red-500 text-sm mt-1"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Save</button>
                <a href="<?php echo e(route('menus.index')); ?>" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/menus/edit.blade.php ENDPATH**/ ?>