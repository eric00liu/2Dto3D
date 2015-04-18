<?php
	session_start();

	include_once( 'config.php' );
	include_once( 'saetv2.ex.class.php' );

	$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

	$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
        $token = $_REQUEST['access_token'];
       
         $c = new SaeTClientV2( WB_AKEY , WB_SKEY , $token );
         $ms  = $c->home_timeline(); // done
         $uid_get = $c->get_uid();
         $uid = $uid_get['uid'];
         $user_message = $c->show_user_by_id($uid);//根据ID获取用户等基本信息


//function get_uid($token) {
//        $url="https://api.weibo.com/2/account/get_uid.json?source=". WB_AKEY . "&access_token=$_SESSION['token']";
//        $html = file_get_contents($url);
//        echo $html;
//}
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
  </head>
  <body>
    <style>
      body {
        padding-top: 70px;
        font-family: "Open Sans", Arial, "Hiragino Sans GB", "Microsoft YaHei", "微软雅黑", "STHeiti", "WenQuanYi Micro Hei", SimSun, sans-serif;
      }
      .cv-show{
        text-align: center;
      }
      .cv-show img {
        margin-left: 20px;
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
	<div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">ABOUT</a></li>
<?php
//var_dump($user_message);
if (0) {  
?>
	    <li><a href="<?php echo $code_url?>"><img height="23" src="dist/img/32.png" /></a></li>
<?
} else {
?>
	   <li><a> <?php echo $user_message["screen_name"] ?> </a></li> 
<?php 

}
?>
          </ul>
	</div>
      </div>
    </div>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>原理简介</h1>
        <p></p>
	<p><img src="http://p3.pstatp.com/large/1556/3066669883"></p>
	<p>上图为理想情况下的“3D”处理，仅仅在GIF图像序列中添加两条白线，就可以让人感受到意想不到的3D效果。</p>
	<p>这类GIF图像一般有如下的特点：1）主体从远景向近景移动；2）有左右方向上一定的角度变化。</p>

	<p>我们小组希望基于图像序列的背景建模来自动化生成这类结果。</p>
        <p>
	    <form action="upload_file.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputFile">选择要上传视频文件</label>
		  <input type="file" name="file" id="file" />
                  <p class="help-block">文件大小不能超过20MB</p>
                  <input class="btn btn-lg btn-primary cv-upload" type="submit"  value="上传" />
                </div>
            </form>
        </p>
      </div>

    </div> <!-- /container -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="dist/js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="dist/js/flat-ui.min.js"></script>

   <!-- <script src="../assets/js/application.js"></script>-->

  </body>
</html>
