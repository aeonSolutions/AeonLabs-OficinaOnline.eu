<?php
if (isset($_GET['cfg'])):
	$cfg=$_GET['cfg'];
else:
	exit('missing var');
endif;

$code='helper';
$ContentSize=strlen($code);
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
?>