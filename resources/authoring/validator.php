<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
setlocale(LC_ALL, 'pt_PT');

$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"resources")); // file system path
include($server['root']['path'].'resources/authoring/auth.lib.php');

// clean registers that are not validated and older than 7 days
CleanValidationFiles();


$debuggers='';
$fn=true;

if (isset($_GET['uploadfile'])):
	
	foreach ($_FILES as $key => $value):
		$debuggers.= $_FILES[$key].':M';
	endforeach;
	
	
	foreach ($_POST as $key => $value):
		$debuggers.= $_POST[$key].':M';
	endforeach;
	
	$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
	
	if (isset($_SERVER['HTTP_X_FILENAME'])): // AJAX call
		$fn = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
		file_put_contents(
			'uploads/' . $fn,
			file_get_contents('php://input')
		);
	
	elseif (isset($_FILES['FilePhoto'])): // form submit
		$files = $_FILES['FilePhoto'];
		foreach ($files['error'] as $id => $err):
			if ($err == UPLOAD_ERR_OK):
				$fn = $files['name'][$id];
				move_uploaded_file(
					$files['tmp_name'][$id],
					'uploads/' . $fn
				);
				echo "<p>File $fn uploaded.</p>";
			endif;
		endforeach;
	
	endif;
	
	
	if (isset($_FILES['filePhoto']) or isset($_SERVER['HTTP_X_FILENAME']) ):
		$debuggers.='argggghhh... it aint this bug!';
	
	else:
		$debuggers.= '...no pizza per moi? >'.$_SERVER['HTTP_X_FILENAME'].'<';
	endif;

endif;


if (isset($_GET['delPhoto'])):
	echo 'del';	
	exit;
endif;

if (isset($_FILES['files']['name']) and isset($_GET['response'])):	
	$err='';
	include($server['root']['path'].'resources/dll/FileUpload.lib.php');
	$result=HandleIncommingFiles($server['root']['path'].'');
	if(!$result):
		$response=$_GET['response'];
		$WaitDB= new ValidationFilesDB;
		$WaitDB::LoadValidationFiles();
		if ($pos=$WaitDB::CheckOnValidationFiles('response2', $response) ):
			$fileName=sha1_file($_FILES['files']['tmp_name']);
			// You should name it uniquely.
			// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
			// On this example, obtain safe unique name from its binary data.
			if (!move_uploaded_file( $_FILES['files']['tmp_name'], $server['root']['path'].'temporary/'.$fileName ) ):
			    $err='Failed to move uploaded file.';
			endif;
			
			include($server['root']['path'].'resources/dll/FileSystemAccess.class');
			$filename=$server['root']['path'].'temporary/'.$waiting['contactID'][$pos].'.wait.db';
			
			$fm= new FileSystemAccess;
			if ( $fm::WritePrermissions(dirname($filename)) ):
				$file_content="<?php
				$"."wating['tokenID']='".$wating['tokenID']."';
				$"."wating['contactID']='".$wating['contactID']."';
				$"."wating['contacts']='".$wating['contacts']."';
				$"."wating['response']='".$wating['response']."';
				$"."wating['response2']='".$wating['response2']."';
				$"."wating['email']='".$wating['email']."';
				$"."wating['photo']='".$fileName."';
		?>";
				$photo='../temporary/'.$fileName;
				$status=$fm::WriteFile($filename, $file_content);
				if ($status!==false):
					$err='Unable to store data on server. Check file System('.$status.')</br>';
				endif;
			endif;
		endif;
	endif;
endif;
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['validation'])):
	$validator=$_GET['validation'];
	
	$WaitDB= new ValidationFilesDB;
	$WaitDB::LoadValidationFiles();
	if (is_numeric($WaitDB::CheckOnValidationFiles('response', $validator)) ):
		$pos=$WaitDB::CheckOnValidationFiles('response', $validator);
		$contactID=$WaitDB::$field['contactID'][$pos];
		$details=$WaitDB::ListDetails($pos);
		$htmlDetails=$details['nome'].'</br>'.$details['email'].'</br> Telefone: '.join('.', str_split($details['telefone'], 3));
	else:
		include($server['root']['path'].'resources/dll/famousQoutes.lib.php');
	
		$err='Contacto nao encontrado. Fez o registo ha mais de uma semana?</br>Tem que efectuar um novo.';
		$err.='<br><small>('.$debuggers.')</small>';
		$img='../images/Delete_Icon.png';
		$html=file_get_contents($server['root']['path'].'resources/dialogs/DlgError.html');
		$html=str_replace("{quote}","<small>".famousQoutes()."</small>", $html);
		$html=str_replace("{message}",$err, $html);
		$html=str_replace("{image}",$img, $html);
		
		$code='container:Dialogs'.chr(13).$html;
		$ContentSize=strlen($code);
		header('Content-Type: text/html');
		header ( "Pragma: no-cache" );
		header ( "Cache-Control: no-cache" );
		header("Content-Length: ".$ContentSize);//set header length
		echo $code;
		exit;
	endif;
endif;

if($err<>'' || !$fn):
	include($server['root']['path'].'resources/dll/famousQoutes.lib.php');
	$debuggers= ($debuggers=='') ? '' : '<small>('.$debuggers.')</small>';
	$err.= ($fn) ? 'true' : 'false';
	$err.='<br>'.$debuggers;
	$img='../images/Delete_Icon.png';
	$html=file_get_contents($server['root']['path'].'resources/dialogs/DlgError.html');
	$html=str_replace("{quote}","<small>".famousQoutes()."</small>", $html);
	$html=str_replace("{message}",$err, $html);
	$html=str_replace("{image}",$img, $html);
	
	$code='container:Dialogs'.chr(13).$html;
	$ContentSize=strlen($code);
	header('Content-Type: text/html');
	header ( "Pragma: no-cache" );
	header ( "Cache-Control: no-cache" );
	header("Content-Length: ".$ContentSize);//set header length
	echo $code;
	exit;
endif;



include($server['root']['path'].'resources/authoring/newAuthEnvironment.server.php'); // after $ScriptCode variable is available for use

$contactID='';

$html=file_get_contents($server['root']['path'].'generic.html');

$htmlValidation=file_get_contents($server['root']['path'].'resources/authoring/validationDetails.html');
$htmlValidation=str_replace("{errors}", "", $htmlValidation);
$htmlValidation=str_replace("{photo}", "resources/authoring/graphics/noPhoto.jpg", $htmlValidation);
$htmlValidation=str_replace("{contactID}",$contactID, $htmlValidation);
$htmlValidation=str_replace("{details}",$htmlDetails, $htmlValidation);
$htmlValidation=str_replace("{response}",$nonce, $htmlValidation);
$html=str_replace("{generic}", $htmlValidation, $html);

$params="['TokenID','descricao']";
$pid='PA9nJTKVRX1qRydGclYSvewvZPc6qA';

$ScriptCode=file_get_contents($server['root']['path'].'resources/authoring/register.client.js');
$ScriptCode=str_replace("{DestinationID}", 'generic', $ScriptCode);
$ScriptCode=str_replace("{params}", $params, $ScriptCode);
$ScriptCode=str_replace("{contactID}", $contactID, $ScriptCode);
$ScriptCode=str_replace("{type}", "VCID", $ScriptCode);

$ScriptCode=str_replace("{realm}", $realm, $ScriptCode);
$ScriptCode=str_replace("{randomString}", $RndStr, $ScriptCode);
$ScriptCode=str_replace("{serverTime}", $serverTime, $ScriptCode);
$ScriptCode=str_replace("{opaque}", $opaque, $ScriptCode);
$ScriptCode=str_replace("{nonce}", $nonce, $ScriptCode);
$ScriptCode=str_replace("{pid}", $pid, $ScriptCode);
$ScriptCode=str_replace("{requestURI}", $_SERVER['REQUEST_URI'], $ScriptCode);

$ScriptCode.=chr(13).file_get_contents($server['root']['path'].'js/fileUpload.js');

$html.='<script>'.$ScriptCode.'</script>';
$code=$html;
$debuggers= ($debuggers=='') ? '' : '<small>('.$debuggers.')</small>';
$code.=' '.$debuggers;
$ContentSize=strlen($code);
header('Content-Type: text/html');
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
exit;

?>
