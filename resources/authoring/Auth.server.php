<?php
//Google recaptcha verification

/*
	client site key: 6LdYhR8TAAAAAJNdz8ocmgdPh3C1maHmNBgFSAwZ
	secret key: 6LdYhR8TAAAAANJXRexncGJCrXHPOOlZBsJmm3o7
	value of variable "g-recaptcha-response"
	url to send verification: https://www.google.com/recaptcha/api/siteverify
	optional client user IP:
*/
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');

$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
include($server['root']['path'].'resources/config/authoring.cfg');	
include_once($server['root']['path'].'resources/authoring/auth.lib.php');

// Partial start session environment
session_cache_expire (5);// 5 min
session_cache_limiter('private');

$valid = false;
$failCaptcha=false;
// submit form auth requiered
if (isset($_POST['response']) and isset($_POST['response2']) ):
	// load auth environment
	include($server['root']['path'].'resources/authoring/loadAuthEnvironment.server.php');
	//verify captcha human verification
	include($server['root']['path'].'resources/authoring/recaptchaAuth.server.php'); // var boolean $failCaptcha is avail for eval after
else:
	$message='';
	include($server['root']['path'].'resources/authoring/TrowAuthRequest.server.php'); //accepts var $msg
	exit;
endif;

if (!$valid or $failCaptcha !=false):
	$img='../resources/authoring/graphics/notValidated.png';
	$html=file_get_contents($server['root']['path'].'resources/dialogs/DlgError.html');
	$html=str_replace("{message}","O acesso não foi validado.<br> Colocou correctamente o TokenID? <br>...e o ContactID ?<br>".$err, $html);
	$html=str_replace("{image}",$img, $html);
	
	$code=$html;
	
	$ContentSize=strlen($code);
	header('Content-Type: text/html');
	header ( "Pragma: no-cache" );
	header ( "Cache-Control: no-cache" );
	header("Content-Length: ".$ContentSize);//set header length
	echo $code;
	session_write_close();
	exit;
endif;

// echo 'You can now see this super restricted area.';

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>