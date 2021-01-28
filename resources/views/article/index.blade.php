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
                    
                    <a href="{{ route('article.create')}}" class="btn btn-primary mb-4">Add Article</a>
                    
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            
                            @can('see-article-user')
                            <th scope="col">User</th>
                            @endcan
                            <th scope="col">Published At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $id = 0?>
                          @foreach ($articles as $article)
                            <?php $id++ ?>
                            <tr>
                              <th scope="row"><?= $id?></th>
                              <td>{{$article->title}}</td>
                              @can('see-article-user')
                              <td>{{$article->user->name}}</td>  
                              @endcan
                              <td>{{$article->published_at}}</td>                     
                              {{-- <td class="d-inline-block  text-truncate" style="max-width: 150px;">{{$article->description}}</td> --}}
                              <td>
                                  <a href="/article/{{$article->id}}/edit" class="btn btn-sm btn-primary mb-4">Edit</a>
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
