@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('AddArticle') }}</div>

                <div class="card-body">
                    <form action="/article" method="POST">
                        @csrf
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                        <select class="custom-select mb-4 d-block" style="width: 10rem;" name="category_id">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            
                        </select>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection