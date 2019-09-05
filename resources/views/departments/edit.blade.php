@extends('layouts.app')

@section('template_title')
    @lang('departmentmanagement.editing-department',['department'=>$department->name])
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
                            @lang('departmentmanagement.editing-department',['department'=>$department->name])
                            <div class="pull-right">
                                <a href="{!! route('departments') !!}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('departmentmanagement.tooltips.back-departments')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('departmentmanagement.buttons.back-to-departments')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['departments.update', $department->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                            {!! Form::label('name', trans('forms.department-name'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('name',$department->name,array('id'=>'name','class'=>'form-control')) !!}
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
                        {!! Form::button(trans('forms.update_department_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection