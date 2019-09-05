<?php $__env->startSection('template_title'); ?>
    <?php echo app('translator')->getFromJson('offermagement.showing-all-offers'); ?>
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
                                <?php echo app('translator')->getFromJson('offermanagement.showing-all-offers'); ?> @ <b><?php echo $retailer->name; ?> on <?php echo $date; ?></b>
                            </span>
                            <div class="pull-right">
                                <a href="<?php echo route('offers'); ?>" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="<?php echo app('translator')->getFromJson('offermanagement.tooltips.back-offers'); ?>">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.back-to-offers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if(config('setting.enableSearch')): ?>
                            <?php echo $__env->make('partials.search-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                        <div class="table-responsive offers-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    <?php echo e(trans_choice('offermanagement.offers-table.caption',1,['offerscount'=>$offers->count()])); ?>

                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th><?php echo app('translator')->getFromJson('offermanagement.offers-table.id'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('offermanagement.offers-table.product'); ?></th>
                                    <th class="hidden-xs"><?php echo app('translator')->getFromJson('offermanagement.offers-table.currentPrice'); ?></th>
                                    <th class="hidden-xs"><?php echo app('translator')->getFromJson('offermanagement.offers-table.discountOffer'); ?></th>
                                    <th class="hidden-xs hidden-sm"><?php echo app('translator')->getFromJson('offermanagement.offers-table.available'); ?></th>
                                    <th class="hidden-xs hidden-sm"><?php echo app('translator')->getFromJson('offermanagement.offers-table.department'); ?></th>
                                    <th class="hidden-sm hidden-xs hidden-md"><?php echo app('translator')->getFromJson('offermanagement.offers-table.imageUrl'); ?></th>
                                    <th class="hidden-sm hidden-xs hidden-md"><?php echo app('translator')->getFromJson('offermanagement.offers-table.offerUrl'); ?></th>
                                    <th class="hidden-sm hidden-xs hidden-md"><?php echo app('translator')->getFromJson('offermanagement.offers-table.created'); ?></th>
                                    <th class="hidden-sm hidden-xs hidden-md"><?php echo app('translator')->getFromJson('offermanagement.offers-table.updated'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('usersmanagement.users-table.actions'); ?></th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="offers-table">
                                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo $key+1; ?></td>
                                        <td><?php echo $offer->product; ?></td>
                                        <td class="hidden-xs"><?php echo $offer->current_price; ?></td>
                                        <td class="hidden-xs"><?php echo $offer->discount_offer; ?></td>
                                        <th class="hidden-xs hidden-sm"><?php echo $offer->available; ?></th>
                                        <th class="hidden-xs hidden-sm"><?php echo $offer->department; ?></th>
                                        <th class="hidden-sm hidden-xs hidden-md"><a href="<?php echo $offer->image_url; ?>" target="_blank">Image</a> </th>
                                        <th class="hidden-sm hidden-xs hidden-md"><a href="<?php echo $offer->offer_url; ?>" target="_blank">Link</a> </th>
                                        <td class="hidden-sm hidden-xs hidden-md"><?php echo $offer->created_at; ?></td>
                                        <td class="hidden-sm hidden-xs hidden-md"><?php echo $offer->updated_at; ?></td>
                                        <td>
                                            <?php echo Form::open(array('url' => 'offers/' . $offer->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')); ?>

                                            <?php echo Form::hidden('_method', 'DELETE'); ?>

                                            <?php echo Form::button(trans('offermanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this Offer ?')); ?>

                                            <?php echo Form::close(); ?>

                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('offers/' . $offer->id . '/edit')); ?>" data-toggle="tooltip" title="Edit">
                                                <?php echo app('translator')->getFromJson('offermanagement.buttons.edit'); ?>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tbody id="search_results"></tbody>
                                <?php if(config('settings.enableSearch')): ?>
                                    <tbody id="search_results"></tbody>
                                <?php endif; ?>
                            </table>
                            <?php if(config('settings.enablePagination')): ?>
                                <?php echo e($offers->links()); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $__env->make('modals.modal-delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <?php if((count($offers) > config('settings.datatablesJsStartCount')) && config('settings.enabledDatatablesJS')): ?>
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