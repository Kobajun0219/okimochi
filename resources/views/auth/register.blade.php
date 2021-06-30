@extends('layouts.app')

@section('content')

<style>
.logo{
    text-align: center;
    margin:5px;
}

.img_size{
    width:100%;
    max-width: 100%;
    height: auto;
}


</style>

<div class="container">
    
    
    <!--ロゴ-->
    <div class="logo"><img src="{{ asset('/image/logo.png') }}" alt="" class="img_size"></div>
    
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-transparent">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center">
<canvas id="myCanvas"></canvas>
    
</div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/105/three.min.js"></script>
 <script>
    // ページの読み込みを待つ
    window.addEventListener('load', init);

    function init() {
      // サイズを指定
      const width = 200;
      const height = 200;
      // レンダラーを作成
      const renderer = new THREE.WebGLRenderer({
        canvas: document.querySelector('#myCanvas'),
        alpha:true
      });
      renderer.setClearColor(0xffffff, 0);
      renderer.setPixelRatio(window.devicePixelRatio);
      renderer.setSize(width, height);
      // シーンを作成
      const scene = new THREE.Scene();
      // カメラを作成
      const camera = new THREE.PerspectiveCamera(45, width / height);
      camera.position.set(0, 0, +200);

      //3Dオブジェクト
      var x = 0, y = 0;
      var heartShape = new THREE.Shape();
      heartShape.moveTo(x + 5, y + 5);
      heartShape.bezierCurveTo(x + 5, y + 5, x + 4, y, x, y);
      heartShape.bezierCurveTo(x - 6, y, x - 6, y + 7, x - 6, y + 7);
      heartShape.bezierCurveTo(x - 6, y + 11, x - 3, y + 15.4, x + 5, y + 19);
      heartShape.bezierCurveTo(x + 12, y + 15.4, x + 16, y + 11, x + 16, y + 7);
      heartShape.bezierCurveTo(x + 16, y + 7, x + 16, y, x + 10, y);
      heartShape.bezierCurveTo(x + 7, y, x + 5, y + 5, x + 5, y + 5);
      var geometry = new THREE.ShapeBufferGeometry(heartShape);
      var material = new THREE.MeshBasicMaterial({ color: '#FF00FF' });
      var obj1 = new THREE.Mesh(geometry, material);
      scene.add(obj1);
      tick();

      // 毎フレーム時に実行されるループイベント
      function tick() {
        // objをx軸に少しずつ回す
        obj1.rotation.x += 0.01;
        // objをy軸に少しずつ回す
        obj1.rotation.y += 0.01;

        renderer.render(scene, camera); // レンダリング
       
        requestAnimationFrame(tick);
      }
    }
  </script>
@endsection
