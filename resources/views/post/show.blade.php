@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><div class="d-flex justify-content-between">
                    <div class="">Post</div>
                    <div  class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-primary btn-sm" href="{{ route('app.post.index') }}"><i class="fas fa-list"></i></a>
                        <a class="btn btn-sm btn-success" href="{{ route('app.post.edit',$post->id) }}"><i class="fas fa-edit"></i></a>
                    </div>
                </div>
            </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="table-success">
                              <th width="20%">Field Name</th>
                              <th width="80%"> Information  </th>
                           
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Id</td>
                              <td>{{$post->id}}</td>
                            
                            </tr>
                            <tr>
                              <td>Book Name</td>
                              <td>{{$post->title}}</td>
                            
                            </tr>
                            <tr>
                              <td>Book Author</td>
                              <td>{{$post->user->name}}</td>
                            
                            </tr>
                            <tr>
                              <td>Description</td>
                              <td>{{$post->description}}</td>
                            
                            </tr>
                           <tr>
                              <td>Category</td>
                              <td>{{$post->category->name}}</td>
                            
                            </tr>
                      
                            <tr>
                              <td>tags</td>
                              <td>
                                  @if(count($post->tags))
                                    @foreach($post->tags as $tag)
                                     {{$tag->name}} <br>
                                    @endforeach
                                  @endif
                              </td>
                            
                            </tr>
                      
                            <tr>
                              <td>Image</td>
                              <td>
                                  <img style="width: 150px; height: 200px;" src="{{asset('post_images/'.$post->image)}}">
                              </td>
                            
                            </tr>
                      
                            <tr>
                              <td>Created At</td>
                              <td>
                                {{$post->created_at}}
                              </td>
                            
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{$post->price}}</td>
                              
                            </tr>
                            <tr>
                                <td>Quentity</td>
                                <td>{{$post->qty}}</td>
                              
                            </tr>
                      
                          </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
