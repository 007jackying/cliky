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
                                <?php echo app('translator')->getFromJson('offermanagement.showing-all-offers'); ?>
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        <?php echo app('translator')->getFromJson('offermanagement.offers-menu-alt'); ?>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?php echo URL::to('/offers/create'); ?>" class="dropdown-item">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.create-new'); ?>
                                </a>
                                <a href="<?php echo URL::to('/offers/import'); ?>" class="dropdown-item">
                                    <i class="fa fa-fw fa-upload" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.upload-offers'); ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo URL::to('offers.deleted'); ?>">
                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                    <?php echo app('translator')->getFromJson('offermanagement.show-deleted-offers'); ?>
                                </a>
                                </div>
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
                                    <th><?php echo app('translator')->getFromJson('offermanagement.offers-table.date'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('offermanagement.offers-table.retailer'); ?></th>
                                    <th class="hidden-xs"><?php echo app('translator')->getFromJson('offermanagement.offers-table.nosOffers'); ?></th>
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
                                            <td><?php echo $offer->date; ?></td>
                                            <td><?php echo $offer->retailer; ?></td>
                                            <td class="hidden-xs"><?php echo $offer->nosOffers; ?></td>
                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo $offer->created_at; ?></td>
                                            <td class="hidden-sm hidden-xs hidden-md"><?php echo $offer->updated_at; ?></td>
                                            <td>
                                                <?php $date = date("Y-m-d", strtotime($offer->date));?>
                                                <a class="btn btn-sm btn-success btn-block" href="<?php echo URL::to('offers/'.$offer->retailer_id.'/'.$date.'/details/'); ?>" data-toggle="tooltip" title="Show">
                                                    <?php echo app('translator')->getFromJson('offermanagement.buttons.show'); ?>
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