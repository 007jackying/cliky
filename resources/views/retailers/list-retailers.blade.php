@extends('layouts.app')

@section('template_title')
    @lang('retailermanagement.showing-all-retailers')
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
                                @lang('retailermanagement.showing-all-retailers')
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        @lang('retailermanagement.retailers-menu-alt')
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="{!! URL::to('/retailers/create') !!}" class="dropdown-item">
                                        <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                        @lang('retailermanagement.create-new-retailer')
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{!! URL::to('retailers.deleted') !!}">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        @lang('retailermanagement.show-deleted-retailer')
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(config('settings.enableSearch'))
                            @include('partials.search-users-form')
                        @endif
                            <div class="table-responsive retailers-table">
                                <table class="table table-striped table-sm data-table">
                                    <caption id="retailer_count">
                                        {{ trans_choice('retailermanagement.retailers-table.caption',1,['retailerscount'=>$retailers->count()]) }}
                                    </caption>
                                    <thead class="thead">
                                        <tr>
                                            <th>@lang('retailermanagement.retailers-table.id')</th>
                                            <th>@lang('retailermanagement.retailers-table.name')</th>
                                            <th>@lang('retailermanagement.retailers-table.logo')</th>
                                            <th>@lang('usersmanagement.users-table.actions')</th>
                                            <th class="no-search no-sort"></th>
                                            <th class="no-search no-sort"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="retailers-table">
                                        @foreach($retailers as $key => $retailer)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td><a href="{!! $retailer->url !!}" target="_blank"> {!! $retailer->name !!}</a></td>
                                            <td><img src="{!! asset($retailer->logo) !!}" style="max-width: 80px; height: auto;"/></td>
                                            <td>
                                                {!! Form::open(array('url' => 'retailers/' . $retailer->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::button(trans('retailermanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this Offer ?')) !!}
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('retailers/' . $retailer->id . '/edit') }}" data-toggle="tooltip" title="Edit" style="margin-top:5px">
                                                    @lang('retailermanagement.buttons.edit')
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
                                    {{ $retailers->links() }}
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
    @if ((count($retailers) > config('settings.datatablesJsStartCount')) && config('settings.enabledDatatablesJS'))
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