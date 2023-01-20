@extends('layouts.dashboard')

@section('title')
{{ trans('categories.title.index') }}
@endsection

@section('breadcrumbs')
Breadcrumns
{{ Breadcrumbs::render('categories') }}

@endsection

@section('content')
<!-- section:content -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">

                        <form action="{{route('categories.index')}}" method="GET">
                            <div class="input-group">
                                <input name="keyword" type="search" class="form-control" placeholder="{{ trans('categories.form_control.input.search.placeholder')}}" value="{{ request()->get('keyword') }}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('categories.create')}}" class="btn btn-primary float-right" role="button">
                            {{ trans('categories.button.create.value')}}
                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <!-- list category -->


                    @if(count($categories))
                    @include('categories._category-list',[
                    'categories' => $categories,
                    'count' => 0
                    ])
                    @else
                    @if(request()->get('keyword'))
                    <!-- // {{request()->get('keyword')}}  nó éo tồn tại -->
                    <p>
                        <strong>
                            {{ trans('categories.label.no_data.search',['keyword'=>request()->get('keyword')]) }}

                        </strong>
                    </p>
                    @else
                    <p>
                        <strong>
                            {{ trans('categories.label.no_data.fetch') }}
                        </strong>
                    </p>
                    @endif
                    @endif
                </ul>
            </div>
            <!-- dấu trang page -->
            @if($categories->hasPages())
            <div class="card-footer">
                {{ $categories->links('vendor.pagination.bootstrap-4') }}
                <!-- C:\xampp\htdocs\myblog\resources\views\vendor\pagination\bootstrap-4.blade.php -->
            </div>
            @endif

        </div>
    </div>
</div>

@endsection

@push('javascript-internal')

<!-- scrip cho button xoa -->
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault(); // cụ thể là sau khi nhấn ok thì mặc định sẽ gữi ta sang một trang khác hàm này để tắt tính năng mặc định
            Swal.fire({
                title: $(this).attr('alert-title'),
                text: $(this).attr('alert-text'),
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: $(this).attr('alert-btn-no'),
                reverseButtons: true,
                confirmButtonText: $(this).attr('alert-btn-yes'),
            }).then((result) => {
                if (result.isConfirmed) {
                    // todo: process of deleting categories
                    if (result.isConfirmed)
                        event.target.submit();
                }
            });


        })
    });
</script>
@endpush