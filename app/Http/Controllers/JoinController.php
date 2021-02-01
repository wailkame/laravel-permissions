<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    //
    public function create(){

        $organization = User::findOrFail(request('organization_id'));
        return view('join', compact('organization'));
    }

    public function store(Request $request){
        Auth::user()->organizations()->attach(request('organization_id'));
        return redirect()->route('home');
    }

    public function organization(){
        $organization = User::findOrFail(request('organization_id'));
        session(['organization_id' => $organization->id, 'organization_name' => $organization->name]);
        return back();
    }
}
