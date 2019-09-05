@extends('layouts.app')

@section('template_title')
    @lang('departmentmanagement.showing-all-departments')
@endsection

@section('template_linked_css')
    @if(config('laravelusers.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.datatablesCssCDN') }}">
    @endif
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
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                @lang('departmentmanagement.showing-all-departments')
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        @lang('departmentmanagement.departments-menu-alt')
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{!! URL::to('/departments/create') !!}" class="dropdown-item">
                                        <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                        @lang('departmentmanagement.create-new-department')
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{!! URL::to('departments.deleted') !!}">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        @lang('departmentmanagement.show-deleted-department')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(config('settings.enableSearch'))
                            @include('partials.search-users-form')
                        @endif
                            <div class="table-responsive departments-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="department_count">
                                        {{ trans_choice('departmentmanagement.departments-table.caption',1,['departmentscount'=>$departments->count()]) }}
                                    </caption>
                                    <thead class="thead">
                                        <tr>
                                            <th>@lang('departmentmanagement.departments-table.id')</th>
                                            <th>@lang('departmentmanagement.departments-table.name')</th>
                                            <th>@lang('usersmanagement.users-table.actions')</th>
                                            <th class="no-search no-sort"></th>
                                            <th class="no-search no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="departments-table">
                                        @foreach($departments as $key => $department)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td>{!! $department->name !!}</td>
                                            <td>
                                                {!! Form::open(array('url' => 'departments/' . $department->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button(trans('departmentmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this Offer ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('departments/' . $department->id . '/edit') }}" data-toggle="tooltip" title="Edit" style="margin-top:5px">
                                                    @lang('departmentmanagement.buttons.edit')
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tbody id="search_results"></tbody>
                                            @if(config('settings.enableSearch'))
                                                <tbody id="search_results"></tbody>
                                            @endif
                                        </tbody>
                                </table>
                                @if(config('settings.enablePagination'))
                                    {{ $departments->links() }}
                                @endif
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection
@section('footer_scripts')
    @if ((count($departments) > config('settings.datatablesJsStartCount')) && config('settings.enabledDatatablesJS'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('settings.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
    @if(config('settings.enableSearch'))
        @include('scripts.search-users')
    @endif
@endsection