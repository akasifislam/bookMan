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
                        <div class="">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-success btn-sm" href="{{ route('app.post.index') }}">reload</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('app.post.create') }}">create new book</a></div>
                            </div>
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
                            <input type="text" class="form form-control input-sm" name="keyword" placeholder="Enter Keyword" id="keyword">
                            <span>&nbsp;</span>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button onclick="search_post()" type="button" class="btn btn-primary btn-sm">search</button>
                                @if (Request::query('category') || Request::query('keyword'))
                                    <a class="btn btn-warning btn-sm" href="{{ route('app.post.index') }}">clear</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name
                                        @if (Request::query('sortByName') && Request::query('sortByName')=='asc')
                                        <a href="javascript:sort('desc')"> <i class="fa-sort-down"></i></a>
                                        @elseif (Request::query('sortByName') && Request::query('sortByName')=='desc')
                                        <a href="javascript:sort('asc')"> <i class="fa-sort-up"></i></a>
                                        @else
                                        <a href="javascript:sort('asc')"> <i class="fas fa-sort"></i></a>
                                        @endif
                                    </th>
                                    <th>Book</th>
                                    <th>Price
                                        @if (Request::query('sortByPrice') && Request::query('sortByPrice')=='asc')
                                        <a href="javascript:sort('desc')"> <i class="fa-sort-down"></i></a>
                                        @elseif (Request::query('sortByPrice') && Request::query('sortByPrice')=='desc')
                                        <a href="javascript:sort('asc')"> <i class="fa-sort-up"></i></a>
                                        @else
                                        <a href="javascript:sort('asc')"> <i class="fas fa-sort"></i></a>
                                        @endif
                                    </th>
                                    <th>Quantality
                                        @if (Request::query('sortByQuantality') && Request::query('sortByQuantality')=='asc')
                                        <a href="javascript:sort('desc')"> <i class="fa-sort-down"></i></a>
                                        @elseif (Request::query('sortByQuantality') && Request::query('sortByQuantality')=='desc')
                                        <a href="javascript:sort('asc')"> <i class="fa-sort-up"></i></a>
                                        @else
                                        <a href="javascript:sort('asc')"> <i class="fas fa-sort"></i></a>
                                        @endif
                                    </th>
                                    <th>Author</th>
                                    <th>Category</th>
                                    <th>Total Comments
                                        @if (Request::query('sortByComments') && Request::query('sortByComments')=='asc')
                                        <a href="javascript:sort('desc')"> <i class="fa-sort-down"></i></a>
                                        @elseif (Request::query('sortByComments') && Request::query('sortByComments')=='desc')
                                        <a href="javascript:sort('asc')"> <i class="fa-sort-up"></i></a>
                                        @else
                                        <a href="javascript:sort('asc')"> <i class="fas fa-sort"></i></a>
                                        @endif
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($posts))
                                @foreach ($posts as $key=>$post)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <img style="width: 30px;height: 25px" src="{{ asset('post_images/'.$post->image) }}" alt="">
                                    </td>
                                    <td>{{ $post->price }}</td>
                                    <td>{{ $post->qty }}</td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->name }}</td></td>
                                    <td>{{ $post->comments_count }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-sm btn-primary" href="{{ route('app.post.edit',$post->id) }}"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-sm btn-success" href="{{ route('app.post.show',$post->id) }}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-sm btn-danger" href="javascript:post_delete('{{ route('app.post.destroy',$post->id) }}')"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td class="bg-danger text-center text-capitalize text-3xl" colspan="9">No Books</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        @if(count($posts))
                            {{$posts->appends(Request::query())->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<form method="POST" id="post_delete_id">
    @csrf
    @method('DELETE')

</form>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
  var query = <?php echo json_encode((object)Request::only(['category','keyword','sortByComments','sortByQuantality','sortByPrice','sortByName'])); ?>;

  function search_post(){
    Object.assign(query,{'category': $('#category_filter').val()});
    Object.assign(query,{'keyword': $('#keyword').val()});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }

  function sort(value) 
  {
    Object.assign(query,{'sortByComments': value});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }
  function sort(value) 
  {
    Object.assign(query,{'sortByQuantality': value});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }
  function sort(value) 
  {
    Object.assign(query,{'sortByPrice': value});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }
  function sort(value) 
  {
    Object.assign(query,{'sortByName': value});
    window.location.href="{{route('app.post.index')}}?"+$.param(query);
  }

  function post_delete(url) 
  {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            $('#post_delete_id').attr('action',url);
            $('#post_delete_id').submit();
        }
    })
  }
    
</script>
@endpush