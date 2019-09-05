<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id]); ?>
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

    switch ($activity->userType) {
        case trans('LaravelLogger::laravel-logger.userTypes.registered'):
            $userTypeClass = 'success';
            break;

        case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
            $userTypeClass = 'danger';
            break;

        case trans('LaravelLogger::laravel-logger.userTypes.guest'):
        default:
            $userTypeClass = 'warning';
            break;
    }

    switch (strtolower($activity->methodType)) {
        case 'get':
            $methodClass = 'info';
            break;

        case 'post':
            $methodClass = 'primary';
            break;

        case 'put':
            $methodClass = 'caution';
            break;

        case 'delete':
            $methodClass = 'danger';
            break;

        default:
            $methodClass = 'info';
            break;
    }

    $platform       = $userAgentDetails['platform'];
    $browser        = $userAgentDetails['browser'];
    $browserVersion = $userAgentDetails['version'];

    switch ($platform) {

        case 'Windows':
            $platformIcon = 'fa-windows';
            break;

        case 'iPad':
            $platformIcon = 'fa-';
            break;

        case 'iPhone':
            $platformIcon = 'fa-';
            break;

        case 'Macintosh':
            $platformIcon = 'fa-apple';
            break;

        case 'Android':
            $platformIcon = 'fa-android';
            break;

        case 'BlackBerry':
            $platformIcon = 'fa-';
            break;

        case 'Unix':
        case 'Linux':
            $platformIcon = 'fa-linux';
            break;

        default:
            $platformIcon = 'fa-';
            break;
    }

    switch ($browser) {

        case 'Chrome':
            $browserIcon  = 'fa-chrome';
            break;

        case 'Firefox':
            $browserIcon  = 'fa-';
            break;

        case 'Opera':
            $browserIcon  = 'fa-opera';
            break;

        case 'Safari':
            $browserIcon  = 'fa-safari';
            break;

        case 'Internet Explorer':
            $browserIcon  = 'fa-edge';
            break;

        default:
            $browserIcon  = 'fa-';
            break;
    }
?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <?php if(config('LaravelLogger.enablePackageFlashMessageBlade')): ?>
        <?php echo $__env->make('LaravelLogger::partials.form-status', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <div class="panel <?php if($isClearedEntry): ?> panel-danger <?php else: ?> panel-default <?php endif; ?>">
        <div class="<?php echo e($containerClass); ?> <?php if($isClearedEntry): ?> panel-danger <?php else: ?> panel-default <?php endif; ?>">
        <div class="<?php echo e($containerHeaderClass); ?> <?php if($isClearedEntry): ?> bg-danger text-white <?php else: ?> <?php endif; ?>" >
            <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id]); ?>
            <a href="<?php if($isClearedEntry): ?> <?php echo e(route('cleared')); ?> <?php else: ?> <?php echo e(route('activity')); ?> <?php endif; ?>" class="btn <?php if($isClearedEntry): ?> btn-default <?php else: ?> btn-info <?php endif; ?> btn-sm pull-right">
                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.buttons.back'); ?>
            </a>
        </div>
        <div class="<?php echo e($containerBodyClass); ?>">
            <div class="row">
                <div class="col-xs-12 col-12">
                    <div class="row">

                        <div class="col-md-6 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                                    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title-details'); ?>
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.id'); ?></dt>
                                        <dd><?php echo e($activity->id); ?></dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.description'); ?></dt>
                                        <dd><?php echo e($activity->description); ?></dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.route'); ?></dt>
                                        <dd>
                                            <a href="<?php if($activity->route != '/'): ?>/<?php endif; ?><?php echo e($activity->route); ?>">
                                                <?php echo e($activity->route); ?>

                                            </a>
                                        </dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.agent'); ?></dt>
                                        <dd>
                                            <i class="fa <?php echo e($platformIcon); ?> fa-fw" aria-hidden="true">
                                                <span class="sr-only">
                                                    <?php echo e($platform); ?>

                                                </span>
                                            </i>
                                            <i class="fa <?php echo e($browserIcon); ?> fa-fw" aria-hidden="true">
                                                <span class="sr-only">
                                                    <?php echo e($browser); ?>

                                                </span>
                                            </i>
                                            <sup>
                                                <small>
                                                    <?php echo e($browserVersion); ?>

                                                </small>
                                            </sup>
                                        </dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.locale'); ?></dt>
                                        <dd>
                                            <?php echo e($langDetails); ?>

                                        </dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.referer'); ?></dt>
                                        <dd>
                                            <a href="<?php echo e($activity->referer); ?>">
                                                <?php echo e($activity->referer); ?>

                                            </a>
                                        </dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.methodType'); ?></dt>
                                        <dd>
                                            <span class="badge badge-<?php echo e($methodClass); ?>">
                                                <?php echo e($activity->methodType); ?>

                                            </span>
                                        </dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.timePassed'); ?></dt>
                                        <dd><?php echo e($timePassed); ?></dd>

                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.createdAt'); ?></dt>
                                        <dd><?php echo e($activity->created_at); ?></dd>

                                    </dl>
                                </li>
                            </ul>
                            <br />
                        </div>

                        <div class="col-md-6 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                                    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title-ip-details'); ?>
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.ip'); ?></dt>
                                        <dd><?php echo e($activity->ipAddress); ?></dd>
                                        <?php if($ipAddressDetails): ?>
                                            <?php $__currentLoopData = $ipAddressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipAddressDetailKey => $ipAddressDetailValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <dt><?php echo e($ipAddressDetailKey); ?></dt>
                                                <dd><?php echo e($ipAddressDetailValue); ?></dd>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <p class="text-center disabled">
                                                <br />
                                                Additional Ip Address Data Not Available.
                                            </p>
                                        <?php endif; ?>
                                    </dl>
                                </li>
                            </ul>

                            <br />
                        </div>

                        <div class="col-md-12 col-lg-4">
                            <ul class="list-group">
                                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                                    <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title-user-details'); ?>
                                </li>
                                <li class="list-group-item">
                                    <dl class="dl-horizontal">
                                        <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userType'); ?></dt>
                                        <dd>
                                            <span class="badge badge-<?php echo e($userTypeClass); ?>">
                                                <?php echo e($activity->userType); ?>

                                            </span>
                                        </dd>

                                        <?php if($userDetails): ?>

                                            <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userId'); ?></dt>
                                            <dd><?php echo e($userDetails->id); ?></dd>

                                            <?php if(config('LaravelLogger.rolesEnabled')): ?>

                                                <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.labels.userRoles'); ?></dt>

                                                  <?php $__currentLoopData = $userDetails->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($user_role->name == 'User'): ?>
                                                      <?php $labelClass = 'primary' ?>

                                                    <?php elseif($user_role->name == 'Admin'): ?>
                                                      <?php $labelClass = 'warning' ?>

                                                    <?php elseif($user_role->name == 'Unverified'): ?>
                                                      <?php $labelClass = 'danger' ?>

                                                    <?php else: ?>
                                                      <?php $labelClass = 'default' ?>

                                                    <?php endif; ?>

                                                    <dd>
                                                        <span class="badge badge-<?php echo e($labelClass); ?>">
                                                            <?php echo e($user_role->name); ?> - <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.labels.userLevel'); ?> <?php echo e($user_role->level); ?>

                                                        </span>
                                                    </dd>

                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php endif; ?>


                                            <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userName'); ?></dt>
                                            <dd><?php echo e($userDetails->name); ?></dd>

                                            <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userEmail'); ?></dt>
                                            <dd>
                                                <a href="mailto:<?php echo e($userDetails->email); ?>">
                                                    <?php echo e($userDetails->email); ?>

                                                </a>
                                            </dd>

                                            <?php if($userDetails->last_name || $userDetails->first_name): ?>
                                                <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userFulltName'); ?></dt>
                                                <dd><?php echo e($userDetails->last_name); ?>, <?php echo e($userDetails->first_name); ?></dd>
                                            <?php endif; ?>

                                            <?php if($userDetails->signup_ip_address): ?>
                                                <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userSignupIp'); ?></dt>
                                                <dd><?php echo e($userDetails->signup_ip_address); ?></dd>
                                            <?php endif; ?>

                                            <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userCreatedAt'); ?></dt>
                                            <dd><?php echo e($userDetails->created_at); ?></dd>

                                            <dt><?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.list-group.labels.userUpdatedAt'); ?></dt>
                                            <dd><?php echo e($userDetails->updated_at); ?></dd>

                                        <?php endif; ?>

                                    </dl>
                                </li>
                            </ul>

                            <br />
                        </div>

                    </div>
                </div>
            </div>

            <?php if(!$isClearedEntry): ?>
                <div class="row">
                    <div class="col-xs-12 col-12">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info">
                                <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.drilldown.title-user-activity'); ?>
                                <span class="badge">
                                    <?php echo e($totalUserActivities); ?> <?php echo app('translator')->getFromJson('LaravelLogger::laravel-logger.dashboard.subtitle'); ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <?php echo $__env->make('LaravelLogger::logger.partials.activity-table', ['activities' => $userActivities], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </li>
                        </ul>
                        <br />
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
  </div>
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

    <?php if(config('LaravelLogger.loggerDatatables')): ?>
        <?php if(count($activities) > 10): ?>
            <?php echo $__env->make('LaravelLogger::scripts.datatables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <?php endif; ?>

<?php if(config('LaravelLogger.enableBladeJsPlacement')): ?>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php echo $__env->make(config('LaravelLogger.loggerBladeExtended'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>