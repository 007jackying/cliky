<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('departmentmanagement.editing-department',['department'=>$department->name]); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <?php echo app('translator')->getFromJson('departmentmanagement.editing-department',['department'=>$department->name]); ?>
                            <div class="pull-right">
                                <a href="<?php echo route('departments'); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('departmentmanagement.tooltips.back-departments'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('departmentmanagement.buttons.back-to-departments'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(array('route' => ['departments.update', $department->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('name') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('name', trans('forms.department-name'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('name',$department->name,array('id'=>'name','class'=>'form-control')); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-asterisk" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo Form::button(trans('forms.update_department_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>