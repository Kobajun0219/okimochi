<?php

namespace App\Http\Controllers;

//不明(タグ機能実装の際に記載)
use Illuminate\Support\Facades\DB;

//app/の中のモデルを使えるようにする（頭文字は大文字
use App\Pastel_tag;
use App\Pastel;  
use App\Tag;   

//Request関数を使えるようにする
use Illuminate\Http\Request;  

//Validatorを使えるようにしている
use Validator;  
use Auth;



class PastelsController extends Controller
{
 //LPページに飛ぶ   
    public function lp() {
        return view('lp'); 
        
    }
    
    
//一覧表示
    public function index() //classの中のindexをpublicを使うことによって外部から参照できる,他人の非公開が見れないようにする
    {
        //ランダムでタグを5つ表示
        $tags = Tag::inRandomOrder()->take(5)->get();
        
        //自分の非公開/過去だけを取得
        $today = date("Y-m-d H:i:s");
        $mypastels  = Pastel::where('u_id',Auth::user()->id)->where('open_time', '<=', $today)->where('public',1)->orderBy('created_at', 'desc')->get();
        
        //みんなの公開/過去だけを取得
        $pastels = Pastel::where('open_time', '<=', $today)->where('public',0)->orderBy('created_at', 'desc')->paginate(6); 
        
        //みんなの公開/過去だけを取得
        $allpastels = Pastel::where('open_time', '<=', $today)->where('public',0)->orderBy('created_at', 'desc')->get(); //created_atの降順（desc)で表示させる
         
        return view('index', compact('pastels','mypastels','tags','allpastels'));//compactでindexに渡してあげる
    }
    

//詳細表示
    public function detail($id) //web.phpで指定した＄idを引数で渡す
    {
        $pastels = Pastel::find($id);//Pastelから該当するidのデータを取得
        return view('detail', compact('pastels'));//detailにpastelsの値を渡す
    }
    

//タグの一覧表示
    public function detail_tag($id) //classの中のindexをpublicを使うことによって外部から参照できる
    {
        $tags=Tag::find($id);
        return view('tag', compact('tags'));// /tagにtagsの値を渡す
    }


//editに移動
    public function edit() //classの中のeditをpublicを使うことによって外部から参照できる
    {
        return view('/edit');  //viewsの中のeditを表示
    }


//登録
    public function store(Request $request) //classの中のstoreをpublicを使うことによって外部から参照できる
    {
    //バリデーション
        $validator    =    Validator::make($request->all(),    [
            'title' => 'required|min:1',
            'message' => 'required|min:1',
            'open_place_name' => 'required|min:1',
            ]);
    //バリデーション：エラー
        if ($validator->fails()) {
            return    redirect('/edit')   //エラーの場合に'/edit'に返す
                ->withInput() //入力された値を'/'に返す
                ->withErrors($validator);  //エラーの内容を返す
        }

        

    //画像の扱いに関して
        if ($file = $request->pic_name) {
            //保存するファイルに名前をつける
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            //Laravel直下のpublicディレクトリに新フォルダをつくり保存する
            $target_path = public_path('/uploads/');
            $file->move($target_path, $fileName);
        } else {
            //画像が登録されなかった時はから文字をいれる
            $fileName = "logo2.png";
        }


    //tag付けに関して
        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-Z0-9０-９ぁ-んァ-ヶー一-龠 - 々 ー \']+)/u', $request->tags, $match);
        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['tag_name'=>$tag]); // firstOrCreateメソッドで、tags_tableのtag_nameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);// $recordを配列に追加します(=$tags)
        };

        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag->id);
        };
        // 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。


// Eloquent モデル
    
        $pastels = new Pastel; //app/Pastelを入れる
        $pastels->who = $request->who;
        $pastels->title = $request->title; 
        $pastels->message = $request->message;
        $pastels->u_id = Auth::user()->id;
        $pastels->u_name = Auth::user()->name;
        $pastels->pic_name = $fileName;
        $pastels->open_time = $request->open_time;
        $pastels->open_place_name = $request->open_place_name;
        $pastels->open_place_latitude = $request->ido;
        $pastels->open_place_longitude =  $request->keido;
        $pastels->public = $request->public;
        $pastels->save();  //「/」ルートにリダイレクト
        $pastels->tags()->attach($tags_id);// 投稿ににタグ付するために、attachメソッドをつかい、モデルを結びつけている中間テーブルにレコードを挿入します。
        return  redirect('/');
    }
    
    



}
