

<?php $__env->startSection('title', 'Pesanan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-2">
    <h2 class="text-3xl font-bold text-gray-600 mb-6">Pesanan Saya</h2>
</div>

<?php if($orders->isEmpty()): ?>
    <p class="text-center">Tidak ada pesanan yang ditemukan.</p>
<?php else: ?>
    <div class="overflow-x-auto rounded">
        <table class="min-w-full bg-white border border-gray-300 shadow-md mx-auto">
            <thead class="bg-gray-200">
                <tr class="bg-gray-200 text-gray-600 text-md">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Transaction ID</th>
                    <th class="py-2 px-4">Total</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b hover:bg-gray-100 text-center">
                        <td class="py-2 px-4"><?php echo e($loop->iteration); ?></td>
                        <td class="py-2 px-4"><?php echo e($order->transaction_id ?? 'N/A'); ?></td> 
                        <td class="py-2 px-4">Rp <?php echo e(number_format($order->total_price, 2, ',', '.')); ?></td>
                        <td class="py-2 px-4"><?php echo e($order->created_at->format('d-m-Y')); ?></td>
                        <td class="py-2 px-4">
                            <a href="<?php echo e(route('myorders.show', $order->id)); ?>" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/myorders/index.blade.php ENDPATH**/ ?>