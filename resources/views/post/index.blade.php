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
                        <div class=""><a class="btn btn-primary btn-sm" href="{{ route('app.post.create') }}">create new book</a></div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-2">
                        <form class="form-inline" action="">
                            <label for="category_filter">Filter By Category &nbsp;</label>
                            <select class="form-control js-example-basic-single" name="category_filter" id="category_filter">
                                <option value="">Select Category</option>
                                @foreach ($categories as $key=>$category)
                                <option {{ (Request::query('category') && Request::query('category')==$category->name)?'selected':''  }} value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>

                            <label for="keyword">&nbsp; &nbsp;</label>
                            <input type="text" class="form form-control" name="keyword" placeholder="Enter Keyword" id="keyword">
                            <span>&nbsp;</span>
                            <button onclick="search_post()" type="button" class="btn btn-primary">search</button>
                            @if (Request::query('category') || Request::query('keyword'))
                                <a class="btn btn-secondary" href="{{ route('app.post.index') }}">clear</a>
                            @endif
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Created By</th>
                                    <th>Category</th>
                                    <th>Total Comments
                                        <a href=""> <i class="fas fa-sort-down"></i> </a>
                                        <a href=""> <i class="fas fa-sort-up"></i> </a>
                                        <a href=""> <i class="fas fa-sort"></i> </a>
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $key=>$post)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->price }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->name }}</td></td>
                                    <td>{{ $post->comments_count }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('app.post.edit',$post->id) }}">edit</a>
                                        <a class="btn btn-sm btn-success" href="{{ route('app.post.show',$post->id) }}">view</a>
                                        <a class="btn btn-sm btn-danger" href="">delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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

<script>
  var query = <?php echo json_encode((object)Request::query()); ?>;

  function search_post(){
    Object.assign(query,{'category': $('#category_filter').val()});
    Object.assign(query,{'keyword': $('#keyword').val()});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }
    
</script>
@endpush