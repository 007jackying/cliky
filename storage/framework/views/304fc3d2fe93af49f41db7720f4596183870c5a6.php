<?php $__env->startSection('template_title'); ?>
    <?php echo e(Auth::user()->name); ?>'s' Homepage
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-10 offset-lg-1">

                <?php echo $__env->make('panels.welcome-panel', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>