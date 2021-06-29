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
  background:#FF9933;
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


//----mizuki
.row＿card_05 {
  max-width: 100px;
  margin: 50px auto 0;
}

.card {
  float: left;
  padding: 0 1.7rem;
  width: 100%;
background-color: #f39f86;
background-image: linear-gradient(315deg, #f39f86 0%, #f9d976 74%);



}
.card .menu-content {
  margin: 0;
  padding: 0;
  list-style-type: none;
}
.card .menu-content::before, .card .menu-content::after {
  content: "";
  display: table;
}
.card .menu-content::after {
  clear: both;
}
.card .menu-content li {
  display: inline-block;
}
.card .menu-content a {
  color: #fff;
}
.card .menu-content span {
  position: absolute;
  left: 50%;
  top: 0;
  font-size: 10px;
  font-weight: 700;
  font-family: 'Noto Sans JP';
  transform: translate(-50%, 0);
}
.card .wrapper {
  background-color: #fff;
  min-height: 450px;
  position: relative;
  overflow: hidden;
  box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.2);
}
.card .wrapper:hover .data {
  transform: translateY(0);
}
.card .data {
  position: absolute;
  bottom: 0;
  width: 100%;
  transform: translateY(calc(70px + 1em));
  transition: transform 0.3s;
}
.card .data .content {
  padding: 1em;
  position: relative;
  z-index: 1;
}
.card .author {
  font-size: 12px;
}
.card .title {
  margin-top: 10px;
}
.card .text {
  height: 70px;
  margin: 0;
}
.card input[type=checkbox] {
  display: none;
}
.card input[type=checkbox]:checked + .menu-content {
  transform: translateY(-60px);
}

.example-1 .date {
  position: absolute;
  top: 0;
  left: 0;
  background-color: #4f96f6;
  color: #fff;
  padding: 0.8em;
}
.example-1 .date span {
  display: block;
  text-align: center;
}
.example-1 .date .day {
  font-weight: 700;
  font-size: 24px;
  text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.18);
}
.example-1 .date .month {
  text-transform: uppercase;
}
.example-1 .date .month,
.example-1 .date .year {
  font-size: 12px;
}
.example-1 .content {
  background-color: #fff;
  box-shadow: 0 5px 30px 10px rgba(0, 0, 0, 0.3);
}
.example-1 .title a {
  color: gray;
}
.example-1 .menu-button {
  position: absolute;
  z-index: 999;
  top: 16px;
  right: 16px;
  width: 25px;
  text-align: center;
  cursor: pointer;
}
.example-1 .menu-button span {
  width: 5px;
  height: 5px;
  background-color: gray;
  color: gray;
  position: relative;
  display: inline-block;
  border-radius: 50%;
}
.example-1 .menu-button span::after, .example-1 .menu-button span::before {
  content: "";
  display: block;
  width: 5px;
  height: 5px;
  background-color: currentColor;
  position: absolute;
  border-radius: 50%;
}
.example-1 .menu-button span::before {
  left: -10px;
}
.example-1 .menu-button span::after {
  right: -10px;
}
.example-1 .menu-content {
  text-align: center;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  z-index: -1;
  transition: transform 0.3s;
  transform: translateY(0);
}
.example-1 .menu-content li {
  width: 33.333333%;
  float: left;
  background-color: #4f96f6;
  height: 60px;
  position: relative;
}
.example-1 .menu-content a {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 24px;
}
.example-1 .menu-content span {
  top: -10px;
}

.card_href_05 {
  text-decoration:none;
  color: #4f96f6;

}

.card_maintitle {
  font-size: 1.4rem;
  font-weight: bold;
  text-decoration:none;
}

.card_href_05_2 {
  text-decoration:none;
  color: #FFFFFF;
}

.card_maintitle {
  font-size: 1.4rem;
  font-weight: bold;
}



</style>


@include('common.errors')
<!-- バリデーションエラーの表示に使用-->




<!-- Bootstrap の定形コード… -->



  <!-- 現在の投稿 -->
  <!-- web.phpの/selectで飛んできたpastelsが入る -->
  <div class="title"><div class="tag_title">#{{$tags->tag_name}}</div></div>
  

  


      <!-- テーブル本体 -->
  
        {{-- @foreachで回して$pastels から＄pastelに値をそれぞれ入れる--}}
            @foreach ($tags->pastels as $pastel)
            <!--//公開設定しているものだけを表示しています-->
              @if($pastel->public == 0)
              
             <div class="note_wrap col-4">
   <div class="example-1 card">
    <div class="wrapper"style="background-image: url({{'/uploads/'.$pastel->pic_name}});">
      <div class="date">
        <span>{{$pastel->u_name}}</span>
      </div>
      <div class="data">
        <div class="content">
          <span class="author">宛先　{{$pastel->who}}</span>
          <p class="card_maintitle">タイトル　{{$pastel->title}}</p>
     
          <label for="show-menu" class="menu-button"><span></span></label>
        </div>
        <input type="checkbox" id="show-menu" />
        <ul class="menu-content">
 <li>
            <a href="#" class="fa fa-bookmark-o"></a>
          </li>
              
          <li class="fa fa-heart-o">場所　{{$pastel->open_place_name}}</li>
           @foreach ($pastel->tags as $tag)
          
          <li class="fa fa-comment-o">タグ　#{{$tag->tag_name}}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
             
              <!--タグを出しています-->
                  @foreach ($pastel->tags as $tag)
                  <div>#{{$tag->tag_name}}</div>
                   @endforeach

              @endif
            @endforeach

    
   
  </div>




@endsection

 