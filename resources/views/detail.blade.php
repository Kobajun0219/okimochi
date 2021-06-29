
<!-- resources/views/sbds.blade.php	-->
@extends('layouts.app')
@section('content')
<!-- Bootstrap の定形コード… -->
  <style>
    
    body{
  background-color: beige; 
}
.note_wrap{
  background: #fff;
  padding: 1em 2em;
  width: 60%;
  margin: 30px auto;
  margin-top:50px;
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



.btn-stitch2 {
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


  </style>
<!--<div class="panel-body">-->

  <!-- バリデーションエラーの表示に使用-->
  @include('common.errors')
  <!-- バリデーションエラーの表示に使用-->
  <div id="clock" class="d-flex justify-content-center align-items-center">
  </div>
<div class="note_wrap">
    <div class="note">
      <h5>{{$pastels->who}} へ</h5>
      <h5>題名　「{{$pastels->title}}」</h5>
      <p>{{ $pastels->message }}</p>
      <h5 align="right">{{ $pastels->u_name }}より</h5>
    </div>
     <div style="text-align: center; margin-top: 50px;">
    <img src="{{ asset('/uploads/'.$pastels->pic_name) }}" alt="" style="width: 200px; height: 200px;">
    </div>
  </div>
  
  <div class="d-flex align-items-center justify-content-center">
    <a class="btn-stitch2 m-2" href="{{ url('user/') }}";>戻る</a>
  </div>
  
  <!-- web.phpの/selectで飛んできたpastelsが入る -->
    <!--<div id='container'></div>-->
 
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/three.js/r61/three.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tween.js/16.0.0/Tween.min.js"></script>
   

  <script>
  
   document.addEventListener('DOMContentLoaded', function(){

      let clock =  document.getElementById('clock');
        var width = 200, height = 200;
        var angle = 45, aspect = width / height, near = 0.1, far = 10000;



      
        var scene = new THREE.Scene();
        var camera = new THREE.PerspectiveCamera(angle, aspect, near, far);
        var renderer = new THREE.WebGLRenderer();

        var light = new THREE.SpotLight(0xFFFFFF, 1);
        var material = new THREE.MeshLambertMaterial({ color: 0xFFFFFF });
        var red = new THREE.MeshLambertMaterial({ color: 0xFF0000 });
        var grey = new THREE.MeshLambertMaterial({ color: 0x222222 });

        var geometry = new THREE.CylinderGeometry(20, 21, 4, 48, 1, false);
        var dial = new THREE.Mesh(geometry, material);

        var geometry = new THREE.CubeGeometry(5, 2, 1);
        geometry.applyMatrix(new THREE.Matrix4().makeTranslation(18, 0, 0));
        var mark = new THREE.Mesh(geometry, grey);

        var geometry = new THREE.CubeGeometry(15, 1, 2);
        geometry.applyMatrix(new THREE.Matrix4().makeTranslation(15, 0, 0));
        var second = new THREE.Mesh(geometry, red);

        var geometry = new THREE.CubeGeometry(12, 1, 3);
        geometry.applyMatrix(new THREE.Matrix4().makeTranslation(15, 0, 0));
        var minute = new THREE.Mesh(geometry, material);

        var geometry = new THREE.CubeGeometry(10, 1, 4);
        geometry.applyMatrix(new THREE.Matrix4().makeTranslation(15, 0, 0));

        var hour = new THREE.Mesh(geometry, material);



        
        dial.position.x = 0;
        dial.position.y = -3;
        dial.position.z = 0;

        mark.position.x = 0;
        mark.position.y = -1.5;
        mark.position.z = 0;

        second.position.x = 0;
        second.position.y = 0;
        second.position.z = 0;

        minute.position.x = 0;
        minute.position.y = 1;
        minute.position.z = 0;

        hour.position.x = 0;
        hour.position.y = 2;
        hour.position.z = 0;

        light.position.x = 0;
        light.position.y = 100;
        light.position.z = 0;
        light.lookAt(dial.position);

        camera.position.z = 40;
        camera.position.y = 40;
        camera.lookAt(dial.position);


     
        scene.add(camera);
        scene.add(light);
        scene.add(dial);
        scene.add(mark);
        scene.add(second);
        scene.add(minute);
        scene.add(hour);


 
        renderer.shadowMapEnabled = true;

        light.castShadow = true;
        light.shadowCameraNear = 1.0;
        light.shadowDarkness = 0.5;

        dial.castShadow = true;
        dial.receiveShadow = true;

        mark.castShadow = true;
        mark.receiveShadow = true;

        second.castShadow = true;
        second.receiveShadow = true;

        minute.castShadow = true;
        minute.receiveShadow = true;

        hour.castShadow = true;
        hour.receiveShadow = true;


   
        var now = new Date();
        hour.rotation.y = -((Math.PI * 2) * (now.getHours() / 12.0))
        minute.rotation.y = -((Math.PI * 2) * (now.getMinutes() / 60.0))
        second.rotation.y = -((Math.PI * 2) * (now.getSeconds() / 60.0))
        camera.rotation.z = second.rotation.y


 
        renderer.setSize(width, height);
        clock.appendChild(renderer.domElement);

        var rotation_start = { angle: now.getSeconds() };
        var rotation_end = { angle: rotation_start.angle + 1 };

   
        var tween1 = new TWEEN.Tween(rotation_start).to(rotation_end, 1000)
          .easing(TWEEN.Easing.Elastic.InOut)
   
          .delay(0)
          .onUpdate(function () {
            second.rotation.y = -((Math.PI * 2) * (this.angle / 60.0));
          })
          .onComplete(function () {
            rotation_start.angle = new Date().getSeconds();
            rotation_end.angle = rotation_start.angle + 1;

          })
          .start()

        tween1.chain(tween1);


        var update = function () {
          
          minute.rotation.y -= 0.0018 / 60;
          hour.rotation.y -= 0.0018 / 60 / 12;
          camera.rotation.z -= 0.0018;
        
          TWEEN.update();
        };


        var animate = function () {
          update();

          requestAnimationFrame(animate);
          renderer.render(scene, camera);
        };
        animate();
      });
  </script>
 

@endsection