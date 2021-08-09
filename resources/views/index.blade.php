    <!-- resources/views/index.blade.php	-->
@extends('layouts.app')
@section('content')
<!-- Bootstrap の定形コード… -->
<style>
      .ss {
        font-weight: bold;
      }
     .place {
      cursor: pointer;
     }
      a {
    text-decoration:none; 
      }
}
      
  /*瑞樹Css書いている部分----*/
.beige{
  background-color: beige; 
}
.note_wrap{
  background: #fff;
  padding: 1em 2em;
  width: 60%;
  margin: 30px auto;
  margin-top:200px;
  box-shadow: 5px 5px 20px 5px rgba(0,0,0,0.7);
}
.note{
  background-image:
    linear-gradient(
      180deg,
      rgba(0,0,0,0) 0%,
      rgba(0,0,0,0) 97%,
      #ddd 97%,
      #ddd 100%
    );
  background-size:100% 2em;
  line-height:2;
}
.note p{
  margin-bottom:2em;
}

.btn-stitch {
  display: inline-block;
  padding: 0.5em 1em;
  text-decoration: none;
  background: #668ad8;
  color: #FFF;
  border-radius: 4px;
  box-shadow: 0px 0px 0px 5px #668ad8;
  border: dashed 1px #FFF;
}

.btn-stitch:hover {
  border: dotted 1px #FFF;
}

.btn-stitch2 {
  cursor: pointer;
  display: inline-block;
  padding: 0.5em 1em;
  text-decoration: none;
  background:#E07530;
  color: #FFF;
  border-radius: 4px;
  box-shadow: 0px 0px 0px 5px  #E07530;
  border: dashed 1px #FFF;
}

.btn-stitch2:hover {
  border: dotted 1px #FFF;
}

  /*瑞樹Css書いている部分終わり----*/
  
  /*今村Css書いている部分----*/
.tagzone {
    display: flex;
    border: 1px solid;
    width:95%;
    padding: 10px 10px;
    margin: 0 auto;
    margin-top: 15px;
    color:black;
}

.tszone{
  display:flex;
  width:95%;
  margin: 0 auto;
  margin-top: 15px;
  margin-bottom:15px;
}

.tokouzone{
 margin-top:15p;
 border: 1px solid;
 width:25%;
 
}

<!--.toukouzone button{-->
<!-- padding-top:15px;-->
<!--}-->

.syutokuzone{
 border: 1px solid;
 width:75%;
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
    width: 28%;
    border: 1px solid
}

    .footer{

        height:50px; 
        padding:10px 0; 
        text-align: center;
    }
    
    .row{
    	justify-content: center;
	    align-items: center;
	    padding-top: 15px;
      }

img {
    max-width: 100%;
    object-fit: contain;
}

  /*今村Css書いている部分終わり----*/
  
  
  @media screen and ( max-width:479px )
{
	.post-flexbox{
		padding:  10px;
    display: flex; 
    flex-direction: column;
    text-align:center;
    
	}
	
	.box-eachpost {
    padding: 10px;
    margin-top:  10px;
    margin-left:20px;
    margin-right:20px;
    width: 90%;
    border: 1px solid
    }
}
      
      
</style>

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->


  
  <!--DOM操作時にしようするdivタグ-->
<div id="main">
  
  
<div class="panel-body">
  
  <!--タグ表示-->
  <!--ランダムでタグが表示される-->
  <div class="tagzone">
  @foreach ($tags as $tag)
    <div><a style="text-decoration:none;" href={{ url('/tag/'.$tag->id) }} class="m-2">#{{ $tag->tag_name}}</a></div>
  @endforeach
  </div>
  
  <div class="tszone">
  <div class="tokouzone">
  <div id ="fa"></div>
  <!--<div>投稿する</div>-->
  <button style="padding:10px; margin:15px;"><a href="{{ url('/edit') }}" style="text-decoration:none;">置きもちを書く</a></button>
  </div>
  <div class="syutokuzone">
  <div>取得状態（手紙を取得していればアイコン表示されます。）</div>
  <!--近くになったら手紙を入れるDIVタグ-->
  <div id ="target" class="beige"></div>
  </div>
  </div>

  <!--地図が入る-->
  <div id="mapDiv" style="height:500px; width:95%; margin:auto;"></div>
  <!--地図の中に画像を表示させるのに必要-->
  <img id="getImg" src="" hidden> 
  <!--近くの手紙が入る-->
  <canvas id="cap" width="300" height="60" style="display:none;"></canvas>
  

  <!-- 現在の投稿 -->
  <!-- web.phpの/selectで飛んできたpastelsが入る -->
  @if (count($pastels) > 0)
  <div class="panel panel-default">
    <div class="panel-heading">

    </div>
  </div>
  <div class="panel-body" style="max-width:800px; margin: 0 auto;">
    <!--<table class="table table-striped task-table">-->
      <!-- 投稿ヘッダ -->
      <br><br>
      <div style="font-size:28px;text-align: center;">投稿一覧<img src="https://img.icons8.com/small/32/000000/message-squared.png"/></div>
     
      <div class="post-flexbox">
        {{-- @foreachで回して$pastels から＄pastelに値をそれぞれ入れる--}}
        @foreach ($pastels as $pastel)
          <div class="box-eachpost">
            <!-- 本タイトル -->
              <img src="{{ asset('/uploads/'.$pastel->pic_name) }}" alt="" style="max-width :200px; height: 100px;">
            <!--<div class="table-text">-->
              <!-- $pastelの内容を表示 -->
              <div style="font-weight:bold;">書き手:{{ $pastel->u_name }}</div>
              <div style="font-weight:bold;">タイトル:{{ $pastel->title }}</div>
              <!--<div>開封日時:{{ $pastel->open_time}}</div>-->
                <a onclick="eventPanto({{ $pastel }})" class="place" style="text-decoration:none;">
              場所:{{ $pastel->open_place_name }}
              </a>
              <!--タグを表示させるループ処理-->
              @foreach ($pastel->tags as $tag) 　　　
              <div><a href={{ url('/tag/'.$tag->id) }}>#{{$tag->tag_name}}</a></div>
              @endforeach
          </div>
        @endforeach
      </div>
    <!--</table>-->
  </div>
</div>
@endif
<!--ページネーション部分-->
<div class="row">
{{ $pastels->links('vendor.pagination.default')}}
</div>
<!--ここまで-->

</div>
</div>


<!--jsにでーたおくるためのものです消さないでください！-->
<div style="display:none;">{{$keynum = Auth::user()->id}}</div>

<!--下記スクリプトタグはｊｓに必要なデータを送る処理-->
<script>
let toukou = @json($allpastels);
let keynum= {{$keynum}};
let mypastels = @json($mypastels);
</script>

<script src="{{ asset('/js/result.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=********************************************&libraries=geometry">
    </script>


@endsection
