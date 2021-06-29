<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pastel_user extends Model
{
     //pastelテーブルの値を使える関数を作成
      public function pastel(){
        return $this->belongsTo('App\Pastel');
    }
    
    //userテーブルの値を使える関数を作成
    public function user(){
        return $this->belongsTo('App\User');
    }
}
