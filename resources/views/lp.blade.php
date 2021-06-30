<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>oki-Mochi</title>
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  
  <!--google font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">


  <style>
     body{
      background-image:url({{asset('image/bg.png')}});
      background-repeat: repeat-y;
      background-size: contain;
    }
    main{
    background-image: url({{asset('image/IMG_5570.jpg')}});
    }
  </style>


</head>

<body>


 <main>
  <div class="box">
    <img class="logo" src="{{asset('image/logo2.png')}}"> 
    <h1>今の気持ちを、未来の場所に「置き手紙」</h1>
  </div>
 </main>



<!-- ーーーーーーーーーーーコンセプトーーーーーーー -->
 <div class="consept">

   <div class="consept-container">
     <div class="textbox">
    <h>
    空間軸×時間軸をコンセプトにした<br>
    置き手紙アプリ『oki-Mochi』<br><br>


    挑戦するときも、<br>
    環境を変えるときも、<br>
    想いがあるなら、置けばいい。<br>
     </h>
    </div>
   </div>


 <div class="how">

  <diV class="img-contents">
   <diV class="img1">
      <img src="{{asset('image/write.png')}}" width="45%" >
      <div class="how-detail">

      <p>「残したい今の気持ち。」<br>
      「未来に向けた気持ち。」<br>
      「誰かに繋げたい気持ち。」<br>
      　をかきおこし
      </p>
      </div>
   </diV>

   <diV class="img2">
      <img src="{{asset('image/map-sample.png')}}" width="45%">
    <div class="how-detail">

      <p>思い出の場所へ<br>
      置手紙を残し
          </p>
    </div>
   </diV>

    <div class="img3">
        <img src="{{asset('image/toshi.png')}}" width="45%">
        <p>時間の経過とともに<br>
        ふとした時に<br>
        想いを振り返る。
            </p>
    </div>
       

   </div>
    <div class="button"><a class="btn btn--orange btn--radius" href="{{asset('/')}}">はじめる</a></div>
  
  </div>

 </div>
 


</div>
 <!-- ーーーーーーーーーーーwhatーーーーーーー-->

</body>


</html>