<!-- resources/views/sbds.blade.php	-->
@extends('layouts.app')

@section('content')
    
    
<!-- バリデーションエラーの表示に使用-->
<style>
/*こばじゅんCSS*/
.title{
  text-align: center;
  padding: 20px;
}
.tag_title {
  position: relative;
  display: inline-block;
  padding: 1rem 2rem 1rem 3rem;
  color: #fff;
  border-radius: 100vh 0 0 100vh;
  background:#CC9966;
  font-size: 25px;
}

.tag_title:before {
  position: absolute;
  top: calc(50% - 7px);
  left: 10px;
  width: 14px;
  height: 14px;
  content: '';
  border-radius: 50%;
  background: #fff;
}

/*こばじゅんCSS*/


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


img{
    max-width: 100%;
    object-fit: contain;
}

iframe {
    max-width: 100%;
}

li{
    list-style:none
}

ul.pagination {
    display: -webkit-inline-box;
}

/*CSSの個別部分*/

.title {
    padding: 30px 0 0px 0;
}

.content-wrapper {
    display: flex;
    padding: 10px 0 60px 0;
}

.container.save-container {
    background-color: #bfb4a7;
    padding: 10px 5px;
}

ul {
    display: flex;
    flex-direction: column;
    padding: 0;
}


.content-user {
    padding: 10px 0 10px 0;
}

.content-title {
    padding: 5px 0 25px 0;
}

.content-message {
    height: 60px;
}

.content-date {
    padding: 10px 0 10px 0;
}


.post-flexbox {
    <!--max-width: 800px;-->
    padding:  10px;
    display: flex; 
    flex-wrap: wrap; 
    text-align:center;
}
 
.box-eachpost {
    padding: 10px;
    margin-top:  10px;
    margin-left:20px;
    margin-right:20px;
    <!--height: 364px;-->
    width: 28%;
    border: 1px solid
}

.img-content {
    height: 100px;
}

@media all and (max-width: 479px) {

.box-eachpost{
width:90%
}

post-flexbox{
 flex-direction: column;
}


}

</style>


@include('common.errors')
<!-- バリデーションエラーの表示に使用-->




<!-- Bootstrap の定形コード… -->



  <!-- 現在の投稿 -->
  <!-- web.phpの/selectで飛んできたpastelsが入る -->
  <div class="title"><div class="tag_title">#{{$tags->tag_name}}</div></div>
  

  



  <div class="panel panel-default">
    <div class="panel-heading">

    </div>
  </div>
  <div class="panel-body" style="margin: 0 auto;">
    <table class="table table-striped task-table">
      <!-- 投稿ヘッダ -->
      <br><br>
      <div style="font-size:28px;">投稿一覧<img src="https://img.icons8.com/small/32/000000/message-squared.png"/></div>
     
      <div class="post-flexbox">
        {{-- @foreachで回して$pastels から＄pastelに値をそれぞれ入れる--}}
        @foreach ($tags->pastels as $pastel)
          <div class="box-eachpost">
            <!-- 本タイトル -->
              <div class="img-content"><img src="{{ asset('/uploads/'.$pastel->pic_name) }}" alt="" style="max-width :200px; height: 100px;"></div>
            <!--<div class="table-text">-->
              <!-- $pastelの内容を表示 -->
              <div style="font-weight:bold;">書き手:{{ $pastel->u_name }}</div>
              <div style="font-weight:bold;">タイトル:{{ $pastel->title }}</div>
              <div>開封日時:{{  substr(($pastel->open_time),0,16) }}</div>
                <a onclick="eventPanto({{ $pastel }})" class="place" style="text-decoration:none;">
              場所:{{ $pastel->open_place_name }}
              </a>
              <div>

          </div>
          <div>

          </div>
        
          </div>
        @endforeach
      </div>
    <!--</table>-->
  </div>
</div>









@endsection

 