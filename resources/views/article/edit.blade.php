@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Article') }}</div>

                <div class="card-body">
                    <form action="/article/{{$article->id}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" value="{{$article->title}}" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" name="description" id="description" placeholder="Description" >{{$article->description}}</textarea>
                        </div>
                        <select class="custom-select mb-4 d-block" style="width: 10rem;" name="category_id">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)

                                @if ($category->id === $article->category_id)
                                <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                <?php continue; ?>
                                @endif
                                
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>

                        @can('publish-articles')
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="published">
                            <label class="form-check-label" for="defaultCheck1">
                              Published
                            </label>
                        </div> 
                        <br/>
                        @endcan
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection