@extends('layouts.dashboard')

@section('title')
    Oni-chan anh có yêu em hong?
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard_home') }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Anh la Nhat {{Auth::user()->name}}</h2>
    </div>
</div>
@endsection
