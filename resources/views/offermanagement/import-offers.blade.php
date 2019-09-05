@extends('layouts.app')

@section('template_title')
    @lang('offermanagement.create-new-offer')
@endsection

@section('template_fastload_css')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            @lang('offermanagement.create-new-offer')
                            <div class="pull-right">
                                <a href="{!! route('offers') !!}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('offermanagement.tooltips.back-offers')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('offermanagement.buttons.back-to-offers')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        {!! Form::open(array('route' => 'offers.import_process', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation','files'=>true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('file') ? ' has-error ' : '' }}">
                            {!! Form::label('file', trans('forms.upload_offer_file'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" name="offersFile" class="custom-file-input" id="offersFile" accept=".csv,.xlsx">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @if ($errors->has('offersFile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('offersFile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        {!! Form::button(trans('forms.create_offer_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
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
@endsection