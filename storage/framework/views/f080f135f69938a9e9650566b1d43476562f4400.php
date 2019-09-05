<?php $__env->startSection('template_title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" href="<?php echo asset('css/card.css'); ?>"/>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h5>Updated at: <?php echo $last_update->created_at; ?></h5>
    </div>
        <img src="<?php echo asset('images/banner/banner.png'); ?>"
             srcset="<?php echo asset('images/banner/banner.png'); ?> 1200w, <?php echo asset('images/banner/banner-sm.png'); ?> 480w"
             alt="Never miss a Deal"
             class="main-image" style="width: auto; max-width: 100%; min-width: 100%;">
    <div class="container">
        <h6 style=" font-size: 16px;">Top Retailers: </h6>
        <div class="row">
            <!-- Card Projects -->
            <div class="table-responsive">
                <table class="table table-responsive">
                    <tbody>
                        <!--<tr>
                            <?php $__currentLoopData = $retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $retailer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key%2 == 0): ?>
                                <td style="width: 200px; height: 150px; margin: 2.5px; padding: 10px !important;">
                                        <img class="img-responsive" src="<?php echo asset($retailer->logo); ?>" style="width: auto; height: 120px; max-width: 100%;" alt="<?php echo $retailer->name; ?>">
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-info pull-left" href="<?php echo $retailer->url; ?>" target="_blank">Visit Site</a><a class="btn btn-info pull-right" href="<?php echo URL::to('mobile/offers/'.$retailer->name); ?>" >View Offers</a>
                                    </div>
                                </td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <tr>
                            <?php $__currentLoopData = $retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $retailer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($key%2 != 0): ?>
                                    <td style="width: 200px; height: 150px; margin: 2.5px; padding: 10px !important;">
                                        <img class="img-responsive" src="<?php echo asset($retailer->logo); ?>" style="width: auto; height: 120px; max-width: 100%;" alt="<?php echo $retailer->name; ?>">

                                        <p><a class="btn btn-info pull-left" href="<?php echo $retailer->url; ?>" target="_blank">Visit Site</a><a class="btn btn-info pull-right" href="<?php echo URL::to('mobile/offers/'.$retailer->name); ?>" >View Offers</a> </p>

                                    </td>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>-->
                    <tr>
                        <?php $__currentLoopData = $retailers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $retailer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td style="width: 200px; min-width: 200px; height: 180px; margin: 2.5px; padding: 10px !important; vertical-align: middle; text-align: center;">
                                <div style="height: 100px;">
                                <img class="img-responsive img-center" src="<?php echo asset($retailer->logo); ?>" style="width: auto; max-height: 150px; max-width: 100%;" alt="<?php echo $retailer->name; ?>">
                                </div>
                                <p>
                                    <a class="btn btn-dark btn-sm btn-block pull-right" href="<?php echo URL::to('mobile/offers/'.$retailer->id."/null/null/null/null"); ?>" >View Offers</a>
                                </p>

                            </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
            <h6 style="font-size: 16px;">Best Offers: </h6>
            <div class="row">
                <div class="table-responsive table-wrapper-scroll-x">
                    <table class="table table-borderless table-responsive">
                        <tbody>
                            <tr>
                                <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td style="min-width: 200px; width: 250px; height: 200px; margin: 2.5px; padding: 10px !important;">
                                        <div class="item">
                                            <a href="#">
                                                <span class="notify-badge" style="text-align: center;"><?php echo $offer->discount_offer .'<br/> Off'; ?></span>
                                                <img class="img-responsive" src="<?php echo asset($offer->image_url); ?>" style="width: auto; max-width: 150px; max-height: 150px;" alt="<?php echo $offer->product; ?>">
                                            </a>
                                        </div>

                                        <div class="card-content">
                                            <?php
                                                if (strlen($offer->product) > 50)
                                                {
                                                    $product = wordwrap($offer->product, 50);
                                                    $product = substr($product, 0, strpos($product, "\n")).'...';
                                                } else {
                                                    $product = $offer->product;
                                                }
                                            ?>
                                            <p><b><a href="<?php echo $offer->offer_url; ?>" target="_blank"><?php echo $product; ?></a> </b></p>
                                        </div>
                                        <div class="card-action">
                                            <p>Current Price: $ <?php echo $offer->current_price; ?></p>
                                            <p>Retailer: <?php echo $offer->retailer; ?></p>
                                        </div>
                                    </td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tbody>
                    </table>

            </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>