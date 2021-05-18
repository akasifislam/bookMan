@extends('layouts.app')

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
                            <select class="form-control" name="category_filter" id="category_filter">
                                <option value="">Select Category</option>
                            </select>

                            <label for="keyword">&nbsp; &nbsp;</label>
                            <input type="text" class="form form-control" name="keyword" placeholder="Enter Keyword" id="keyword">
                            <span>&nbsp;</span>
                            <button type="button" class="btn btn-primary">search</button>
                            <a class="btn btn-secondary" href="">clear</a>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table style="width: 100%" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
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
                                <tr>
                                    <td>1</td>
                                    <td>Post Title</td>
                                    <td>Asif</td>
                                    <td>Story</td></td>
                                    <td>dfdgfhdf</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="">edit</a>
                                        <a class="btn btn-sm btn-success" href="">view</a>
                                        <a class="btn btn-sm btn-danger" href="">delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
