<?php
	
/*
accepts variable $message
*/
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
include($server['root']['path'].'resources/authoring/newAuthEnvironment.server.php');

//find PID for the request
include($server['root']['path'].'resources/config/pid.cfg');

$pid='unk';
if (strpos($_SERVER['REQUEST_URI'], 'pid=')):
	$start=strpos($_SERVER['REQUEST_URI'], 'pid=')+4;
	if ( strpos($_SERVER['REQUEST_URI'], '&',strpos($_SERVER['REQUEST_URI'], 'pid=')) ):
		$end=(strpos($_SERVER['REQUEST_URI'], '&',strpos($_SERVER['REQUEST_URI'], 'pid='))-(strpos($_SERVER['REQUEST_URI'], 'pid=')+4));
	else:
		$end=strlen($_SERVER['REQUEST_URI'])-$start;
	endif;
		
	$pid=substr($_SERVER['REQUEST_URI'], $start, $end);
endif;


//$link= "AjxSendAuth('".$pid.",".$realm.",".$nonce.",".$opaque.",".$serverTime."');";
$code='';
$params=''; //foram todos guardados na $_session var	
$DestinationID='Dialogs'; // html ID where to deploy contents on client browser 

$HtmlDlgAuth=file_get_contents($server['root']['path'].'resources/authoring/ConnectionIDrequiered.html');
$photo='../resources/authoring/graphics/noPhoto.jpg';

if ($username<>''): // var from newAuthEnvironment.server.php
	//check if username is present on DB and load token
	include($server['root']['path'].'resources/config/database.cfg');
		
	$db->connect(true);
	$query=$db->getquery("select 'ContactID', 'nome', 'morada', 'contactos' from Contacts where contactID='".$username."'");
	$db->connect(false);
	if ($query[0][0]==''):
		$details='';
	else:
		$details=$query[0][1].'</br>'.$query[0][2].'</br>';
		$photo= (is_file($server['root']['path'].'store/'.$username.'/graphics/passportPhoto.jpg')) ? $server['root']['path'].'store/'.$username.'/graphics/passportPhoto.jpg' : $photo;
	endif;
else:
	$contactID='';
	$details='';
endif;

$HtmlDlgAuth=str_replace("{contactID}", $contactID, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{details}", $details, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{photo}", $photo, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{link}", $link, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{errors}", $message, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{randomString}", $RndStr, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{realm}", $realm, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{serverTime}", $serverTime, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{opaque}", $opaque, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{pid}", $pid, $HtmlDlgAuth);
$HtmlDlgAuth=str_replace("{nonce}", $nonce, $HtmlDlgAuth);
	
$ScriptCode=str_replace("{DestinationID}", $DestinationID, $ScriptCode);
$ScriptCode=str_replace("{params}", $params, $ScriptCode);
$ScriptCode=str_replace("{type}", "CID", $ScriptCode);

$code.=$HtmlDlgAuth.$ScriptCode;

$ContentSize=strlen($code);
header('Content-Type: text/html');
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
exit;
?>