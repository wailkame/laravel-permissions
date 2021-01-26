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
                        <select class="custom-select  d-block" style="width: 10rem;" name="category_id">
                            <option value="">Choose Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        <br/>
                        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="defaultCheck1" name="published">
                            <label class="form-check-label" for="defaultCheck1">
                              Published
                            </label>
                        </div>
                        <br/>
                        @endif
                        
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection