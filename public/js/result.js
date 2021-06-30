//非公開データと公開データを結合させる
toukou = toukou.concat(mypastels);



var mapDiv = document.getElementById("mapDiv");     // 地図を置く場所
var gmap;  　                                       // Googleマップの Map オブジェクトのための変数
var mark;                                           // Googleマップの Marker オブジェクトのための変数

                                 // ★投稿の情報を入れる変数
var captured = [];                                  // ★投稿を取得済みか否かを入れる変数
                               // ★投稿の情報を読み込む（緯度軽度）
var getImg = document.getElementById("getImg");     // ★img要素の取得
var canvas = document.getElementById("cap");        // ★取得済投稿を入れるcanvas要素の取得
var context = canvas.getContext("2d");              // ★contextの取得
context.fillStyle = "rgb(153, 217, 234)";           // ★塗りつぶす色をターコイズにする
context.fillRect(0, 0, 300, 60);                    // ★canvasを塗りつぶす

// GPS センサの値が変化したら何らか実行する geolocation.watchPosition メソッド
navigator.geolocation.watchPosition((position) => {
    var lat = position.coords.latitude;            // 緯度を取得
    var lng = position.coords.longitude;           // 経度を取得
    var accu = position.coords.accuracy;            // 緯度・経度の精度を取得
    showMyPos(lat, lng);                            // showMyPos 関数を実行
    calcDistance(lat, lng);
});

// 自分の位置を表示する showMyPos 関数
function showMyPos(lat, lng) {
    var myPos = new google.maps.LatLng(lat, lng);   // Googleマップの LatLng オブジェクトを作成
    gmap.setCenter(myPos);                          // gmap の中心を myPos の位置にする
    mark.setPosition(myPos);                        // mark の位置を myPos にする
}

// 地図の初期化
function initMap() {
    // 1回だけ現在位置を測定する getCurrentPosition メソッド
    navigator.geolocation.getCurrentPosition((position) => {
        var lat = position.coords.latitude;         // 緯度を取得
        var lng = position.coords.longitude;        // 経度を取得
        var initPos = new google.maps.LatLng(lat, lng); // 初期位置を指定
        gmap = new google.maps.Map(mapDiv, {        // Map オブジェクトを作成して mapDiv に表示
            center: initPos,                        // 地図の中心を initPos に設定
            zoom: 16,// ズーム倍率
            styles://Mapのデザイン変更
        [
    {
        "featureType": "administrative",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "-100"
            },
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "administrative.province",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 65
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": "50"
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": "-100"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "all",
        "stylers": [
            {
                "lightness": "30"
            }
        ]
    },
    {
        "featureType": "road.local",
        "elementType": "all",
        "stylers": [
            {
                "lightness": "40"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ffff00"
            },
            {
                "lightness": -25
            },
            {
                "saturation": -97
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "lightness": -25
            },
            {
                "saturation": -100
            }
        ]
    }
]
        });
        mark = new google.maps.Marker({             // Marker オブジェクトを作成
            map: gmap,                              // gmap の上に表示する
            position: initPos,                      // initPos の位置に
        });
        placeMermaids();                            // ★投稿を配置する
    }, (error) => {                                 // エラー処理（今回は特に何もしない）
    }, {
        enableHighAccuracy: true                    // 高精度で測定するオプション
    });
}



// ★投稿を地図上に配置する placeMermaids 関数
function placeMermaids() {
    var toukouMark = []; // 投稿マーカーの配列
    var toukouInfo = [];
    for (var i = 0; i < toukou.length; i++) {      // 全ての投稿について
        var pos = new google.maps.LatLng(toukou[i].open_place_latitude, toukou[i].open_place_longitude); // 投稿の位置を設定
       //自分の手紙かどうかの条件分岐
        if(toukou[i].u_id == keynum) {
        var img = {                                 // 画像の設定
            url: "https://oki-mochi.herokuapp.com/image/1.jpeg",        
            scaledSize: new google.maps.Size(60, 60)    // 画像を縮小表示
        };
        } else {
            var img = {                                 // 画像の設定
            url: "https://oki-mochi.herokuapp.com/image/0.png",        
            scaledSize: new google.maps.Size(60, 60)    // 画像を縮小表示
        };
}
      //投稿マークを作成
        toukouMark[i] = new google.maps.Marker({   // 投稿のマーカーを作成
            map: gmap,                              // gmap の上に表示する
            position: pos,                          // pos の位置に
            icon: img,                              // アイコンを設定
            title: toukou[i].open_place_name// タイトルを設定
        });
        //円オブジェクトを作成
        circle = new google.maps.Circle({
         center: pos,
         map: gmap ,
         radius: 50 , // 半径（m）
         fillColor: '#6c757d',   // 塗りつぶし色
         fillOpacity: 0.2,  // 塗りつぶし透過度（0: 透明 ⇔ 1:不透明）
         strokeColor: '#000000',  // 外周色
         strokeOpacity: 1, // 外周透過度（0: 透明 ⇔ 1:不透明）
         strokeWeight: 5  // 外周太さ
        });
        
        //吹き出しを作成する関数。吹き出しの文言を変化させたいのであればここ。
        toukouInfo[i] = new google.maps.InfoWindow({
        content: `
        <p>タイトル　${toukou[i].title}</p><br>
        <p>書き手　${toukou[i].u_name}</p><br>
        <p>場所　${toukou[i].open_place_name}</p>
        `,
        maxWidth: 200
    });

        captured[i] = false;  // 取得済み状態を全てfalseにする
        
        hoverEvent(toukouInfo[i],toukouMark[i]);
        
    }
}

// ★自分と投稿との距離を計算する calcDistance 関数
function calcDistance(open_place_latitude, open_place_longitude) {
    let count = 0;
    var distance = [];                              // 距離を入れる配列
    var myPos = new google.maps.LatLng(open_place_latitude, open_place_longitude);   // Googleマップの LatLng オブジェクトを作成
    for (var i = 0; i < toukou.length; i++) {      // 全ての投稿について
        var pos = new google.maps.LatLng(toukou[i].open_place_latitude, toukou[i].open_place_longitude);                 // 投稿の位置を設定
        distance[i] = google.maps.geometry.spherical.computeDistanceBetween(myPos, pos);    // 距離を求める
        // 取得の判定と取得した時のエフェクト
        if (distance[i] < 50 && captured[i] === false) {  // 距離が20m未満、かつ、まだ取得していないなら
            count++;
            let keydata = toukou[i];
            let imgDiv = document.createElement('img');
            imgDiv.width = 60;
            imgDiv.height = 60;
            imgDiv.setAttribute("id",count);
            imgDiv.src = "https://oki-mochi.herokuapp.com/image/0.png";
            document.getElementById('target').append(imgDiv);
            captured[i] = true;                                 // 取得済にする
        addEvent(count,toukou[i]);
        }
    }
}

    //DOM操作で近くに来た手紙を出現させる関数。
function addEvent(id,data) {
    document.getElementById(id).addEventListener('click',() => {
        document.getElementById('main').innerHTML = '';
        let targetDiv = document.createElement('div');
        targetDiv.innerHTML =  `
        <div class="note_wrap">
    <div class="note">
      <h5>${data['who']}へ</h5>
      <h5>題名　「${data['title']}」</h5>
      <p>${data['message']}</p>
      <h5 align="right">${data['u_name']}より</h5>
    </div>
     <div style="text-align: center;　margin-top: 50px;">
    <img src=/uploads/${data['pic_name']} alt="" style="width: 200px; height: 200px;">
    </div>

  </div>
        
        <div class="d-flex justify-content-center align-items-center">
        <a class="btn-stitch2 m-2" onclick="window.location.reload()";>戻る</a>
        <a href="https://oki-mochi.herokuapp.com/save/${data['id']}" class="btn-stitch m-2">お気に入りに追加</a>
        </div>

        `;
        document.getElementById('main').append(targetDiv);
    })
}


//吹き出しをプラスする関数
function hoverEvent(data,keydata) {
  
      keydata.addListener('mouseover',()=> {
             data.open(gmap,keydata);
        });
        keydata.addListener('mouseout', ()=> {
            data.close();
        });
}

//場所をクリックしたら地図の場所が変わる関数
function eventPanto(data) {
    console.log('dsd');
     let xPlace = data['open_place_latitude'];
     let yPlace = data['open_place_longitude'];
    var targetPlace = new google.maps.LatLng(xPlace, yPlace);
    gmap.panTo(targetPlace);
    
}