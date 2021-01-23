@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <div class="card-body">
                    
                    <a href="{{ route('category.create')}}" class="btn btn-primary mb-4">Add Category</a>
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $id = 0?>
                          @foreach ($categories as $category)
                            <?php $id++ ?>
                            <tr>
                              <th scope="row"><?= $id?></th>
                              <td>{{$category->name}}</td>
                              <td class="d-inline-block  text-truncate" style="max-width: 150px;">{{$category->created_at}}</td>
                              <td>
                                  <a href="/category/{{$category->id}}/edit" class="btn btn-sm btn-primary mb-4">Edit</a>
                                  <a href="#" class="btn btn-sm btn-danger mb-4">Delete</a>
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
@endsection
