

<?php $__env->startSection('title', 'Detail Pesanan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto mt-2">
    <h1 class="text-3xl font-bold text-gray-600 mb-6">Detail Pesanan Saya</h1>

    <div class="bg-white shadow-md rounded p-6 border border-blue-300">
        <p class="mb-2"><strong>ID Pesanan:</strong> <?php echo e($order->id); ?></p>

        <strong>Menu:</strong>
        <div class="overflow-x-auto mt-2 rounded">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Menu</th>
                        <th class="px-4 py-2 text-center">Price/Pcs</th>
                        <th class="px-4 py-2 text-center">Amount</th>
                        <th class="px-4 py-2 text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($order->items && $order->items->isNotEmpty()): ?>
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="border-t border-gray-300 px-4 py-2"><?php echo e($item->menu->name); ?></td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center">Rp <?php echo e(number_format($item->menu->price, 2, ',', '.')); ?></td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center"><?php echo e($item->amount); ?></td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center">Rp <?php echo e(number_format($item->menu->price * $item->amount, 2, ',', '.')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="border-t border-gray-300 px-4 py-2 text-center">Tidak ada menu terkait.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <p class="mb-2 mt-4"><strong>Total:</strong> Rp <?php echo e(number_format($order->total_price, 2, ',', '.')); ?></p>
        <p class="mb-2"><strong>Status:</strong>
            <span class="<?php echo e($order->status == 'confirmed' ? 'rounded font-bold bg-yellow-400 text-black px-1 py-2' : 'font-bold bg-green-600 text-white'); ?>">
                <?php echo e(ucfirst($order->status)); ?>

            </span>
        </p>
        <p class="mb-2"><strong>Tanggal:</strong> <?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
    </div>

    <div class="mt-6">
        <a href="<?php echo e(route('myorders.index')); ?>" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/myorders/show.blade.php ENDPATH**/ ?>