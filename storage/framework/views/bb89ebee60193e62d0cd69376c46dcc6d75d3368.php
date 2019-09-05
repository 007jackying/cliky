<?php $__env->startSection('template_title'); ?>
  <?php echo e(trans('titles.adminThemesAdd')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xl-10 offset-xl-1">
                <div class="card">

                    <div class="card-header">
                        <div class="float-left">
                            <?php echo e(trans('titles.adminThemesAdd')); ?>

                        </div>
                        <div class="float-right">
                            <a href="<?php echo e(url('/themes/')); ?>" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('themes.backToThemesTt'); ?>">
                                <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                                <?php echo app('translator')->getFromJson('themes.backToThemesBtn'); ?>
                            </a>
                        </div>
                    </div>


                    <?php echo Form::open(array('action' => 'ThemesManagementController@store', 'method' => 'POST', 'role' => 'form')); ?>


                        <?php echo csrf_field(); ?>


                        <div class="card-body">

                            <div class="form-group has-feedback row <?php echo e($errors->has('status') ? ' has-error ' : ''); ?>">
                                <?php echo Form::label('status', trans('themes.statusLabel') , array('class' => 'col-md-3 control-label'));; ?>

                                <div class="col-md-9">
                                    <label class="switch checked" for="status">
                                        <span class="active"><i class="fa fa-toggle-on fa-2x"></i> <?php echo e(trans('themes.statusEnabled')); ?></span>
                                        <span class="inactive"><i class="fa fa-toggle-on fa-2x fa-rotate-180"></i> <?php echo e(trans('themes.statusDisabled')); ?></span>
                                        <input type="radio" name="status" value="1" checked>
                                        <input type="radio" name="status" value="0">
                                    </label>

                                    <?php if($errors->has('status')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('status')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group has-feedback row <?php echo e($errors->has('name') ? ' has-error ' : ''); ?>">
                                <?php echo Form::label('name', trans('themes.nameLabel'), array('class' => 'col-md-3 control-label'));; ?>

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <?php echo Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('themes.namePlaceholder'))); ?>

                                        <div class="input-group-append">
                                            <label for="name" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
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

                            <div class="form-group has-feedback row <?php echo e($errors->has('link') ? ' has-error ' : ''); ?>">
                                <?php echo Form::label('link', trans('themes.linkLabel'), array('class' => 'col-md-3 control-label'));; ?>

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <?php echo Form::text('link', null, array('id' => 'link', 'class' => 'form-control', 'placeholder' => trans('themes.linkPlaceholder'))); ?>

                                        <div class="input-group-append">
                                            <label for="link" class="input-group-text">
                                                <i class="fa fa-fw fa-link fa-rotate-90" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <?php if($errors->has('link')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('link')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group has-feedback row <?php echo e($errors->has('notes') ? ' has-error ' : ''); ?>">
                                <?php echo Form::label('notes', trans('themes.notesLabel') , array('class' => 'col-md-3 control-label'));; ?>

                                <div class="col-md-9">
                                    <div class="input-group">
                                        <?php echo Form::textarea('notes', old('notes'), array('id' => 'notes', 'class' => 'form-control', 'placeholder' => trans('themes.notesPlaceholder'))); ?>

                                        <div class="input-group-append">
                                            <label for="notes" class="input-group-text">
                                                <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <?php if($errors->has('notes')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('notes')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 offset-sm-6">
                                    <?php echo Form::button('<i class="fa fa-plus" aria-hidden="true"></i>&nbsp;' . trans('themes.btnAddTheme'), array('class' => 'btn btn-success btn-block mb-0','type' => 'submit', )); ?>

                                </div>
                            </div>
                        </div>

                    <?php echo Form::close(); ?>


                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>

  <?php echo $__env->make('scripts.toggleStatus', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>