<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');

$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
include($server['root']['path'].'resources/config/authoring.cfg');	
include($server['root']['path'].'resources/authoring/auth.lib.php');

$username='';
$token='';
$email='';
$err='';
$failCaptcha=false;

if (!isset($contacts)): // from external file: atendimento/novoRegisto.server.php
	$contacts='';
endif;

//verify captcha human verification
include($server['root']['path'].'resources/authoring/recaptchaAuth.server.php'); // var boolean $failCaptcha is avail for eval after
if ($failCaptacha==true):
	$err='...encontrei um robot como eu? ... estou a jogar arkanoid neste momento.';
endif;

if ( !isset($_POST['TokenID'])):
	$err='Chave de acesso Token não foi aceite ou não é válida</br>';
elseif (strlen($_POST['TokenID'])<100 ):
	$err='Chave de acesso Token tem que ser maior que 100 caracteres.</br>';
else:
	$token=$_POST['TokenID'];
endif;

if ( !isset($_POST['NCID'])):
	$err='Contact ID de acesso não encontrado</br>';
elseif ($_POST['NCID']=='' or strlen($_POST['NCID'])>50 or strpos($_POST['NCID']," ")):
	$err='Contact ID não foi aceite ou não e válido</br>';
else:
	$username=$_POST['NCID'];
endif;
if ($username==''): // session not found for username 
	$err='Necessita de indicar o Contact ID</br>';
endif;

if ( !isset($_POST['NewEmail']) ):
	$err.='email não foi aceite ou não e válido';
elseif ( filter_var($_POST['NewEmail'], FILTER_VALIDATE_EMAIL) ):
	$email=$_POST['NewEmail'];
	$contacts.='email:'.$email.chr(13);
else:
	$err.='email não foi aceite ou não e válido</br>';
endif;
if (!isset($_POST['response']) or !isset($_POST['response2'])):
	$err='Erro na Validação. Faça reload á página.';
elseif($_POST['response']=='' or $_POST['response2']==''):
	$err='Erro na Validação. Faça reload á página.';	
else:
	$validationCode=$_POST['response'];
	$validationCode2=$_POST['response2'];	
endif;

//check if username is present on DB and load token
include($server['root']['path'].'resources/config/database.cfg');	

// clean registers that are not validated and older than 7 days
CleanValidationFiles();

$WaitDB= new ValidationFilesDB;
$WaitDB::LoadValidationFiles();
if ($WaitDB::CheckOnValidationFiles('contactID', $username) !== false):
	$err='Contact ID não é válido. Escolha outro.';
endif;

if ($WaitDB::CheckOnValidationFiles('email', $email) !==false):
	$err='e-mail não foi aceite ou não e válido (2)</br>';
endif;

$db->connect(true);
$query=$db->getquery("SELECT contactID, tokenID, contactos FROM Contacts WHERE email='".$email."'");
if($query!= false):
	$err='e-mail não foi aceite ou não e válido (3)</br>';
endif;
$query=false;
$query=$db->getquery("SELECT contactID, tokenID, contactos FROM Contacts WHERE contactID='".$username."'");
$db->connect(false);
if ($query): //encontrou na DB
	$err='Contact ID não é válido. Escolha outro.';
elseif($err==''): // proceed to validation 
	if (!is_dir($server['root']['path'].'temporary')):
		mkdir($server['root']['path'].'temporary', 0755);
		$err='mkdir';
	endif;
	include($server['root']['path'].'resources/dll/FileSystemAccess.class');
	$filename=$server['root']['path'].'temporary/'.$username.'.wait.db';
	
	$fm= new FileSystemAccess;
	if ( $fm::WritePrermissions(dirname($filename)) ):
		$file_content="<?php
		$"."waiting['tokenID']='".$token."';
		$"."waiting['contactID']='".$username."';
		$"."waiting['contacts']='".$contacts."';
		$"."waiting['response']='".$validationCode."';
		$"."waiting['response2']='".$validationCode2."';
		$"."waiting['email']='".$email."';
?>";
	
		$status=$fm::WriteFile($filename, $file_content);
		if ($status!==false):
			$err='Unable to store data on server. Check file System('.$status.')</br>';
		endif;
	else:
		$err='Unable to store data on server. Check file System (permission error on folder)</br>';
	endif;

endif;

if($err<>''):
	$img='../resources/authoring/graphics/notValidated.png';
	$html=file_get_contents($server['root']['path'].'resources/dialogs/DlgError.html');
	$html=str_replace("{message}","Para que o anúncio seja validado e aceite é necessário acrescentar a informação abaixo:<ul>".$err.'</ul>', $html);
	$html=str_replace("{image}",$img, $html);
	include($server['root']['path'].'resources/dll/famousQoutes.lib.php');
	$html=str_replace("{quote}","<small>".famousQoutes()."</small>", $html);
	
	$code='container: Dialogs'.chr(13).$html;
	$ContentSize=strlen($code);
	header('Content-Type: text/html');
	header ( "Pragma: no-cache" );
	header ( "Cache-Control: no-cache" );
	header("Content-Length: ".$ContentSize);//set header length
	echo $code;
	exit;
endif;

// proceed to original submit server file!
?>