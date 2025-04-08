<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Default Title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body style="background-image: url('<?php echo e(asset('img/wp1.png')); ?>'); background-size: cover; background-position: center;"><?php echo $__env->yieldContent('content'); ?> </body>

</html>
<?php /**PATH C:\laragon\www\examrestaurant\resources\views/layouts/app.blade.php ENDPATH**/ ?>