<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="<?php echo csrf_token(); ?>" >
        <title><?php if(trim($__env->yieldContent('title'))): ?><?php echo $__env->yieldContent('title'); ?> | <?php endif; ?> <?php echo e(config('app.name', 'Laravel 2-Step Verification')); ?></title>
        <?php if(config('laravel2step.laravel2stepBootstrapCssCdnEnbled')): ?>
            <link rel="stylesheet" type="text/css" href="<?php echo e(config('laravel2step.laravel2stepBootstrapCssCdn')); ?>">
        <?php endif; ?>
        <?php if(config('laravel2step.laravel2stepAppCssEnabled')): ?>
            <link rel="stylesheet" type="text/css" href="<?php echo e(asset(config('laravel2step.laravel2stepAppCss'))); ?>">
        <?php endif; ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset(config('laravel2step.laravel2stepCssFile'))); ?>">
        <?php echo $__env->yieldContent('head'); ?>
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>
    </head>
    <body>
        <div id="app" class="two-step-verification">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
        <?php echo $__env->yieldContent('foot'); ?>
    </body>
</html>
