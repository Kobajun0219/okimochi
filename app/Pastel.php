<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastel extends Model
{
        public function tags(){
        return $this->belongsToMany('App\Tag', 'pastel_tags');
    }
    
    
    public function pastel_users(){
    return $this->hasMany('App\Pastel_user');
    }
}
