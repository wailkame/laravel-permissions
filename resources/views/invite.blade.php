@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Invite a temmate') }}</div>

                <div class="card-body">
                    Link for invitation:
                    <br>
                    <span>{{route('register')}}?organization_id={{Auth::user()->organization_id ? Auth::user()->organization_id: Auth::id()}}</span>
                    <br><br>
                    link for existing users:
                    <br>
                    <span>{{route('join.create')}}?organization_id={{Auth::user()->organization_id ? Auth::user()->organization_id: Auth::id()}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection