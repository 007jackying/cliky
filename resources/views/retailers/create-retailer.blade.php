@extends('layouts.app')

@section('template_title')
    @lang('retailermanagement.create-new-retailer')
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
                            @lang('retailermanagement.create-new-retailer')
                            <div class="pull-right">
                                <a href="{!! route('retailers') !!}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('retailermanagement.tooltips.back-retailers')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('retailermanagement.buttons.back-to-retailers')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'retailers.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation','files'=>true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.retailer-name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name',null,array('id'=>'name','class'=>'form-control')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-asterisk" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('url') ? ' has-error ' : '' }}">
                            {!! Form::label('url', trans('forms.retailer-url'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('url',NULL, array('id' => 'url', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="url">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('file') ? ' has-error ' : '' }}">
                            {!! Form::label('logo', trans('forms.retailer-brand'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input" id="logo" accept=".png">
                                    <label class="custom-file-label" for="customFile">Choose brand logo</label>
                                </div>
                                @if ($errors->has('offersFile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::button(trans('forms.create_retailer_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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