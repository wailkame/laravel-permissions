@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('AddArticle') }}</div>

                <div class="card-body">
                    <form>
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea type="text" class="form-control" name="description" id="description" placeholder="Description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                   
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection