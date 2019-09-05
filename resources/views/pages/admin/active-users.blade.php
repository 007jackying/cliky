@extends('layouts.app')

@section('template_title')
    {{ trans('titles.activeUsers') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <users-count :registered={{ $users }} ></users-count>
        </div>
    </div>
</div>

@endsection
