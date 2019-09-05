<?php $__env->startSection('template_title'); ?>
    Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
    <link rel="stylesheet" href="<?php echo asset('css/card.css'); ?>"/>
    <style>
        .card {
            padding: 10px !important;
            height: 300px;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <input type="hidden" id="retailer" value="<?php echo $retailer; ?>"/>
    <input type="hidden" id="department" value="<?php echo $department; ?>"/>
    <input type="hidden" id="type" value="<?php echo $type; ?>"/>
    <input type="hidden" id="price" value="<?php echo $price; ?>"/>
    <input type="hidden" id="discount" value="<?php echo $discount; ?>"/>
    <div class="container" style="margin-top: 10px;">
        <h5> <?php echo $total_results; ?> Total Results</h5>
        <div class="row" id="list-offers">
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="<?php echo asset('js/promise.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/fetch.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo asset('js/offers.js'); ?>"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

            if ("IntersectionObserver" in window) {
                let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            let lazyImage = entry.target;
                            lazyImage.src = lazyImage.dataset.src;
                            lazyImage.srcset = lazyImage.dataset.srcset;
                            lazyImage.classList.remove("lazy");
                            lazyImageObserver.unobserve(lazyImage);
                        }
                    });
                });

                lazyImages.forEach(function(lazyImage) {
                    lazyImageObserver.observe(lazyImage);
                });
            } else {
                // Possibly fall back to a more compatible method here
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mobile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>