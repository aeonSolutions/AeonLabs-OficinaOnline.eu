<?php 
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"atendimento")); // file system path
setlocale(LC_ALL, 'pt_PT@euro', 'pt_PT', 'deu_deu');

/*
adicionar na DB
enviar email para validar e com instruções de utilização

enviar erros do formulario caso contact ID ou token ja existam

construir a pagina pessoal em /assistente/contactID.php
foto
nome
redes sociais
contactos: telefone
feedback & rating

criar ficheiro de work log em /assistente/ contactID.work.log
DATE TIME 

criar ficheiro de work log em /assistente/ contactID.work.DB it holds up to 365 days of data.
$assistente['rating']=''; // calc after userID feedback submission
$assistente['feedback']['pos'][0]='';
$assistente['feedback']['neg'][0]='';
$assistente['feedback']['userID'][0]=''; //contactID that gave feedback
$assistente['rating'][0]=''; // rating of userID
$assistente['timeStamp']=''; // time date of feedback


*/
//validate all vars first and last inlcude register.auth only then do the batch file for initialization of new user

$err='';
$facebook='';
$instagram='';
$linkedin='';
$nome='';
$telef='';

if ( !isset($_POST['AssistNome'])):
	$err.='Nome não foi aceite</br>';
elseif ($_POST['AssistNome']==''):
	$err.='Nome não foi aceite</br>';
else:
	$nome=$_POST['AssistNome'];
endif;

if ( !isset($_POST['AssistFacebook']) or !isset($_POST['AssistLinkedIn'])):
	$err='Contas das Redes sociais são essenciais para que aconteça um bom negócio</br>';
endif;

if (strpos($_POST['AssistFacebook'], "www.facebook.") !==false):
	$facebook=$_POST['AssistFacebook'];
else:
	$err='Contas das Redes sociais são essenciais para que aconteça um bom negócio</br>';
endif;

if (strpos($_POST['AssistLinkedIn'], "www.linkedin.") !==false ):
	$linkedin=$_POST['AssistLinkedIn'];
else:
	$err='Contas das Redes sociais são essenciais para que aconteça um bom negócio</br>';
endif;

if (strpos($_POST['AssistInstagram'], "www.instagram.") !==false):
	$instagram=$_POST['AssistInstagram'];
else:
	$instagram='';
endif;

if ( !isset($_POST['AssistTelef'])):
	$err.='número de telefone para atendimento não foi aceite ou não e válido</br>';
elseif (is_numeric($_POST['AssistTelef']) and strlen($_POST['AssistTelef'])==9):
	$telef=$_POST['AssistTelef'];	
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

//prepare data to send to register.server.php
$contacts='facebook:'.$facebook.chr(13);
$contacts.='instagram:'.$instagram.chr(13);
$contacts.='linkedin:'.$linkedin.chr(13);
$contacts.='telefone:'.$telef.chr(13);
$contacts.='nome:'.$nome.chr(13);

$code='Success!';
//register new contactID 
include($server['root']['path'].'resources/authoring/register.server.php'); // has exit(); might not allow to continue further bellow 


if ($err==''):
	//build email to send for validation
	//send email to author
	require($server['root']['path'].'resources/email/PHPMailerAutoload.php');
	include_once($server['root']['path'].'resources/config/email.cfg');
	
	$mail = new PHPMailer;
	
	//$mail->SMTPDebug = 3;                               // Enable verbose debug output
	$mail->CharSet = 'UTF-8';
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = $staticVars['smtp']['host'];  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = $staticVars['smtp']['user'];                 // SMTP username
	$mail->Password = $staticVars['smtp']['password'];                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $staticVars['smtp']['port'];                                    // TCP port to connect to
	
	$mail->setFrom($staticVars['email'], $staticVars['nome']);
	$mail->addAddress($email, $nome);     // Add a recipient
	$mail->addReplyTo($staticVars['email'], $staticVars['nome']);
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = htmlspecialchars('Registo no '.$staticVars['name'].' para a função de assistente telefónico(a)', ENT_SUBSTITUTE);
	$HtmlEmail=file_get_contents($server['root']['path'].'resources/templates/newAssistantUser.html');
	
	$link=$WebSiteAddress.'/?pid=PA9nJTKVRX1qRydGclYSvewvZPc6qA&validation='.$validationCode;
	$HtmlEmail=str_replace("{nome}", $nome, $HtmlEmail);
	$HtmlEmail=str_replace("{validar_link}", $link, $HtmlEmail);
	$HtmlEmail=str_replace("{username}", $username, $HtmlEmail);
	$HtmlEmail=str_replace("{password}", $token, $HtmlEmail);
	$HtmlEmail=str_replace("{RedesSociais}", $facebook.'</br>'.$linkedin.'</br>'.$instagram, $HtmlEmail);
	$HtmlEmail=str_replace("{telefone}", $telef, $HtmlEmail);
	
	$mail->Body=str_replace("{site_name}",$staticVars['name'],$HtmlEmail);
	$mail->Body=str_replace("{username}",$username,$mail->Body);
	$mail->Body=str_replace("{password}",$token,$mail->Body);
	$mail->Body=html_entity_decode($mail->Body);
	
	if(!$mail->send()):
	    $err= 'Message could not be sent.';
	    $err= 'Mailer Error: ' . $mail->ErrorInfo;
	endif;
endif;

$html=file_get_contents($server['root']['path'].'atendimento/novoRegisto.html');
$html=str_replace("{nome}", $nome, $html);
$html=str_replace("{telefone}", $telef, $html);
$html=str_replace("{redesSociais}", $facebook.'</br>'.$linkedin.'</br>'.$instagram, $html);

$code=$html;
$ContentSize=strlen($code);
header('Content-Type: text/html');
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
?>