<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"vender")); // file system path
setlocale(LC_ALL, 'pt_PT@euro', 'pt_PT', 'deu_deu');
$code='';
if (isset($_POST['VendaPreco']) or isset($_POST['response'])): // save new sale
	define('ON_SiTe', true);
	// process input query from user : var requirements: $q
	$q=isset($_POST['UserInputTotal']) ? $_POST['UserInputTotal'] : $_SESSION['UserInputTotal'];
	$Send2email=false;
	include($server['root']['path'].'perguntar/ProcessUserQuery.server.php'); 
	if ( (($user['username']=='' or $user['id']=='') and $user['email'][0]<>'') and $_POST['AuthReq']==0): //user not registered send to email
		$Send2email=true;
		// do form validation contents 
		$err='';
		$err.= ($_POST['VendaPreco']=='') ? '<li>Preço</li>': '';
		$err.= ($_POST['VendaDuracao']=='' or $_POST['VendaDuracao']==0) ? '<li>Duração</li>': '';
		$err.= ($_POST['VendaCondicoes']=='') ? '<li>Condições de Venda</li>': '';
		$err.= (isset($_POST['AddCode2Media'])) ? '<li>Fotos ou Video</li>': '';
		$err.= ($car['marca']=='') ? '<li>Marca do Automóvel</li>': '';
		$err.= ($car['modelo']=='') ? '<li>Modelo do Automóvel</li>': '';
		$err.= ($user['email'][0]=='') ? '<li>Email válido para contacto</li>': '';
		$err.= ($car['descricao']=='') ? '<li>Necessita de descrever bem o que está a vender</li>': '';
	
	else:	// ask for authoring
		// this operation requiers author access
		include($server['root']['path'].'resources/authoring/Auth.server.php'); // has exit(); might not allow to continue further bellow 
	
		// do form validation contents 
		$err='';
		$err.= ($_SESSION['VendaPreco']=='') ? '<li>Preço</li>': '';
		$err.= ($_SESSION['VendaDuracao']=='' or $_SESSION['VendaDuracao']==0) ? '<li>Duração</li>': '';
		$err.= ($_SESSION['VendaCondicoes']=='') ? '<li>Condições de Venda</li>': '';
		$err.= (isset($_SESSION['AddCode2Media'])) ? '<li>Fotos ou Video</li>': '';
		$err.= ($car['marca']=='') ? '<li>Marca do Automóvel</li>': '';
		$err.= ($car['modelo']=='') ? '<li>Modelo do Automóvel</li>': '';
		$err.= ($user['email'][0]=='') ? '<li>Email válido para contacto</li>': '';
		$err.= ($car['descricao']=='') ? '<li>Necessita de descrever bem o que está a vender</li>': '';
		
	endif;

	if ($err<>''):
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
		session_write_close();
		exit;
	endif;

	if ($Send2email):
		/*
		O anuncio foi aceite. Verifique a conta de email para o validar.
		enviar no email link de validação -> abre pagina com opçao para fazer registo de utilizador 
		*/
	endif;
elseif (isset($_POST['AddCode2Media'])): // media such as video and photos
		// process input query from user : var requirements: $q
		include($server['root']['path'].'vender/ProcessNewSale.server.php');  // returns var $code
		
		$HtmlWrapper='<p style="margin-bottom:-4px;">Pré visualizar</p>
		<div style="border-bottom: 1px solid black; border-top: 1px solid black;">'.$code.'</div>';
		
		$code=$HtmlWrapper;

elseif (isset($_POST['NewSaleUserInput'])): // media such as video and photos
	if (isset($_POST['UserInputTotal'])):
		$input=$_POST['UserInputTotal'];
	endif;
	if (isset($_POST['NewSaleUserInput'])):
		$input.=' '.$_POST['NewSaleUserInput'];	
	endif;
	
	$q=$input; //ToDo: error on del undef input
	
	// process input query from user : var requirements: $q
	include($server['root']['path'].'perguntar/ProcessUserQuery.server.php'); 
	
	
		$SugestWords='<div class="stripped">';
		if (isset($ArrR[0])):
			for ($i = 0; $i < count($ArrR); $i++):
				$SugestWords.='<div class="stripped-left" id="SearchEdit"><a class="nolinks" href="#" onclick="javascript:CommServer(\'http://www.oficinaonline.eu/perguntar/?q='.$ArrR[$i].'\',\'\',\'RefreshSearchErrors\');">'.$ArrR[$i].'</a></div><div class="stripped-left">&nbsp;&nbsp;</div>';
			endfor;
			$SugestWords.='</div>';		
		endif;
	
		$SugestWords= ($SugestWords=='<div class="stripped"></div>') ? '' : $SugestWords;
	
	//matched words
		$CodeUserSearch='';
		if ($car['marca']<>''):
			$CodeUserSearch='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del='.$car['marca'].'%20'.$car['modelo'].'%20'.$car['potencia'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Veículo:</strong>&nbsp'.$car['marca'];
		endif;
		if ($car['modelo']<>''):
			$CodeUserSearch.='&nbsp.'.$car['modelo'];
		endif;
		if ($car['potencia']<>''):
			$CodeUserSearch.='&nbsp('.$car['potencia'].')';
		endif;
		$CodeUserSearch.= ($CodeUserSearch<>'') ? '</br>' : '';
		
		if ($car['cilindrada']<>''):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del='.$car['cilindrada'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>cilindrada:</strong>&nbsp'.$car['cilindrada'].'</br>';
		endif;
		if ($car['km']<>''):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del='.$car['km'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Km anunciados até á data:</strong>&nbsp'.number_format($car['km'],0,".",",").'</br>';
		endif;
		
		$tmp='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del='.$car['ano'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a>';
		if ($car['ano']<>''):
			$CodeUserSearch.=$tmp.'<strong>Ano de Fabrico:</strong>&nbsp'.$car['ano'];
			$tmp='';
		endif;
		if ($car['mes']<>''):
			$CodeUserSearch.=$tmp.'&nbsp('.$car['mes'].')&nbsp&nbsp';
		endif;
		if ($car['matricula']<>''):
			$CodeUserSearch.=$tmp.'&nbsp<strong>Matricula:</strong>'.$car['matricula'].'&nbsp';
		endif;
		$CodeUserSearch.= ($CodeUserSearch<>'') ? '</br>' : '';
		
		if (isset($car['combustivel'][0])):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer( \'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del=combustivel\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Combustivel:</strong>&nbsp';
			for ($i = 0; $i < count($car['combustivel']); $i++):
				$CodeUserSearch.=$car['combustivel'][$i].'&nbsp';
			endfor;
		endif;
	
	
		if ($car['preco']<>''):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del='.$car['preco'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Preço de venda:</strong>&nbsp'.number_format($car['preco'],0,".",",").'&euro;</br>';
		endif;
		if ($car['cartype']<>''):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del=cartype\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Estado de conservação:</strong>&nbsp'.$car['cartype'].'</br>';
		endif;
		$CodeUserSearch.= ($CodeUserSearch<>'') ? '</br>' : '';
		
		if (count($car['vendedor'])>0):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del=description&del='.$car['vendedor'].'\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>á venda por:</strong>&nbsp';
			for ($i = 0; $i < count($car['vendedor']); $i++):
				$CodeUserSearch.='<a href="#">'.$car['vendedor'][$i].'</a>&nbsp';
			endfor;
		endif;
		
		if (count($car['hashTags'])>0):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer(\'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del=description&del=hashtags\',\'\',\'NewSaleDetails\');" alt="Apagar" /></a><strong>Tags de Venda:</strong>&nbsp';
			for ($i = 0; $i < count($car['hashTags']); $i++):
				$CodeUserSearch.='<a href="#">'.$car['hashTags'][$i].'</a>&nbsp';
			endfor;
		endif;
		$CodeUserSearch.= ($CodeUserSearch<>'') ? '</br>' : '';
		if ($car['descricao']<>''):
			$CodeUserSearch.='<a href="#"><img src="../images/Delete_Icon.png" width="16px" height="16px" onclick="javascript: CommServer( \'0EWIE3mmuiif2Z5rL4ZNyF1zFjRKEz&del=description\',\'\',\'NewSaleDetails\',);" alt="Apagar" /></a><strong>Descrição livre do anúncio:</strong>&nbsp';
			$CodeUserSearch.=''.$car['descricao'].'';
		endif;

		$CodeUserSearch.= ($CodeUserSearch<>'') ? '</br><input type="hidden" id="UserInputTotal"name="UserInputTotal" value="'.$q.'" />' : '';
		
		// current query html code
		if (isset($ArrE)):
			$userResult= join(" ", $ArrE);
		endif;
		
	$code=$CodeUserSearch;
endif;

$ContentSize=strlen($code);
header ( "Pragma: no-cache" );
header ( "Cache-Control: no-cache" );
header("Content-Length: ".$ContentSize);//set header length
echo $code;
?>