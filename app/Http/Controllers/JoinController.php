<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JoinController extends Controller
{
    //
    public function create(){

        $organization = User::findOrFail(request('organization_id'));
        return view('join', compact('organization'));
    }

    public function store(Request $request){
        Auth::user()->organizations()->attach($request->input('organization_id'),[
            'role_id' => $request->input('role_id')
        ]);
        return redirect()->route('home');
    }

    public function organization(){
        $organization = User::findOrFail(request('organization_id'));
        $role = DB::table('user_organization')
                ->where('organization_id', $organization->id)
                ->where('user_id', Auth::id())
                ->first();      
        session([
            'organization_id' => $organization->id,
            'organization_name' => $organization->name,
            'organization_role_id' => $role->role_id
         ]);
        // we can replace $role->id with $organization->pivot->role_id
        return back();
    }
}
