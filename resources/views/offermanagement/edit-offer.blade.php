@extends('layouts.app')

@section('template_title')
    @lang('offermanagement.editing-offer',['product'=>$offer->product])
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
                            @lang('offermanagement.editing-offer',['product'=>$offer->product])
                            <div class="pull-right">
                                <?php $date = date("Y-m-d", strtotime($offer->date));?>
                                <a href="{!! URL::to('offers/'.$offer->retailer_id.'/'.$date.'/details/') !!}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="@lang('offermanagement.tooltips.back-offers')">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @lang('offermanagement.buttons.back-to-offers-detail')
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => ['offers.update', $offer->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('availability_id') ? ' has-error ' : '' }}">
                            {!! Form::label('availability_id', trans('forms.create_offer_availability_id'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {{ Form::select('availability_id', $arr_available, $offer->availability_id, array('class'=>"form-control chosen-select",'id'=>'availability_id')) }}
                                </div>
                                @if ($errors->has('availability_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('availability_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('date') ? ' has-error ' : '' }}">
                            {!! Form::label('date', trans('forms.create_offer_date'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('date', $offer->date, array('id' => 'date', 'class' => 'form-control', 'value' => date('mm/dd/YY'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-calendar" aria-hidden="true"></i>
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
                        <div class="form-group has-feedback row {{ $errors->has('date_code') ? ' has-error ' : '' }}">
                            {!! Form::label('date_code', trans('forms.create_offer_date_code'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('date_code',$offer->date_code, array('id' => 'date', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-barcode" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('date_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('date_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('retailer_id') ? ' has-error ' : '' }}">
                            {!! Form::label('retailer_id', trans('forms.create_offer_retailer_id'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {{ Form::select('retailer_id', $arr_retailer, $offer->retailer_id, array('class'=>"form-control chosen-select",'id'=>'retailer_id')) }}
                                </div>
                                @if ($errors->has('retailer_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('retailer_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('product') ? ' has-error ' : '' }}">
                            {!! Form::label('product', trans('forms.create_offer_product'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('product',$offer->product, array('id' => 'product', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-product-hunt" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('product'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('current_price') ? ' has-error ' : '' }}">
                            {!! Form::label('current_price', trans('forms.create_offer_current_price'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::number('current_price',$offer->current_price, array('id' => 'current_price', 'class' => 'form-control' ,'step'=>'0.01')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-usd" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('current_price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('discount_offer') ? ' has-error ' : '' }}">
                            {!! Form::label('currendiscount_offert_price', trans('forms.create_offer_discount_offer'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('discount_offer',$offer->discount_offer, array('id' => 'discount_offer', 'class' => 'form-control')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-percent" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('discount_offer'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discount_offer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('image_url') ? ' has-error ' : '' }}">
                            {!! Form::label('image_url', trans('forms.create_offer_image_url'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('image_url',$offer->image_url, array('id' => 'image_url', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('image_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('department_id') ? ' has-error ' : '' }}">
                            {!! Form::label('department_id', trans('forms.create_offer_department_id'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {{ Form::select('department_id', $arr_department, $offer->department_id, array('class'=>"form-control chosen-select",'id'=>'department_id')) }}
                                </div>
                                @if ($errors->has('department_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('category') ? ' has-error ' : '' }}">
                            {!! Form::label('category', trans('forms.create_offer_category'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('category',$offer->category, array('id' => 'category', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('offer_url') ? ' has-error ' : '' }}">
                            {!! Form::label('offer_url', trans('forms.create_offer_url'), array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('offer_url',$offer->offer_url, array('id' => 'offer_url', 'class' => 'form-control' )) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-external-link-square" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('offer_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('offer_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
@endsection