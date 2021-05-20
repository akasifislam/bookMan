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
                        <div class="">Edit</div>
                        <div class=""><a class="btn btn-primary btn-sm" href="{{ route('app.post.index') }}">List</a></div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('app.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" value="{{ (old('title')) ? old('title'): $post->title }}" name="title" id="title" placeholder="Title">
                            @if ($errors->any('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description" placeholder="description" rows="4">{{ (old('description')) ? old('description'): $post->description }}</textarea>
                            @if ($errors->any('description'))
                                <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" value="{{ (old('price')) ? old('price'): $post->price }}" name="price" id="price" placeholder="price">
                            @if ($errors->any('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="qty">Quentitity</label>
                            <input type="text" class="form-control" value="{{ (old('qty')) ? old('qty'): $post->qty }}" name="qty" id="qty" placeholder="qty">
                            @if ($errors->any('qty'))
                                <span class="text-danger">{{ $errors->first('qty') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#demo">Image View</button>
                            <div id="demo" class="collapse">
                                <img src="{{ asset('post_images/'.$post->image) }}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" value="{{ old('image') }}" name="image" id="image" placeholder="choose an image">
                            @if ($errors->any('image'))
                                <span class="text-danger">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control js-example-basic-single" name="category" id="category">
                                <option value=""> --- select --- </option>
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" 

                                        @if(old('category') && old('category') ==$category->id)
                                        {{'selected'}}
                                        @elseif($post->category_id==$category->id)
                                        {{'selected'}}
                                        @endif

                                        >{{$category->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            @if ($errors->any('category'))
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <select class="form-control js-example-basic-single" name="tags[]" id="tags" multiple>
                                <option value=""> --- select --- </option>
                                @if(count($tags))
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}" 
                                            @if(old('tags') && in_array($tag->id,old('tags')))
                                            {{'selected'}}

                                            @elseif(in_array($tag->id,$post->getTagsIdArray()) )
                                            {{'selected'}}
                                            @endif
                                        >{{$tag->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->any('tags'))
                                <span class="text-danger">{{ $errors->first('tags') }}</span>
                            @endif
                        </div>
                            <button type="submit" class="btn btn-success btn-sm">submit</button>
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







{{-- {{(old('category') && old('category')==$category->id )?'selected':''}} --}}