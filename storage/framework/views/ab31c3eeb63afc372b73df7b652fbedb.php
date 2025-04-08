

<?php $__env->startSection('title', 'Tambah Menu'); ?>

<?php $__env->startSection('content'); ?>
    <h2 class="text-2xl font-semibold mb-4">Tambah Menu</h2>

    <form action="<?php echo e(route('menus.store')); ?>" method="POST" enctype="multipart/form-data" id="menu-form">
        <?php echo csrf_field(); ?>

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Menu Name :</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded w-full"value="<?php echo e(old('name')); ?>" aria-label="Menu Name"/>
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
            <label for="price" class="block text-gray-700">Price :</label>
            <input type="number" step="0.01" name="price" id="price" class="mt-1 p-2 border rounded w-full"value="<?php echo e(old('price')); ?>"aria-label="Price"/>
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
            <label for="stock" class="block text-gray-700">Stock :</label>
            <input type="number" name="stock" id="stock" class="mt-1 p-2 border rounded w-full"value="<?php echo e(old('stock')); ?>"aria-label="Stock"/>
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

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description :</label>
            <textarea name="description" id="description" class="mt-1 p-2 border rounded w-full"rows="4"aria-label="Description"><?php echo e(old('description')); ?></textarea> 
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
            <label for="image" class="block text-gray-700">Upload Image :</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border rounded w-full object-contain" accept="image/*"onchange="previewImage(event)"aria-label="Upload Image"/>
            <?php $__errorArgs = ['image'];
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

        <div class="mb-4" id="imagePreview" style="display:none;">
            <label class="block text-gray-700">Image Preview:</label>
            <img id="preview" src="#" alt="Image Preview" class="mt-2 max-w-xs" />
        </div>

        <div class="flex space-x-4">
            <button type="submit" id="save-button" class="font-bold bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Save</button>
            <a href="<?php echo e(route('menus.index')); ?>" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function() {
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');
                
                preview.src = reader.result;
                previewContainer.style.display = 'block'; 
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('menu-form').addEventListener('submit', function (event) {
            const saveButton = document.getElementById('save-button');
            saveButton.disabled = true; 
            saveButton.innerText = 'Processing...'; 
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/menus/create.blade.php ENDPATH**/ ?>