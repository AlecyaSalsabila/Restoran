<div class="mb-4">
    <label for="<?php echo e($id); ?>" class="block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
    <input
        id="<?php echo e($id); ?>"
        type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        value="<?php echo e(old($name, isset($value) ? $value : '')); ?>" 
        class="mt-1 block w-full border border-gray-500 rounded-md p-2"
        style="background-color: #f0f0f0; color: #333;"
    >
    <?php if($errors->has($name)): ?>
        <p class="mt-1 text-sm text-red-600"><?php echo e($errors->first($name)); ?></p>
    <?php endif; ?>
</div>
 <?php /**PATH C:\laragon\www\examrestaurant\resources\views/components/input.blade.php ENDPATH**/ ?>