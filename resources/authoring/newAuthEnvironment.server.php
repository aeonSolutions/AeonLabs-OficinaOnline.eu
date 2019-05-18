<?php
/*
accepts variable $pid
returns variable $username
*/
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
include($server['root']['path'].'resources/config/authoring.cfg');	
include_once($server['root']['path'].'resources/authoring/auth.lib.php');

$nonce = bin2hex(openssl_random_pseudo_bytes( rand(32, 64) ));
$opaque = bin2hex(openssl_random_pseudo_bytes( rand(32, 64) ));
$RndStr= bin2hex(openssl_random_pseudo_bytes( rand(32, 64) ));

//string to be hashed by the client and verified on the next step by server 
$realm = GenerateRealmKey(120). ':www.oficinaonline.eu'; 
$serverTime=intval(microtime(true));

$newSession = GenerateRealmKey(40);
$nonceSessVar= substr($nonce, 0, 39);


// store on DEFAULT SESSION ID the SESSIONS ID and Token handlers
session_id($default_SessionID);
session_start();
if (!isset($_SESSION[$nonceSessVar])):
	$_SESSION[$nonceSessVar]=$newSession; // response or rnd key
else:
	$nonce = bin2hex(openssl_random_pseudo_bytes( rand(32, 64) ));
	$nonceSessVar= substr($nonce, 0, 39);
	$_SESSION[$nonceSessVar]=$newSession; // response or rnd key
endif;

sleep(1);
session_write_close();

// Set session ID to the new one, and start it back up again
session_regenerate_id(true);
$_SESSION=array();
session_write_close();
session_id($newSession);
session_start();

	// Set current session to expire in 5 minute
$_SESSION['OBSOLETE'] = true;
$_SESSION['EXPIRES'] = time() + 60*5;

$_SESSION['nonce']=$nonce;
$_SESSION['nonce2']=$nonceSessVar;
$_SESSION['opaque']=$opaque;
$_SESSION['serverTime']=$serverTime;
$_SESSION['realm']=$realm;
$_SESSION['pid']=$pid;
$_SESSION['RndStr']=$RndStr;

$_SESSION['HTTP_USER_AGENT']=getenv("HTTP_USER_AGENT");
$_SESSION['REMOTE_ADDR']=getenv("REMOTE_ADDR");

// store post vars into session env.
foreach ( $_POST as $key => $value ):
	$_SESSION[$key]=$value;
	$_SESSION['POST_VARS'][$i]=$key;
endforeach;

$username='';
if (isset($_POST['contactID'])):
	$username=$_POST['contactID'];
endif;
$_SESSION['contactID']= $username;

session_write_close();

$HtmlNewAuth=file_get_contents($server['root']['path'].'resources/authoring/Auth.client.js');
$HtmlNewAuth=str_replace("{realm}", $realm, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{randomString}", $RndStr, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{serverTime}", $serverTime, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{opaque}", $opaque, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{nonce}", $nonce, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{pid}", $pid, $HtmlNewAuth);
$HtmlNewAuth=str_replace("{requestURI}", $_SERVER['REQUEST_URI'], $HtmlNewAuth);
// ⁄{params} {destinationID} {type}=CID,NCID are to be replaced on target loaded page	
$ScriptCode='<script>'.$HtmlNewAuth.'</script>';
?>