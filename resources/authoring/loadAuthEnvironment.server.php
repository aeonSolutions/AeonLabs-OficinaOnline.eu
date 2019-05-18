<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path

$parsed = array();
$parsed['response'] = $_POST['response'];
$nonce=$_POST['response2'];

//load session env.
session_regenerate_id(true);
$_SESSION=array();
session_write_close();

session_id($default_SessionID);
session_start();
$nonceSessVar= substr($nonce, 0, 39);
$newSession=$_SESSION[$nonceSessVar];	
sleep(1);
session_write_close();

session_regenerate_id(true);
$_SESSION=array();
session_write_close();

// Set session ID to the new one, and start it back up again
session_id($newSession);
session_start();

// check session timeouts
$check=checkSession();
if(!$check):
	$message=$check;
	include($server['root']['path'].'resources/authoring/TrowAuthRequest.server.php'); //accepts var $msg
	exit;
endif;

//validation of just received POST vars with selected SESSSION ID
$ValidatedVars= null; 
foreach ( $_POST as $key => $value ):
	if(isset($_SESSION[$key]))
		$ValidatedVars= ($_SESSION[$key]==$_POST[$key]) ? true :false;
endforeach;

//check if username is present on DB and load token
$username='';
if (isset($_SESSION['contactID'])):
	$username= ($_SESSION['contactID']<>'') ? $_SESSION['contactID'] : '';
endif;

if($username==''):
	if (isset($_POST['CID'])):
		$username= stripslashes($_POST['CID']);	
	elseif ($_POST['NCID']):
		$username= stripslashes($_POST['NCID']);	
	endif;
endif;
	
if ($username==''): // session not found for username 
	$message='Necessita de indicar o Contact ID ';
	include($server['root']['path'].'resources/authoring/TrowAuthRequest.server.php'); //accepts var $msg
	exit;
endif;
include($server['root']['path'].'resources/config/database.cfg');
$db->connect(true);
$query=$db->getquery("SELECT contactID, tokenID FROM Contacts WHERE contactID='".$username."'");
$db->connect(false);

if (!$query):
	$valid=false;
	$err='(TokenID)'.$username;
else:
	$password=$query[0]['tokenID'];
endif;
if ($password==''): // session not found for username 
	$message='Necessita de indicar o Token ID ';
	include($server['root']['path'].'resources/authoring/TrowAuthRequest.server.php'); //accepts var $msg
	exit;
endif;

// Compute A1 as MD5("username:realm:password").  
$A1 = md5($username.$_SESSION['realm'].$password);
if ($qop == 'auth-int'):
	$A2 = md5($_SESSION['RndStr'].$_SESSION['pid'].md5($respBody));
else:
    // Compute A2 as MD5("requestMethod:requestURI"). 
    $A2 = md5($_SESSION['RndStr'].$_SESSION['pid']);
endif;
// Compute the final hash, know as “response”
$response = md5($A1.$_SESSION['opaque'].$_SESSION['serverTime'].$A2);
$valid = ($response == $parsed['response']);
 
//looking good to go...one final thing.... load $POST vars back
for ($i = 0; $i < count($_SESSION['POST_VARS']); $i++):
	$_POST[$_SESSION['POST_VARS'][$i]]=$_SESSION[$key];
endfor;
session_write_close();
?>