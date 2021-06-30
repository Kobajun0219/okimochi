<!-- resources/views/sbds.blade.php	-->
@extends('layouts.app')
@section('content')


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

.page-title {
    font-size: 1.2rem;
}

p.page-title {
    font-size: 1.2rem;
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

ul.pagination {
    display: -webkit-inline-box;
}

a.place {
    color: black;
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
    height: 364px;
    width: 28%;
    border: 1px solid
}

.img-content {
    height: 100px;
    margin-bottom: 2rem;
}

.public-content {
    padding: 0.25rem 0 0.25rem 0;
}

button.btn.btn-danger.edit-btn {
    padding: 1px 5px 1px 5px;
}

button.btn.btn-danger.del-btn {
    <!--background-color: #ff4141;-->
    margin-top: 0.5rem;
}

.tag-content {
    margin-top: -0.5rem;
}

  @media screen and ( max-width:479px )
{
	.post-flexbox{
	padding:  10px;
    display: flex; 
    flex-direction: column;
    text-align:center;
    
	}
	
	.content-wrapper {
    display: flex;
    flex-direction: column;
    padding: 10px 0 10px 0;
    }
	
	.box-eachpost {
    padding: 10px;
    margin-top:  10px;
    margin-left:20px;
    margin-right:20px;
    width: 90%;
    border: 1px solid
    height: 330px;
    }
    
    button.btn.btn-danger.del-btn {
    margin-top: 10px;
    margin-bottom: -10px;
    }
}



    .page{
    	justify-content: center;
	    align-items: center;
	    padding-top: 15px;
	    display:webkit inline-block;
      }
</style>

<!-- Bootstrap の定形コード… -->
<div class="panel-body">

    <div class="title"><p class="page-title">お気に入り投稿一覧</p><div>
        
    <div class="content-wrapper">
        @foreach ($saves as $save)
            <div class="container save-container">
                <div><img src="{{ asset('/uploads/'.$save->pastel->pic_name) }}" alt="" style="width: 100px; height: 100px;"></div>
                <ul>
                    <li><div class="content-user"> 宛先：{{$save->pastel->who}}</div></li>
                    <li><div class="content-title"><a href="{{url('/detail/'.$save->pastel->id)}}">タイトル：{{$save->pastel->title}}</a></div></li>
                    <li>
                    <div class="content-message">
                    <a href="{{url('/detail/'.$save->pastel->id)}}">
                        本文：{{ mb_substr(($save->pastel->message),0,20) }}
                        {{ mb_strlen($save->pastel->message)>20 ? '...' : '' }}
                    </a>
                    </div>
                    </li>
                    <li>
                    <div class="content-del">
                        <form action="{{ url('user/delete/'.$save->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn  btn-danger">削除</button>
                    </div>
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
    

    
  
  
  <!-- 現在の投稿 -->
  <!-- web.phpの/selectで飛んできたpastelsが入る -->
   @if (count($pastels) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">

    </div>
  </div>
  <div class="panel-body" style="max-width:800px; margin: 0 auto;">
    <table class="table table-striped task-table">
      <!-- 投稿ヘッダ -->
      <br><br>
      <div class="page-title">投稿一覧<img src="https://img.icons8.com/small/32/000000/message-squared.png"/></div>
     
      <div class="post-flexbox">
        {{-- @foreachで回して$pastels から＄pastelに値をそれぞれ入れる--}}
        @foreach ($pastels as $pastel)
          <div class="box-eachpost">
            <!-- 本タイトル -->
              <div class="img-content"><img src="{{ asset('/uploads/'.$pastel->pic_name) }}" alt="" style="max-width :200px; height: 100px;"></div>
            <!--<div class="table-text">-->
              <!-- $pastelの内容を表示 -->
              <!--<div style="font-weight:bold;">書き手:{{ $pastel->u_name }}</div>-->
              <div style="font-weight:bold;">タイトル:{{ $pastel->title }}</div>
              <div>開封日時:{{  substr(($pastel->open_time),0,16) }}</div>
                <a onclick="eventPanto({{ $pastel }})" class="place" style="text-decoration:none;">
              場所:{{ $pastel->open_place_name }}
              </a>
              <div>
            <form action="{{ url('user/'.$pastel->id) }}" method="POST">
            {{ csrf_field() }}
            
               <div style="font-size:8px;">公開設定
               @if($pastel->public == 0)
                 <input type="radio" name="public" value="0" checked> はい
                 <input type="radio" name="public" value=1 > いいえ
                 @endif
                 
                 @if($pastel->public == 1)
                 <input type="radio" name="public" value="0" > はい
                 <input type="radio" name="public" value=1 checked> いいえ
                 @endif
                 <input type="hidden" value="{{$pastel->id}}">
                 <button type="submit" class="btn  btn-danger edit-btn">変更</button>
              </div>
            </form>
          </div>
          <div>
            <form action="{{ url('user/'.$pastel->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn  btn-danger  del-btn">
              削除
            </button>
            </form>
          </div>
              <!--タグを表示させるループ処理-->
              @foreach ($pastel->tags as $tag) 　　　
              <div class="tag-content"><a href={{ url('/tag/'.$tag->id) }}>#{{$tag->tag_name}}</a></div>
              @endforeach
        
          </div>
        @endforeach
      </div>
    <!--</table>-->
  </div>
</div>
@endif
<!--ページネーション部分-->
<div class="page">
{{ $pastels->links('vendor.pagination.default')}}
</div>
<!--ここまで-->


</div>


@endsection
