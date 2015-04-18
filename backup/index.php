<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<html>
<body>
   <p><a href="<?=$code_url?>"><img src="weibo_login.png" title="�~B��~G��~[�~E��~N~H�~]~C页�~]�" alt="�~B��~G��~[�~E��~N~H�~]~C页�~]�" border="0" /></a><//
p>

<form action="upload_file.php" method="post" enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file" /> 
<br />
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>
