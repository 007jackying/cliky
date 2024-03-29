<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.title'); ?>
<?php $__env->stopSection(); ?>

<?php if(config('LaravelLogger.enableBladeJsPlacement')): ?>
    <?php $__env->startSection('template_linked_css'); ?>
        <?php echo $__env->make('LaravelLogger::partials.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php $__env->stopSection(); ?>
<?php else: ?>
    <?php echo $__env->make('LaravelLogger::partials.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php
    switch (config('LaravelLogger.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('LaravelLogger.bootstrapCardClasses')) ? '' : config('LaravelLogger.bootstrapCardClasses'));
?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">

        <?php if(config('LaravelLogger.enablePackageFlashMessageBlade')): ?>
            <?php echo $__env->make('LaravelLogger::partials.form-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="<?php echo e($containerClass); ?> <?php echo e($bootstrapCardClasses); ?>">
                    <div class="<?php echo e($containerHeaderClass); ?>">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <?php if(config('LaravelLogger.enableSubMenu')): ?>

                                <span>
                                    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.title'); ?>
                                    <small>
                                        <sup class="label label-default">
                                            <?php echo e($totalActivities); ?> <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.subtitle'); ?>
                                        </sup>
                                    </small>
                                </span>

                                <div class="btn-group pull-right btn-group-xs">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                        <span class="sr-only">
                                            <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.menu.alt'); ?>
                                        </span>
                                    </button>
                                    <?php if(config('LaravelLogger.bootstapVersion') == '4'): ?>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php echo $__env->make('LaravelLogger::forms.clear-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            <a href="<?php echo e(route('cleared')); ?>" class="dropdown-item">
                                                <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                                                <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.menu.show'); ?>
                                            </a>
                                        </div>
                                    <?php else: ?>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li class="dropdown-item">
                                                <?php echo $__env->make('LaravelLogger::forms.clear-activity-log', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                            </li>
                                            <li class="dropdown-item">
                                                <a href="<?php echo e(route('cleared')); ?>">
                                                    <i class="fa fa-fw fa-history" aria-hidden="true"></i>
                                                    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.menu.show'); ?>
                                                </a>
                                            </li>
                                        </ul>
                                    <?php endif; ?>
                                </div>

                            <?php else: ?>
                                <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.title'); ?>
                                <span class="pull-right label label-default">
                                    <?php echo e($totalActivities); ?>

                                    <span class="hidden-sms">
                                        <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.subtitle'); ?>
                                    </span>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="<?php echo e($containerBodyClass); ?>">
                        <?php echo $__env->make('LaravelLogger::logger.partials.activity-table', ['activities' => $activities, 'hoverable' => true], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('LaravelLogger::modals.confirm-modal', ['formTrigger' => 'confirmDelete', 'modalClass' => 'danger', 'actionBtnIcon' => 'fa-trash-o'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php if(config('LaravelLogger.enableBladeJsPlacement')): ?>
    <?php $__env->startSection('footer_scripts'); ?>
<?php endif; ?>

    <?php if(config('LaravelLogger.enablejQueryCDN')): ?>
        <script type="text/javascript" src="<?php echo e(config('LaravelLogger.JQueryCDN')); ?>"></script>
    <?php endif; ?>

    <?php if(config('LaravelLogger.enableBootstrapJsCDN')): ?>
        <script type="text/javascript" src="<?php echo e(config('LaravelLogger.bootstrapJsCDN')); ?>"></script>
    <?php endif; ?>

    <?php if(config('LaravelLogger.enablePopperJsCDN')): ?>
        <script type="text/javascript" src="<?php echo e(config('LaravelLogger.popperJsCDN')); ?>"></script>
    <?php endif; ?>

    <?php echo $__env->make('LaravelLogger::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php if(config('LaravelLogger.loggerDatatables')): ?>
        <?php if(count($activities) > 10): ?>
            <?php echo $__env->make('LaravelLogger::scripts.datatables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(config('LaravelLogger.enableDrillDown')): ?>
        <?php echo $__env->make('LaravelLogger::scripts.clickable-row', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('LaravelLogger::scripts.tooltip', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

<?php if(config('LaravelLogger.enableBladeJsPlacement')): ?>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make(config('LaravelLogger.loggerBladeExtended'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>