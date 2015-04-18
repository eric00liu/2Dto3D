<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

if (isset($_REQUEST['code'])) {
    $keys = array();
    $keys['code'] = $_REQUEST['code'];
    $keys['redirect_uri'] = WB_CALLBACK_URL;
    try {
        $token = $o->getAccessToken( 'code', $keys ) ;
    } catch (OAuthException $e) {
    }
}

if ($token) {
    $_SESSION['token'] = $token;
    setcookie( 'weibojs_'.$o->client_id, http_build_query($token) );
//   var_dump($token);
//    echo $token["uid"];
    $url = $_SERVER["HTTP_REFERER"] . "?uid=" . $token["uid"] . "&access_token=" . $token["access_token"];
//    echo $_SERVER["HTTP_REFERER"] . "adfadfadsfwe";
    echo $url;
    header("location: ".$url);
}else {
}
?>
