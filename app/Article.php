<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use PDO;

class Article extends Model
{
    //
    protected $fillable = ['title', 'description', 'category_id','user_id','published_at'];
    
    protected static function booted()
    {
        // shows only user its articles 

        if(Auth::check() && Auth::user()->is_admin  && Auth::user()->is_publisher){
            static::addGlobalScope('user', function (Builder $builder) {
                $organization_id = Auth::user()->organization_id ? Auth::user()->organization_id: Auth::id();
                $builder->where('user_id', $organization_id);
            });
        }
        
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
