@extends('layouts.dashboard')

@section('title')
{{ trans('posts.title.index') }}
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('posts') }}
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="GET" class="form-inline form-row">
                            <div class="col">
                                <div class="input-group mx-1">
                                    <label class="font-weight-bold mr-2">
                                        {{ trans('posts.form_control.select.status.label') }}
                                    </label>
                                    <select name="status" class="custom-select">
                                        <option value="publish" selected>Publish</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            {{ trans('posts.button.apply.value') }}

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mx-1">
                                    <input name="keyword" type="search" class="form-control" placeholder="{{ trans('posts.form_control.input.search.placeholder') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('posts.create')}}" class="btn btn-primary float-right" role="button">
                            {{ trans('posts.button.create.value') }}

                            <i class="fas fa-plus-square"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <!-- list post -->
                    @forelse($posts as $post)

                    <div class="card my-2">
                        <div class="card-body">
                            <h5>
                                {{ $post->title }}

                            </h5>
                            <p>
                                {{ $post->description }}
                            </p>
                            <div class="float-right">
                                <!-- detail -->
                                <a href="{{route('posts.show',['post'=>$post])}}" class="btn btn-sm btn-primary" role="button">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <!-- edit -->
                                <a href="{{route('posts.edit',['post'=>$post])}}" class="btn btn-sm btn-info" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- delete -->
                                <form class="d-inline" role='alert' alert-text="{{trans('posts.alert.delete.message.confirm',['title'=> $post->title])}}" action="{{ route('posts.destroy',['post'=>$post])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty

                </ul>
            </div>
        </div>

        <p>
            <strong>
                {{ trans('posts.label.no_data.fetch') }}
            </strong>
        </p>

        @endforelse

        </ul>
    </div>
</div>
</div>
</div>
@endsection


<!-- ForElse l?? m???t v??ng l???p ForEach, nh??ng c?? th??m x??? l?? cho m???ng tr???ng. -->


@push('javascript-internal')

<!-- scrip cho button xoa -->
<script>
    $(document).ready(function() {
        $("form[role='alert']").submit(function(event) {
            event.preventDefault(); // c??? th??? l?? sau khi nh???n ok th?? m???c ?????nh s??? g???i ta sang m???t trang kh??c h??m n??y ????? t???t t??nh n??ng m???c ?????nh
            Swal.fire({
                title: "{{trans('posts.alert.delete.title')}}",
                text: $(this).attr('alert-text'),
                icon: 'warning',
                allowOutsideClick: false,
                showCancelButton: true,
                cancelButtonText: "{{trans('posts.button.cancel.value')}}",
                reverseButtons: true,
                confirmButtonText: "{{trans('posts.button.delete.value')}}",
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