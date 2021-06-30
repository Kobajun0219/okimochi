<?php

namespace App\Http\Controllers;

//不明(タグ機能実装の際に記載)
use Illuminate\Support\Facades\DB;

//app/の中のモデルを使えるようにする（頭文字は大文字
use App\Pastel_tag;
use App\Pastel;  
use App\Tag;   
use App\Pastel_user;
use App\User;

//Request関数を使えるようにする
use Illuminate\Http\Request;  

//Validatorを使えるようにしている
use Validator;  

use Auth;

class UserController extends Controller
{
    
    
//表示
    public function index() {
        
        //自分の保存した投稿のIDを取得。//Paste::where(投稿ID)
         $saves = Pastel_user::where('user_id', Auth::user()->id)->paginate(5);

         //自分の投稿一覧を取得
         $pastels = Pastel::where('u_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
        
         return view('/user', compact('pastels','saves'));
    }
    
    
//公開設定変更
    public  function change_public(Request $request) {

                //0が飛んできたときに0に更新
                if($request->public == 0) {
                    $pastels= Pastel::find($request->id);
                    $pastels->public = 0;
                    $pastels->save();
                    }
                
                //1が飛んできたときに1に更新
                if($request->public == 1) {
                 $pastels= Pastel::find($request->id);
                 $pastels->public =$request->public;
                 $pastels->save();
                //   dd($pastels);
                }
                return redirect('/user');
    }
    
    
//保存機能   
    public  function save($id) {
        
        //同じデータの場合にはindexに返す
        $all = Pastel_user::all();
        foreach ($all as $al) {
            if($al->pastel_id == $id && $al->user_id == Auth::user()->id) {
                // dd($al->pastel_id);
                return redirect('/');
            }
        }
        
        //pastel_usersテーブルへ値を入れる
        $saves = new Pastel_user; //app/Pastelを入れる
        $saves->pastel_id = $id;
        $saves->user_id = Auth::user()->id;
        $saves->save(); 
        return redirect('/');   
    }
    
}
