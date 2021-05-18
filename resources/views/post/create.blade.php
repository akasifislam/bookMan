@extends('layouts.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="">Post</div>
                        <div class=""><a class="btn btn-primary btn-sm" href="{{ route('app.post.index') }}">List</a></div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" name="description" id="description" placeholder="description">
                        </div>
                        <div class="form-group">
                            <label for="image">Description</label>
                            <input type="file" class="form-control" name="image" id="image" placeholder="choose an image">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control js-example-basic-single" name="category" id="category">
                                <option value=""> --- select --- </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="form-control js-example-basic-single" name="tags[]" id="tags" multiple>
                                <option value=""> --- select --- </option>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush