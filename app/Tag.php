<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag_name'];

    public function pastels()
    {
        return $this->belongsToMany('App\Pastel', 'pastel_tags');
    }
}
