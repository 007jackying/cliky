<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('departmentmanagement.showing-all-departments'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <?php if(config('laravelusers.enabledDatatablesJs')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('laravelusers.datatablesCssCDN')); ?>">
    <?php endif; ?>
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <?php echo app('translator')->getFromJson('departmentmanagement.showing-all-departments'); ?>
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        <?php echo app('translator')->getFromJson('departmentmanagement.departments-menu-alt'); ?>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo URL::to('/departments/create'); ?>" class="dropdown-item">
                                        <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                        <?php echo app('translator')->getFromJson('departmentmanagement.create-new-department'); ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo URL::to('departments.deleted'); ?>">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        <?php echo app('translator')->getFromJson('departmentmanagement.show-deleted-department'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(config('settings.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-users-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                            <div class="table-responsive departments-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="department_count">
                                        <?php echo e(trans_choice('departmentmanagement.departments-table.caption',1,['departmentscount'=>$departments->count()])); ?>

                                    </caption>
                                    <thead class="thead">
                                        <tr>
                                            <th><?php echo app('translator')->getFromJson('departmentmanagement.departments-table.id'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('departmentmanagement.departments-table.name'); ?></th>
                                            <th><?php echo app('translator')->getFromJson('usersmanagement.users-table.actions'); ?></th>
                                            <th class="no-search no-sort"></th>
                                            <th class="no-search no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="departments-table">
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo $key+1; ?></td>
                                            <td><?php echo $department->name; ?></td>
                                            <td>
                                                <?php echo Form::open(array('url' => 'departments/' . $department->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                                                <?php echo Form::hidden('_method', 'DELETE'); ?>

                                                <?php echo Form::button(trans('departmentmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this Offer ?')); ?>

                                                <?php echo Form::close(); ?>

                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('departments/' . $department->id . '/edit')); ?>" data-toggle="tooltip" title="Edit" style="margin-top:5px">
                                                    <?php echo app('translator')->getFromJson('departmentmanagement.buttons.edit'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                        <tbody id="search_results"></tbody>
                                            <?php if(config('settings.enableSearch')): ?>
                                                <tbody id="search_results"></tbody>
                                            <?php endif; ?>
                                        </tbody>
                                </table>
                                <?php if(config('settings.enablePagination')): ?>
                                    <?php echo e($departments->links()); ?>

                                <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
    <?php if((count($departments) > config('settings.datatablesJsStartCount')) && config('settings.enabledDatatablesJS')): ?>
        <?php echo $__env->make('scripts.datatables', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make('scripts.delete-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('scripts.save-modal-script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php if(config('settings.tooltipsEnabled')): ?>
        <?php echo $__env->make('scripts.tooltips', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
    <?php if(config('settings.enableSearch')): ?>
        <?php echo $__env->make('scripts.search-users', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>