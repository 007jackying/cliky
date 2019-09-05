<?php $__env->startSection('title'); ?>
    <?php echo e(trans('laravel2step::laravel-verification.exceededTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel verification-exceeded-panel">
                <div class="panel-heading text-center">
                    <i class="glyphicon glyphicon-lock locked-icon text-danger" aria-hidden="true"></i>
                    <h3>
                        <?php echo e(trans('laravel2step::laravel-verification.exceededTitle')); ?>

                    </h3>
                </div>
                <div class="panel-body">
                    <h4 class="text-center text-danger">
                        <em>
                            <?php echo e(trans('laravel2step::laravel-verification.lockedUntil')); ?>

                        </em>
                        <br />
                        <strong>
                            <?php echo e($timeUntilUnlock); ?>

                        </strong>
                        <br />
                        <small>
                            <?php echo e(trans('laravel2step::laravel-verification.tryAgainIn')); ?> <?php echo e($timeCountdownUnlock); ?> &hellip;
                        </small>
                    </h4>
                    <p class="text-center">
                        <a class="btn btn-info" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" tabindex="6">
                            <i class="glyphicon glyphicon-home" aria-hidden="true"></i> <?php echo e(trans('laravel2step::laravel-verification.returnButton')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('laravel2step::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>