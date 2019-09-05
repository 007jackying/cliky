<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('retailermanagement.create-new-retailer'); ?>
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
                            <?php echo app('translator')->getFromJson('retailermanagement.create-new-retailer'); ?>
                            <div class="pull-right">
                                <a href="<?php echo route('retailers'); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('retailermanagement.tooltips.back-retailers'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('retailermanagement.buttons.back-to-retailers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(array('route' => 'retailers.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation','files'=>true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('name') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('name', trans('forms.retailer-name'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('name',null,array('id'=>'name','class'=>'form-control')); ?>

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
                                    <?php echo Form::text('url',NULL, array('id' => 'url', 'class' => 'form-control' )); ?>

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

                        <div class="form-group has-feedback row <?php echo e($errors->has('file') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('logo', trans('forms.retailer-brand'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo" accept=".png">
                                    <label class="custom-file-label" for="customFile">Choose brand logo</label>
                                </div>
                                <?php if($errors->has('offersFile')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('logo')); ?></strong>
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
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('footer_scripts'); ?>
    <script>
        $(function(){
            $("input[type=file]").change(function(){
                var fieldVal = $(this).val();
                fieldVal = fieldVal.replace("C:\\fakepath\\", "");

                if (fieldVal != undefined || fieldVal != "") {
                    $(this).next(".custom-file-label").attr('data-content', fieldVal);
                    $(this).next(".custom-file-label").text(fieldVal);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>