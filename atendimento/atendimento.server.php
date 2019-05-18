<?php 
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"vender")); // file system path
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



$img='../resources/authoring/graphics/notValidated.png';
$html=file_get_contents($server['root']['path'].'resources/dialogs/DlgError.html');
$html=str_replace("{message}","Para que o anúncio seja validado e aceite é necessário acrescentar a informação abaixo:<ul>".$err.'</ul>', $html);
$html=str_replace("{image}",$img, $html);

$code=$html;
$ContentSize=strlen($code);
header('Content-Type: text/html');
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
?>