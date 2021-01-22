@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <a href="{{ route('article.create')}}" class="btn btn-primary mb-4">Add Article</a>
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Text</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>
                                <a href="{{ route('article.create')}}" class="btn btn-sm btn-primary mb-4">Edit</a>
                                <a href="{{ route('article.create')}}" class="btn btn-sm btn-danger mb-4">Delete</a>
                            </td>
                          </tr>
                          
                        </tbody>
                      </table>       
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
