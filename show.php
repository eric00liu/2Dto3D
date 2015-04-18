<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );
$weibo_info = explode('&', $_COOKIE["weibojs_771999226"]);
$token = explode('=',$weibo_info[0])[1]; 


$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token);
$ms  = $c->home_timeline(); // done
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);//根据ID获取用户等基本信息

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>视频3D处理-CV浪人</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="dist/img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="../../dist/js/vendor/html5shiv.js"></script>
      <script src="../../dist/js/vendor/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript" charset="utf-8">
var previous_response_length = 0
var re = /"hello","(.*?)"/gmi;
var img_src = 'http://placehold.it/500x300&text='
xhr = new XMLHttpRequest()
xhr.open("GET", "http://omgm4j.com:7379/SUBSCRIBE/hello", true);
xhr.onreadystatechange = checkData;
xhr.send(null);

function checkData() {
    if(xhr.readyState == 3)  {
        response = xhr.responseText;
        chunk = response.slice(previous_response_length);
        previous_response_length = response.length;
        console.log(chunk);
        if(re.test(chunk)){
            console.log(RegExp.$1);
            img_src += '['+RegExp.$1+']'
            $("#cv-res").attr('src', img_src)
        }
    }
};
</script>
  </head>
  <body>
    <style>
      body {
        min-height: 2000px;
        padding-top: 70px;
        font-family: "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif;
      }
      .cv-show{
        text-align: center;
      }
      .cv-show img {
        margin-left: 20px;
      }
      .cv-share{
	text-align: center;
	margin-top: 20px;
      }
    </style>

    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand" href="#">视频3D处理-CV浪人</a>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </div>
      </div>
    </div>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->

      <div class="cv-show">
          <h3>结果对比  </h3>
	<img id="cv-res" src="http://www.omgm4j.com/3d/upload/ori.gif" width="500" height="300" >
	<img id="cv-res" src="http://www.omgm4j.com/3d/trans/pro.gif" width="500" height="300" >
      </div>
	
      <div class="cv-share">
      <form action="" >
                <input type="text" name="text" style="width:300px" value="http://omgm4j.com/3d"/>
                <input type="submit" value="分享到微博"/>
        </form> 
      </div>








<?php var_dump($weibo_info)?>

    </div> <!-- /container -->





    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/flat-ui.min.js"></script>


  </body>
</html>
