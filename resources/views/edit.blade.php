@extends('layouts.app')
@section('content')
<style>
/* 白鳥が記述 */
/*ページ全体のCSS適用*/
.panel-body{
    max-width: 100%;
    font-size:100%;
    text-align: center;
    line-height: 1.7;
    font-family: 'Noto Sans JP','Roboto', sans-serif;
    
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
    width: 50%;
}
input#title {
    width: 50%;
}
textarea#message {
    width: 50%;
}
.drag-drop-inside {
    border: dashed 2px;
    width: 30%;
    margin: 0 auto;
    /* text-align: center; */
}
input#fileInput {
    width: 80%;
}
input#open_time {
    width: 30%;
}
input#address {
    width: 25%;
}
.form-content.public-form {
    padding: 40px 0 0px 0;
}
textarea#tags {
    width: 30%;
}
div#sub-button {
    padding: 15px 0 15px 0;
}
//下記ドラックアンドドラップのｃｓｓを当ててます。-------
  #dragDropArea{
  background-color: #F4F4F4;
  margin: 10px;
  padding: 10px;
  border: #ddd dashed 5px;
  min-height: 200px;
  text-align: center;
  max-width
}
#dragDropArea p{
    color: #999;
    font-weight: bold;

}
#dragDropArea .drag-drop-buttons{
  
}
.drag-drop-buttons input{
    <!--margin: auto;-->
}

.font-weight {
font-weight: bold;
} 
</style>
<!-- Bootstrap の定形コード… -->
<div class="panel-body ">
  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->
  <!--<div>投稿画面</div>-->
  <!----------------------------------->
  <form action="{{	url('index')	}}" method="POST" enctype="multipart/form-data">
    <!-- なり代わり防止のヘルパー関数 -->
    {{ csrf_field()	}}
    <div class="form-content">
      <div><label for="who">
        <h5 class="font-weight">
      手紙の宛先<img src="https://img.icons8.com/material-outlined/24/000000/person-male.png"/>
      </h5>
      </label></div>
      <input type="text" name="who" id="who" value="{{old('who')}}">
    </div>
    <div class="form-content">
      <div><label for="title">
       <h5 class="font-weight">
      タイトル<img src="https://img.icons8.com/material-two-tone/24/000000/term.png"/>
      </h5>
        </label></div>
      <input type="text" name="title" id="title" value="{{old('title')}}">
    </div>
    <div class="form-content ">
      <div><label for="message">
         <h5 class="font-weight">
      メッセージ<img src="https://img.icons8.com/material-outlined/24/000000/mail.png"/>
      </h5>
        </label></div>
      <textarea name="message" id="message" cols="30" rows="10">{{old('message')}}</textarea>
      <!--<input type="text" name="message" id="message" value="{{old('message')}}">-->
    </div>
    <div class="form-content ">
      <label for="file">
         <h5 class="font-weight">
      写真<img src="https://img.icons8.com/material-outlined/24/000000/camera--v2.png"/>
      </h5>
      
        </label>
    </div>
    <!--下記ドラックアンドドラップ部分-->
      <div id="dragDropArea ">
        <div class="drag-drop-inside">
            <p class="drag-drop-info">ここにファイルをドロップ</p>
            <p>もしくは「ファイルを選択」</p>
            <p class="drag-drop-buttons">
                <input id="fileInput" type="file"  value="ファイルを選択" name="pic_name" onChange="photoPreview(event)">
            </p>
            <div id="previewArea"></div>
        </div>
      </div>
    <!--ここまで-->
    <!--開ける日-->
    <div class="form-content">
      <div><label for="open_time">
           <h5 class="font-weight">
      　手紙の公開日<img src="https://img.icons8.com/material-outlined/24/000000/clock--v1.png"/>
      </h5>
        
        
        </label></div>
      <input type="datetime-local" name="open_time" id="open_time">
    </div>
    <!--ここまで-->
  <!--場所-->
    <div class="form-content">
      <div><label for="open_place_name">
        
        <h5 class="font-weight">
        置く場所<img src="https://img.icons8.com/material-outlined/24/000000/place-marker--v1.png"/>
      </h5>
        
        </label></div>
      <input type="text" name="open_place_name" id="address" value="{{old('open_place_name')}}">
      <button type="button" value="検索" id="map_button" class="btn btn-secondary"><img src="https://img.icons8.com/material-outlined/24/000000/search--v1.png"/></button>
    </div>
    <!--ここまで-->
   <!--公開設定-->
    <div class="form-content public-form">
      <h5 class="font-weight">
      公開設定<img src="https://img.icons8.com/material-outlined/24/000000/lock--v1.png"/>
      </h5>
      
      <input type="radio" name="public" value="0" checked> はい
      <input type="radio" name="public" value=1 > いいえ
    </div>
    <!--ここまで-->
　<!--タグ-->
    <div class="form-content">
      <div><label for="tags">
         <h5 class="font-weight">
        タグ<img src="https://img.icons8.com/material-outlined/24/000000/tag-window.png"/>
         </h5>
      
        </label></div>
      <textarea name="tags" id="tags" cols="10" placeholder="#ジーズアカデミー" rows="5">{{old('tags')}}</textarea>
    </div>
    <!--ここまで-->
    <!-- hiddenで情報を送ってます -->
    <input type="hidden" id="lat" value="" name="ido">
    <input type="hidden" id="lng" value="" name="keido">
    <!--ここまで-->
    <!--送信ボタン-->
    <div id="sub-button"><button type="submit" class="btn btn-secondary text-dark font-weight">投函する<img src="https://img.icons8.com/material-outlined/24/000000/new-message.png"/></button></div>
  </form>
  <!--マップ出す位置-->
    <div class="map_box01 ">
      <div id="map-canvas" style="max-width:500px;height:300px;"></div>
    </div>
    <!--ここまで-->
</div>
    <script src="{{ asset('/js/edit.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=">
    </script>
@endsection
