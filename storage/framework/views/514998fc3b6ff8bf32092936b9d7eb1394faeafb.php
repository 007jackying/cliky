<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('retailermanagement.editing-retailer',['retailer'=>$retailer->name]); ?>
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
                            <?php echo app('translator')->getFromJson('retailermanagement.editing-retailer',['retailer'=>$retailer->name]); ?>
                            <div class="pull-right">
                                <a href="<?php echo route('retailers'); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('retailermanagement.tooltips.back-retailers'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('retailermanagement.buttons.back-to-retailers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(array('route' => ['retailers.update', $retailer->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('name') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('name', trans('forms.retailer-name'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('name',$retailer->name,array('id'=>'name','class'=>'form-control')); ?>

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

                        <div class="form-group has-feedback row <?php echo e($errors->has('url') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('url', trans('forms.retailer-url'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('url',$retailer->url, array('id' => 'url', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="url">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('url')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('url')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php echo Form::button(trans('forms.create_retailer_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

                        <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>

<?php $__env->startSection; ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>