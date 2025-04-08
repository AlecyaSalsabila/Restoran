

<?php $__env->startSection('title', 'Register'); ?> 

<?php $__env->startSection('content'); ?> 
<div class="flex items-center justify-center min-h-screen bg-gray-100"> 
    <div class="flex bg-white shadow-2xl rounded-lg w-3/4 h-auto overflow-hidden">
        <div class="w-1/2 flex items-center justify-center">
            <img src="<?php echo e(asset('img/register.png')); ?>" alt="Register Image" class="object-cover w-full h-full"> 
        </div>
        <div class="p-8 w-1/2"> 
            <h1 class="text-2xl font-semibold text-center mb-6">REGISTER</h1>

            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                
                <?php echo $__env->make('components.input', [
                    'id' => 'name',
                    'label' => 'Name',
                    'type' => 'text',
                    'name' => 'name',
                    'placeholder' => 'Masukkan nama',
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                <?php echo $__env->make('components.input', [
                    'id' => 'email',
                    'label' => 'Email',
                    'type' => 'email',
                    'name' => 'email',
                    'placeholder' => 'Masukkan email',
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                <?php echo $__env->make('components.input', [
                    'id' => 'password',
                    'label' => 'Password',
                    'type' => 'password',
                    'name' => 'password',
                    'placeholder' => 'Masukkan password',
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                
                <?php echo $__env->make('components.input', [
                    'id' => 'password_confirmation',
                    'label' => 'Confirm Password',
                    'type' => 'password',
                    'name' => 'password_confirmation',
                    'placeholder' => 'Konfirmasi password',
                ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <button type="submit" class="w-full bg-blue-600 text-white font-semibold rounded-md py-2 hover:bg-blue-700 transition duration-200">Register</button>
            </form>

            <div class="mt-4 text-center">
                <p>Already have an account? <a href="<?php echo e(route('login.form')); ?>" class="text-blue-600 hover:underline">Login here</a></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\examrestaurant\resources\views/auth/register.blade.php ENDPATH**/ ?>