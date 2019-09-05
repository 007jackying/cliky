<?php $__env->startSection('title'); ?>
    <?php echo e(trans('laravel2step::laravel-verification.title')); ?>

<?php $__env->stopSection(); ?>

<?php
switch ($remainingAttempts) {
    case 0:
    case 1:
        $remainingAttemptsClass = 'danger';
        break;

    case 2:
        $remainingAttemptsClass = 'warning';
        break;

    case 3:
        $remainingAttemptsClass = 'info';
        break;

    default:
        $remainingAttemptsClass = 'success';
        break;
}
?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel verification-form-panel">
                <div class="panel-heading text-center" id="verification_status_title">
                    <h3>
                        <?php echo e(trans('laravel2step::laravel-verification.title')); ?>

                    </h3>
                    <p class="text-center">
                        <em>
                            <?php echo e(trans('laravel2step::laravel-verification.subtitle')); ?>

                        </em>
                    </p>
                </div>
                <div class="panel-body">

                    <form id="verification_form" class="form-horizontal" method="POST" >

                        <div class="form-group margin-bottom-1 code-inputs">
                            <div class="col-xs-3">
                                <div class="<?php echo e($errors->has('v_input_1') ? ' has-error' : ''); ?>">
                                    <label for="v_input_1" class="sr-only control-label">
                                        <?php echo e(trans('laravel2step::laravel-verification.inputAlt1')); ?>

                                    </label>
                                    <input type="text"  id="v_input_1" class="form-control text-center required" required name="v_input_1" value="" autofocus maxlength="1" minlength="1" tabindex="1" placeholder="•">
                                    <?php if($errors->has('v_input_1')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('v_input_1')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="<?php echo e($errors->has('v_input_2') ? ' has-error' : ''); ?>">
                                    <label for="v_input_2" class="sr-only control-label">
                                        <?php echo e(trans('laravel2step::laravel-verification.inputAlt2')); ?>

                                    </label>
                                    <input type="text"  id="v_input_2" class="form-control text-center required" required name="v_input_2" value="" maxlength="1" minlength="1" tabindex="2" placeholder="•">
                                    <?php if($errors->has('v_input_2')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('v_input_2')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="<?php echo e($errors->has('v_input_3') ? ' has-error' : ''); ?>">
                                    <label for="v_input_3" class="sr-only control-label">
                                        <?php echo e(trans('laravel2step::laravel-verification.inputAlt3')); ?>

                                    </label>
                                    <input type="text"  id="v_input_3" class="form-control text-center required" required name="v_input_3" value="" maxlength="1" minlength="1" tabindex="3" placeholder="•">
                                    <?php if($errors->has('v_input_3')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('v_input_3')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="<?php echo e($errors->has('v_input_4') ? ' has-error' : ''); ?>">
                                    <label for="v_input_4" class="sr-only control-label">
                                        <?php echo e(trans('laravel2step::laravel-verification.inputAlt4')); ?>

                                    </label>
                                    <input type="text"  id="v_input_4" class="form-control text-center required last-input " required name="v_input_4" value="" maxlength="1" minlength="1" tabindex="4" placeholder="•">
                                    <?php if($errors->has('v_input_4')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('v_input_4')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-8 col-xs-offset-2 text-center submit-container">
                                    <button type="submit" class="btn btn-lg btn-<?php echo e($remainingAttemptsClass); ?> btn-block" id="submit_verification" tabindex="5">
                                        <i class="glyphicon glyphicon-check" aria-hidden="true"></i>
                                        <?php echo e(trans('laravel2step::laravel-verification.verifyButton')); ?>

                                    </button>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <p class="text-<?php echo e($remainingAttemptsClass); ?>">
                                        <small>
                                            <span id="remaining_attempts"><?php echo e($remainingAttempts); ?></span> <?php echo e(trans_choice('laravel2step::laravel-verification.attemptsRemaining', $remainingAttempts)); ?>

                                        </small>
                                    </p>
                                </div>
                                <div class="col-xs-12 text-center">
                                    <a class="btn btn-link" id="resend_code_trigger" href="#" tabindex="6">
                                        <?php echo e(trans('laravel2step::laravel-verification.missingCode')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="failed_login_alert">
                        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('foot'); ?>

    <?php
        $minutesToExpire = config('laravel2step.laravel2stepExceededCountdownMinutes');
        $hoursToExpire = $minutesToExpire / 60;
    ?>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <?php echo $__env->make('laravel2step::scripts.input-parsing-auto-stepper', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

    <script>

        $('.code-inputs').on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e){
            $('.code-inputs').delay(200).removeClass('invalid-shake');
        });

        $("#submit_verification").click(function(event) {
            event.preventDefault();

            var formData = $('#verification_form').serialize();

            $.ajax({
                url: '/verification/verify',
                type: "post",
                dataType: 'json',
                data: formData,
                success: function(response, status, data){
                    window.location.href = data.responseJSON.nextUri;
                },
                error: function (response, status, error) {
                    if (response.status === 418) {

                        var remainingAttempts = response.responseJSON.remainingAttempts;
                        var submitTrigger = $('#submit_verification');
                        var varificationForm = $('#verification_form');

                        $('.code-inputs').addClass('invalid-shake');
                        varificationForm[0].reset();
                        $('#remaining_attempts').text(remainingAttempts);

                        switch(remainingAttempts) {
                            case 0:
                                submitTrigger.addClass('btn-danger');
                                swal(
                                  "<?php echo e(trans('laravel2step::laravel-verification.verificationLockedTitle')); ?>",
                                  "<?php echo e(trans('laravel2step::laravel-verification.verificationLockedMessage')); ?>",
                                  'error'
                                );
                                break;

                            case 1:
                                submitTrigger.addClass('btn-danger');
                                swal(
                                  "<?php echo e(trans('laravel2step::laravel-verification.verificationWarningTitle')); ?>",
                                  "<?php echo e(trans('laravel2step::laravel-verification.verificationWarningMessage', ['hours' => $hoursToExpire, 'minutes' => $minutesToExpire,])); ?>",
                                  'error'
                                );
                                break;

                            case 2:
                                submitTrigger.addClass('btn-warning');
                                break;

                            case 3:
                                submitTrigger.addClass('btn-info');
                                break;

                            default:
                                submitTrigger.addClass('btn-success');
                                break;
                        }

                        if (remainingAttempts === 0) {
                            $('#verification_status_title').html('<h3><?php echo e(trans('laravel2step::laravel-verification.titleFailed')); ?></h3>');
                            varificationForm.fadeOut(100, function() {

                                $('#failed_login_alert').show();

                                setTimeout(function(){
                                    $('body').fadeOut(100, function() {
                                        location.reload();
                                    });
                                }, 2000);
                            });
                        };

                    };
                }
            });

        });

        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });

    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.4.0/sweetalert2.all.js"></script>
    <script type="text/javascript">

        $("#resend_code_trigger").click(function(event) {
            event.preventDefault();

            var self = $(this);
            var resultStatus;
            var resultData;
            var endpoint = "/verification/resend";

            self.addClass('disabled')
            .attr("disabled", true);

            swal({
              text: 'Sending verification code ...',
              allowOutsideClick: false,
              grow: false,
              animation: false,
              onOpen: () => {
                swal.showLoading();
                $.ajax(
                    {
                        type: "post",
                        url: endpoint,
                        success: function(response, status, data){
                            swalCallback(response.title, response.message, status);
                        },
                        error: function (response, status, error) {
                            swalCallback(error, error, status);
                        }
                    }
                )
              }
            });
            function swalCallback(title, message, status) {
                swal({
                    text: title,
                    text: message,
                    type: status,
                    grow: false,
                    animation: false,
                    allowOutsideClick: false,
                    buttonsStyling: false,
                    confirmButtonClass: 'btn btn-lg btn-' + status,
                    confirmButtonText: "<?php echo e(trans('laravel2step::laravel-verification.verificationModalConfBtn')); ?>",
                });
                self.removeClass('disabled').attr("disabled", false);
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('laravel2step::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>