<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('offermanagement.create-new-offer'); ?>
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
                            <?php echo app('translator')->getFromJson('offermanagement.create-new-offer'); ?>
                            <div class="pull-right">
                                <a href="<?php echo route('offers'); ?>" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('offermanagement.tooltips.back-offers'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.back-to-offers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php echo Form::open(array('route' => 'offers.import_process', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation','files'=>true)); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('file') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('file', trans('forms.upload_offer_file'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" name="offersFile" class="custom-file-input" id="offersFile" accept=".csv,.xlsx">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <?php if($errors->has('offersFile')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('offersFile')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>



                        <?php echo Form::button(trans('forms.create_offer_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )); ?>

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