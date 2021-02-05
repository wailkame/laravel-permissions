@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Join The Organization') }}</div>

                <div class="card-body">
                   <form action="{{route('join.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="organization_id" value="{{$organization->id}}">
                        Do you want to join the organization <b>{{$organization->name}}</b>
                        <br>
                        Join As:
                        <select name="role_id" class="form-control">
                            <option value="1">Simple user</option>
                            <option value="3">Publisher</option>
                        </select>
                        <br>
                        <input type="submit" class="btn btn-primary" value="Yes, Join">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection