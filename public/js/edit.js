// 下記マップ出現、ドロップ処理-------------------
var getMap = (function() {
      function codeAddress(address) {
        // google.maps.Geocoder()コンストラクタのインスタンスを生成
        var geocoder = new google.maps.Geocoder();
console.log('hello');
        // 地図表示に関するオプション
        var mapOptions = {
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
          
        };

        // 地図を表示させるインスタンスを生成
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        //マーカー変数用意
        var marker;
  console.log('mizuki');
        // geocoder.geocode()メソッドを実行
        geocoder.geocode( { 'address': address}, function(results, status) {
          console.log('mizukisan');

          // ジオコーディングが成功した場合
          if (status == google.maps.GeocoderStatus.OK) {

            // 変換した緯度・経度情報を地図の中心に表示
            map.setCenter(results[0].geometry.location);

            //☆表示している地図上の緯度経度
            document.getElementById('lat').value=results[0].geometry.location.lat();
            document.getElementById('lng').value=results[0].geometry.location.lng();

            // マーカー設定
            marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });

          // ジオコーディングが成功しなかった場合
          } else {
            console.log('Geocode was not successful for the following reason: ' + status);
          }

        });

        // マップをクリックで位置変更
        map.addListener('click', function(e) {
          console.log('agagaga');
          getClickLatLng(e.latLng, map);
        });
        function getClickLatLng(lat_lng, map) {

          //☆表示している地図上の緯度経度
          document.getElementById('lat').value=lat_lng.lat();
          document.getElementById('lng').value=lat_lng.lng();

          // マーカーを設置
          marker.setMap(null);
          marker = new google.maps.Marker({
            position: lat_lng,
            map: map
          });

          // 座標の中心をずらす
          map.panTo(lat_lng);
        }

      }

      //inputのvalueで検索して地図を表示
      return {
        getAddress: function() {
          // ボタンに指定したid要素を取得
          var button = document.getElementById("map_button");
          // ボタンが押された時の処理
          button.onclick = function() {
            // フォームに入力された住所情報を取得
            var address = document.getElementById("address").value;
            // 取得した住所を引数に指定してcodeAddress()関数を実行
            console.log(address);
            codeAddress(address);
          }

          //読み込まれたときに地図を表示
          window.onload = function(){
            // フォームに入力された住所情報を取得
            var address = document.getElementById("address").value;
            console.log('ここは動いているよ');
            // 取得した住所を引数に指定してcodeAddress()関数を実行
            codeAddress(address);
              
          }
        }

      };

    })();
    getMap.getAddress();
    
    
   
   //下記ドラッグアンドドラップの処理-----------------------
   
let fileArea = document.getElementById('dragDropArea');
let fileInput = document.getElementById('fileInput');
// たされた時のクリックイベントの付与
fileArea.addEventListener('dragover', function (evt) {
  evt.preventDefault();
  fileArea.classList.add('dragover');
});
//取り除いたときのクリックイベントの付与
fileArea.addEventListener('dragleave', function (evt) {
  evt.preventDefault();
  fileArea.classList.remove('dragover');
});
  // ドロップ後の付与
fileArea.addEventListener('drop', function (evt) {
  evt.preventDefault();
  fileArea.classList.remove('dragenter');
  let files = evt.dataTransfer.files;
  console.log("DRAG & DROP");
  console.table(files);
  fileInput.files = files;
  photoPreview('onChenge', files[0]);
});
  
  // 写真の表示処理
function photoPreview(event, f = null) {
  let file = f;
  if (file === null) {
    file = event.target.files[0];
  }
  let reader = new FileReader();
  let preview = document.getElementById("previewArea");
  let previewImage = document.getElementById("previewImage");

  if (previewImage != null) {
    preview.removeChild(previewImage);
  }
  reader.onload = function (event) {
    let img = document.createElement("img");
    img.setAttribute("src", reader.result);
    img.setAttribute("id", "previewImage");
    preview.appendChild(img);
  };

  reader.readAsDataURL(file);
}
 
    
    
    