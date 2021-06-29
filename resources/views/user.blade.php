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



</style>

<!-- Bootstrap の定形コード… -->
<div class="panel-body">

    <div class="title"><p>お気に入り投稿一覧</p><div>
    <div class="content-wrapper">
        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')

        <!-- テーブルヘッダ -->
        @foreach ($saves as $save)
            <div class="container save-container">
                <div><img src="{{ asset('/uploads/'.$save->pastel->pic_name) }}" alt="" style="width: 100px; height: 100px;"></div>
                <ul>
                    <li><div class="content-user"> {{$save->pastel->who}}</div></li>
                    <li><div class="content-title"><a href="{{url('/detail/'.$save->pastel->id)}}">{{$save->pastel->title}}</a></div></li>
                    <li>
                    <div class="content-message">
                    <a href="{{url('/detail/'.$save->pastel->id)}}">
                        {{ mb_substr(($save->pastel->message),0,20) }}
                        {{ mb_strlen($save->pastel->message)>20 ? '...' : '' }}
                    </a>
                    </div>
                    </li>
                    <li><div class="content-date">{{ substr(($save->created_at),0,11) }}</div></li>
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
  <div class="panel-body">
    <table class="table table-striped task-table">
      <!-- テーブルヘッダ -->
      <div>投稿一覧</div>
      <thead>
        <th>写真</th>
        <th>ユーザー名</th>
        <th>タイトル</th>
        <th>手紙の公開日時</th>
        <th>公開設定</th>
        <th>削除</th>
      </thead>
      <!-- テーブル本体 -->
      <tbody>
        {{-- @foreachで回して$pastels から＄pastelに値をそれぞれ入れる--}}
        
        @foreach ($pastels as $pastel)
       
        <tr>
          <!-- 本タイトル -->
          <td>
            <img src="{{ asset('/uploads/'.$pastel->pic_name) }}" alt="" style="width: 100px; height: 100px;">
          </td>
          <td class="table-text">
            <!-- $sbdの内容を表示 -->
            <div>{{ $pastel->u_name }}</div>
          </td>
          <td>
            <div>{{ $pastel->title }}</div>
          </td>
          <td>
            <div>{{ $pastel->open_time}}</div>
          </td>
          <td>
            <form action="{{ url('user/'.$pastel->id) }}" method="POST">
            {{ csrf_field() }}
            
               <div>公開設定
               @if($pastel->public == 0)
                 <input type="radio" name="public" value="0" checked> はい
                 <input type="radio" name="public" value=1 > いいえ
                 @endif
                 
                 @if($pastel->public == 1)
                 <input type="radio" name="public" value="0" > はい
                 <input type="radio" name="public" value=1 checked> いいえ
                 @endif
                 <input type="hidden" value="{{$pastel->id}}">
                 <button type="submit" class="btn  btn-danger">変更</button>
              </div>
            </form>
          </td>
          <td>
            <form action="{{ url('user/'.$pastel->id) }}" method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn  btn-danger">
              削除
            </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endif

</div>

@endsection
