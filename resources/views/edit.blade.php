<!-- resources/views/sbds.blade.php	-->
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
/* 白鳥が記述 */
/*ページ全体のCSS適用*/
.panel-body{
    max-width: 1060px;
    font-size:100%;
    text-align: center;
    line-height: 1.7;
    font-family: 'Noto Sans JP','Roboto', sans-serif;
    max-width: 1060px;
    margin: 0 auto;
    box-sizing: border-box;
}

a{
    text-decoration: none;
}

a:hover{
    text-decoration: none;
}

img{
    max-width: 100%;
}

iframe {
    max-width: 100%;
}

li{
    list-style:none
}

/*CSSの個別部分*/

div#map-canvas {
    /* text-align: center; */
    margin: 0 auto;
}

.form-content {
    padding: 10px 0 5px 0px;
}

label {
    margin: 15px 0 5px 0;
}

input#who {
    width: 100%;
}

input#title {
    width: 100%;
}

textarea#message {
    width: 30%;
}

.drag-drop-inside {
    border: dashed 2px;
    width: 80%;
    margin: 0 auto;
    /* text-align: center; */
}

input#fileInput {
    width: 80%;
}

input#open_time {
    width: 100%;
}

input#address {
    width: 80%;
}

.form-content.public-form {
    padding: 40px 0 0px 0;
}

textarea#tags {
    width: 100%;
}

div#sub-button {
    padding: 15px 0 15px 0;
}

//下記ドラックアンドドラップのｃｓｓを当ててます。-------

  #dragDropArea{
  background-color: #f4f4f4;
  margin: 10px;
  padding: 10px;
  border: #ddd dashed 5px;
  min-height: 200px;
  text-align: center;

}
#dragDropArea p{
    color: #999;
    font-weight: bold;
  
}
#dragDropArea .drag-drop-buttons{
   
}
.drag-drop-buttons input{
  
}




.letterdiv{
display:flex;
}

input[type="text"] {
  width: 100%;
  border: 2px solid #aaa;
  border-radius: 4px;
  margin: 8px 0;
  outline: none;
  padding: 8px;
  box-sizing: border-box;
  transition: 0.3s;
}

input[type="text"]:focus {
  border-color: dodgerBlue;
  box-shadow: 0 0 8px 0 dodgerBlue;
}

.inputWithIcon input[type="text"] {
  padding-left: 40px;
}

.inputWithIcon {
  position: relative;
}

.inputWithIcon i {
  position: absolute;
  left: 0;
  top: 8px;
  padding: 9px 8px;
  color: #aaa;
  transition: 0.3s;
}

.inputWithIcon input[type="text"]:focus + i {
  color: dodgerBlue;
}

.inputWithIcon.inputIconBg i {
  background-color: #aaa;
  color: #fff;
  padding: 9px 4px;
  border-radius: 4px 0 0 4px;
}

.inputWithIcon.inputIconBg input[type="text"]:focus + i {
  color: #fff;
  background-color: dodgerBlue;
}


</style>


<!-- Bootstrap の定形コード… -->
<div class="panel-body">

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->

  <!--<div>投稿画面</div>-->
  <!----------------------------------->

  <form action="{{	url('index')	}}" method="POST" enctype="multipart/form-data">
    <!-- なり代わり防止のヘルパー関数 -->
    {{ csrf_field()	}}
    
   
    <div class="border d-flex justify-content-center align-items-center flex-column">
        
<div class="d-flex justify-content-center align-items-center flex-column border col-12">
    

    
    <div class="form-content d-flex m-2 border">
      <div class="mb-1 "><label for="who"><h4>手紙の宛先</h4></label></div>
      <div class="m-2　inputWithIcon inputIconBg">
           
          <input type="text" name="who" id="who" value="{{old('who')}}" placeholder="〇〇さんへ"></div>
    </div>
    

    <div class="form-content d-flex m-2 border">
      <div class="mb-1 "><label for="title"><h3>タイトル</h3></label></div>
      <div class="m-2"><input type="text" name="title" id="title" value="{{old('title')}}" placeholder="〇〇後のじぶんへ"></div>
    </div>
    
    </div>
   
    <div class="form-content border">
      <div><label for="message"><h3>内容</h3></label></div>
      <textarea name="message" id="message" cols="100" rows="10" width=600>{{old('message')}}</textarea>
      <!--<input type="text" name="message" id="message" value="{{old('message')}}">-->
    </div>
    
    
     <!--開ける日DIV-->
    <div class="form-content border d-flex justify-content-center align-items-center">
      <div class="m-3"><label for="open_time"><h3>手紙の公開日</h3></label></div>
      <div class="m-3"><input type="datetime-local" name="open_time" id="open_time"></div>
    </div>
    <!--ここまで-->
    
    <div class="d-flex justify-content-center align-items-center">
     

<div class="d-flex flex-column border m-2">

    <div class="form-content">
      <label for="file"><h3>写真</h3></label>
    </div>
    
    
    <!--下記ドラックアンドドラップ部分-->
      <div id="dragDropArea border">
        <div class="drag-drop-inside" width=300>
            <p class="drag-drop-info">ここにファイルをドロップ</p>
            <p>もしくは「ファイルを選択」</p>
            <p class="drag-drop-buttons">
                <input id="fileInput" type="file"  value="ファイルを選択" name="pic_name" onChange="photoPreview(event)">
            </p>
            <div id="previewArea"></div>
        </div>
      </div>
    <!--ここまで-->
    
    </div>
    
   
    
    <div class="d-flex flex-column border m-2">
  <!--場所-->
    <div class="form-content d-flex">
      <div class="mb-2"><label for="open_place_name"><h3>場所<h3></label></div>
     <div class="m-3"> <input type="text" name="open_place_name" id="address" value="{{old('open_place_name')}}"></div>
    <div class="m-3">  <button type="button" value="検索" id="map_button">検索</button></div>
    </div>
    <!--ここまで-->
    
    
    <!--マップ出す位置-->
    <div class="map_box01 border">
      <div id="map-canvas" style="width: 300px;height: 130px;"></div>
    </div>
    <!--ここまで-->
    </div>
    
    
    </div>
 
    
    <div class="d-flex justify-content-center align-items-center border col-12">
    
    
　<!--タグ-->
    <div class="form-content d-flex flex-column m-3">
      <div><label for="tags"><h4>タグ</h4></label></div>
     <div> <textarea name="tags" id="tags" cols="10" width=300 placeholder="#ジーズアカデミー" rows="5">{{old('tags')}}</textarea></div>
    </div>
    <!--ここまで-->
    
    
   <!--公開設定-->
    <div class="form-content public-form d-flex flex-column mb-5 m-3">
        <div><h3>公開設定</h3></div>
    <div>
      <input type="radio" name="public" value="0" checked> はい
      <input type="radio" name="public" value=1 > いいえ
      </div>
    </div>
    <!--ここまで-->
    
    </div>
 
    
    
    
    <!-- hiddenで情報を送ってます -->
    <input type="hidden" id="lat" value="" name="ido">
    <input type="hidden" id="lng" value="" name="keido">
    <!--ここまで-->
    
    <!--送信ボタン-->
    <div id="sub-button"><button type="submit">置き手紙を投函する</button></div>
  </form>
  
 

</div>

</div>


    <script src="{{ asset('/js/edit.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyAj-SiIlxd4UX4R5esdvy9D_hPwuzsMxuc">
    </script>


@endsection
