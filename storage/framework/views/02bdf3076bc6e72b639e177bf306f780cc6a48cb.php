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
                                <a href="<?php echo route('offers'); ?>" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('offermanagement.tooltips.back-offers'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.back-to-offers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php echo Form::open(array('route' => 'offers.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="form-group has-feedback row <?php echo e($errors->has('availability_id') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('availability_id', trans('forms.create_offer_availability_id'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo e(Form::select('availability_id', $arr_available, old('availability_id'), array('class'=>"form-control chosen-select",'id'=>'availability_id'))); ?>

                                </div>
                                <?php if($errors->has('availability_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('availability_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group has-feedback row <?php echo e($errors->has('date') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('date', trans('forms.create_offer_date'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('date', date('m/d/Y'), array('id' => 'date', 'class' => 'form-control', 'value' => date('mm/dd/YY'))); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
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
                        <div class="form-group has-feedback row <?php echo e($errors->has('date_code') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('date_code', trans('forms.create_offer_date_code'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('date_code',NULL, array('id' => 'date', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-barcode" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('date_code')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('date_code')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group has-feedback row <?php echo e($errors->has('retailer_id') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('retailer_id', trans('forms.create_offer_retailer_id'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo e(Form::select('retailer_id', $arr_retailer, old('retailer_id'), array('class'=>"form-control chosen-select",'id'=>'retailer_id'))); ?>

                                </div>
                                <?php if($errors->has('retailer_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('retailer_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group has-feedback row <?php echo e($errors->has('product') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('product', trans('forms.create_offer_product'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('product',NULL, array('id' => 'product', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-product-hunt" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('product')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('product')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('current_price') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('current_price', trans('forms.create_offer_current_price'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::number('current_price',NULL, array('id' => 'current_price', 'class' => 'form-control' ,'step'=>'0.01')); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-usd" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('current_price')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('current_price')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('discount_offer') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('currendiscount_offert_price', trans('forms.create_offer_discount_offer'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::number('discount_offer',NULL, array('id' => 'discount_offer', 'class' => 'form-control' ,'step'=>'0.01')); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-percent" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('discount_offer')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('discount_offer')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('image_url') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('image_url', trans('forms.create_offer_image_url'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('image_url',NULL, array('id' => 'image_url', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('image_url')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('image_url')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('department_id') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('department_id', trans('forms.create_offer_department_id'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo e(Form::select('department_id', $arr_department, old('department_id'), array('class'=>"form-control chosen-select",'id'=>'department_id'))); ?>

                                </div>
                                <?php if($errors->has('department_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('department_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('category') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('category', trans('forms.create_offer_category'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('category',NULL, array('id' => 'category', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('category')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('category')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group has-feedback row <?php echo e($errors->has('offer_url') ? ' has-error ' : ''); ?>">
                            <?php echo Form::label('offer_url', trans('forms.create_offer_url'), array('class' => 'col-md-3 control-label'));; ?>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <?php echo Form::text('offer_url',NULL, array('id' => 'offer_url', 'class' => 'form-control' )); ?>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link-square" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <?php if($errors->has('offer_url')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('offer_url')); ?></strong>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>