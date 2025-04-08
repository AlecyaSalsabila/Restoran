

<?php $__env->startSection('title', 'Daftar Pesanan'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-2">
    <h1 class="text-3xl font-bold text-gray-600 mb-6">Daftar Pesanan</h1>

    <?php if(session('success')): ?>
        <div class="mb-4 text-green-500">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-4 text-red-500">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto rounded">
        <table class="min-w-full bg-white rounded-lg shadow-lg border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-md">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="border-t border-gray-200 px-4 py-3 text-center"><?php echo e($loop->iteration); ?></td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center"><?php echo e($order->user->name); ?></td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center">Rp <?php echo e(number_format($order->total_price, 2, ',', '.')); ?></td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center">
                        <form action="<?php echo e(route('orders.confirmOrder', $order->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?> 
                            <select name="status" class="border rounded-md bg-white hover:bg-gray-100 transition" onchange="this.form.submit()">
                                <option value="confirmed" <?php echo e($order->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                <option value="completed" <?php echo e($order->status == 'completed' ? 'selected' : ''); ?>>Completed</option>
                            </select>
                        </form>
                        
                    </td>
                    
                    <td class="border-t border-gray-200 px-4 py-3 text-center">
                        <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="font-bold bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <?php if($orders->isEmpty()): ?>
        <p class="mt-4 text-center text-gray-600">Tidak ada pesanan.</p>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/orders/index.blade.php ENDPATH**/ ?>