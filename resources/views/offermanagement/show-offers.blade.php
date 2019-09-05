@extends('layouts.app')

@section('template_title')
    @lang('offermagement.showing-all-offers')
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
                                @lang('offermanagement.showing-all-offers')
                            </span>
                            <div class="btn-group pull-right btn-group-xs">
                                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        @lang('offermanagement.offers-menu-alt')
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a href="{!! URL::to('/offers/create') !!}" class="dropdown-item">
                                    <i class="fa fa-fw fa-plus" aria-hidden="true"></i>
                                    @lang('offermanagement.buttons.create-new')
                                </a>
                                <a href="{!! URL::to('/offers/import') !!}" class="dropdown-item">
                                    <i class="fa fa-fw fa-upload" aria-hidden="true"></i>
                                    @lang('offermanagement.buttons.upload-offers')
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{!! URL::to('offers.deleted') !!}">
                                    <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                    @lang('offermanagement.show-deleted-offers')
                                </a>
                                </div>
                            </div>
                    </div>
                </div>

                    <div class="card-body">
                        @if(config('setting.enableSearch'))
                            @include('partials.search-form')
                        @endif
                        <div class="table-responsive offers-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{ trans_choice('offermanagement.offers-table.caption',1,['offerscount'=>$offers->count()]) }}
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>@lang('offermanagement.offers-table.id')</th>
                                    <th>@lang('offermanagement.offers-table.date')</th>
                                    <th>@lang('offermanagement.offers-table.retailer')</th>
                                    <th class="hidden-xs">@lang('offermanagement.offers-table.nosOffers')</th>
                                    <th class="hidden-sm hidden-xs hidden-md">@lang('offermanagement.offers-table.created')</th>
                                    <th class="hidden-sm hidden-xs hidden-md">@lang('offermanagement.offers-table.updated')</th>
                                    <th>@lang('usersmanagement.users-table.actions')</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="offers-table">
                                    @foreach($offers as $key => $offer)
                                        <tr>
                                            <td>{!! $key+1 !!}</td>
                                            <td>{!! $offer->date !!}</td>
                                            <td>{!! $offer->retailer !!}</td>
                                            <td class="hidden-xs">{!! $offer->nosOffers !!}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{!! $offer->created_at !!}</td>
                                            <td class="hidden-sm hidden-xs hidden-md">{!! $offer->updated_at !!}</td>
                                            <td>
                                                <?php $date = date("Y-m-d", strtotime($offer->date));?>
                                                <a class="btn btn-sm btn-success btn-block" href="{!! URL::to('offers/'.$offer->retailer_id.'/'.$date.'/details/') !!}" data-toggle="tooltip" title="Show">
                                                    @lang('offermanagement.buttons.show')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody id="search_results"></tbody>
                                @if(config('settings.enableSearch'))
                                    <tbody id="search_results"></tbody>
                                @endif
                            </table>
                            @if(config('settings.enablePagination'))
                                {{ $offers->links() }}
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @include('modals.modal-delete')
@endsection

@section('footer_scripts')
    @if ((count($offers) > config('settings.datatablesJsStartCount')) && config('settings.enabledDatatablesJS'))
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
