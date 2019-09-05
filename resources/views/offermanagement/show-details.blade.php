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
                                @lang('offermanagement.showing-all-offers') @ <b>{!! $retailer->name !!} on {!! $date !!}</b>
                            </span>
                            <div class="pull-right">
                                <a href="{!! route('offers') !!}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('offermanagement.tooltips.back-offers')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('offermanagement.buttons.back-to-offers')
                                </a>
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
                                    <th>@lang('offermanagement.offers-table.product')</th>
                                    <th class="hidden-xs">@lang('offermanagement.offers-table.currentPrice')</th>
                                    <th class="hidden-xs">@lang('offermanagement.offers-table.discountOffer')</th>
                                    <th class="hidden-xs hidden-sm">@lang('offermanagement.offers-table.available')</th>
                                    <th class="hidden-xs hidden-sm">@lang('offermanagement.offers-table.department')</th>
                                    <th class="hidden-sm hidden-xs hidden-md">@lang('offermanagement.offers-table.imageUrl')</th>
                                    <th class="hidden-sm hidden-xs hidden-md">@lang('offermanagement.offers-table.offerUrl')</th>
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
                                        <td>{!! $offer->product !!}</td>
                                        <td class="hidden-xs">{!! $offer->current_price !!}</td>
                                        <td class="hidden-xs">{!! $offer->discount_offer !!}</td>
                                        <th class="hidden-xs hidden-sm">{!! $offer->available !!}</th>
                                        <th class="hidden-xs hidden-sm">{!! $offer->department !!}</th>
                                        <th class="hidden-sm hidden-xs hidden-md"><a href="{!! $offer->image_url !!}" target="_blank">Image</a> </th>
                                        <th class="hidden-sm hidden-xs hidden-md"><a href="{!! $offer->offer_url !!}" target="_blank">Link</a> </th>
                                        <td class="hidden-sm hidden-xs hidden-md">{!! $offer->created_at !!}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{!! $offer->updated_at !!}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'offers/' . $offer->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button(trans('offermanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Offer', 'data-message' => 'Are you sure you want to delete this Offer ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="{{ URL::to('offers/' . $offer->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                                @lang('offermanagement.buttons.edit')
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
