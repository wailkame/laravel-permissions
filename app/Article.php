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
        if(Auth::check() && !Auth::user()->is_admin){
            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('user_id', Auth::id());
            });
        }
        
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
