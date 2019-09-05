@extends('layouts.app')

@section('template_title')
    @lang('retailermanagement.editing-retailer',['retailer'=>$retailer->name])
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
                            @lang('retailermanagement.editing-retailer',['retailer'=>$retailer->name])
                            <div class="pull-right">
                                <a href="{!! route('retailers') !!}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('retailermanagement.tooltips.back-retailers')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('retailermanagement.buttons.back-to-retailers')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['retailers.update', $retailer->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.retailer-name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name',$retailer->name,array('id'=>'name','class'=>'form-control')) !!}
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
                                    {!! Form::text('url',$retailer->url, array('id' => 'url', 'class' => 'form-control' )) !!}
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
                        {!! Form::button(trans('forms.update_retailer_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection