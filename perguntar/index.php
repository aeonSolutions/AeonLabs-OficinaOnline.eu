<?php 
define('ON_SiTe', true);

//variables returned at the end of code
$code='';
$CodeUserSearch='';

// local folder address
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"perguntar")); // file system path

if (isset($_GET['q'])):
	$q=$_GET['q'];
	echo 'here1';
endif;
if (isset($_POST['InitialSearchQ'])):
	$q=$_POST['InitialSearchQ'];	
	echo 'here2';
elseif (isset($_POST['WordSugestion']) and isset($_POST['OldWord'])):
	$WordSugestion=$_POST['WordSugestion'];
	$OldWord=$_POST['OldWord'];
	$q=str_replace($OldWord, $WordSugestion, $q);
endif;
$CodeBase='
<p>{question}...</p>

<div style="display: table; width: 700px; background-color: #dedede; height: 80px; margin-right: auto; margin-left: auto; ">
  <div style="display: table-cell; vertical-align: middle;">
		<p style="font-style: italic; text-align: center; font-size: 18px;"><big>“</big>{result}<big>”</big></p>
  </div>
</div>
<br>
';
$sugestions='
<div id="SuggestID">
	<p>...escolha abaixo a palavra que mais se ajusta ao que quis dizer ou em alternativa substitua por uma diferente</p>
	{sugestions}
</div>
<form id"formWord" method="post" enctype="multipart/form-data" action="http://www.oficinaonline.eu/perguntar/?q='.$q.'">
	<div id="ReplaceWordID">
				<p> Não encontra listada acima uma palavra semelhante ou de significado próximo?</p>
				
				<div class="stripped">
					<div class="stripped-left" style="padding-top:8px;">substituir por&nbsp</div>
					<div class="stripped-left" style="padding-top:3px;"> 
						<input type="text" id="WordSugestion" name="WordSugestion" placeholder="nova palavra" requiered/>
						<input type="hidden" name="OldWord" id="OldWord" value="{result}" />
					</div>
					<div class="stripped-left">	
						<input type="submit" class="submit" id="submit_btn" value="Enviar" />
					</div>
				<div class="stripped-right"><a href="http://www.oficinaonline.eu/perguntar/?q={ignorar}">ignorar e continuar</a></div>
				</div>
	</div>
</form>
';

$userQuestion[0]='Não consegui entender';
$userQuestion[1]='Não tenho sugestões neste momento.';
$userQuestion[2]='Não tenho mais sugestões. Não estã listada acima uma palavra semelhante ou de significado próximo?';


// process input query from user : var requieremens: $q
include($server['root']['path'].'perguntar/ProcessUserQuery.server.php'); 

//

if ($ArrE[0]<>''):
	$SugestWords='<div class="stripped">';
	for ($i = 0; $i < count($ArrR); $i++):
		$SugestWords.='<div class="stripped-left" id="SearchEdit"><a class="nolinks" href="#" onclick="javascript:AjxSimpleHtml(\'RefreshSearchErrors\',\'http://www.oficinaonline.eu/perguntar/queryFree.php?q='.$ArrR[$i].'\');">'.$ArrR[$i].'</a></div><div class="stripped-left">&nbsp;&nbsp;</div>';
	endfor;
	$SugestWords.='</div>';
	$SugestWords= ($SugestWords=='<div class="stripped"></div>') ? '' : $SugestWords;

	if ($car['marca']<>''):
		$CodeUserSearch='<strong>Veículo:</strong>&nbsp'.$car['marca'];
	endif;
	if ($car['modelo']<>''):
		$CodeUserSearch.='&nbsp.'.$car['modelo'];
	endif;
	if ($car['potencia']<>''):
		$CodeUserSearch.='&nbsp('.$car['potencia'].')';
	endif;
	$CodeUserSearch.='</br>';
	
	if ($car['cilindrada']<>''):
		$CodeUserSearch.='<strong>cilindrada:</strong>&nbsp'.$car['cilindrada'].'</br>';
	endif;
	if ($car['km']<>''):
		$CodeUserSearch.='<strong>Km anunciados até á data:</strong>&nbsp'.number_format($car['km'],0,".",",").'</br>';
	endif;
	if ($car['ano']<>''):
		$CodeUserSearch.='<strong>Ano de Fabrico:</strong>&nbsp'.$car['ano'].'</br>';
	endif;
	
	if (in_array("diesel", $car['combustivel']) or in_array("gasoleo", $car['combustivel'])):
		$CodeUserSearch.='<strong>Combustivel:</strong>&nbspDiesel/Gasóleo';
	elseif (in_array("gasolina", $car['combustivel']) ):
		$CodeUserSearch.='<strong>Combustivel:</strong>&nbspGasolina';
	endif;
	if (in_array("gpl", $car['combustivel'])):
		$CodeUserSearch.='/GPL';
	elseif (in_array("hidrogeneo", $car['combustivel'])):
		$CodeUserSearch.='/Hidrogeneo';
	elseif (in_array("etanol", $car['combustivel'])):
		$CodeUserSearch.='/E85';
	elseif (in_array("electrico", $car['combustivel'])):
		$CodeUserSearch.='/Electrico';
	endif;
	$CodeUserSearch.='</br>';
	if (count($car['vendedor'])>0):
		$CodeUserSearch.='<strong>á venda por:</strong>&nbsp';
		for ($i = 0; $i < count($car['vendedor']); $i++):
			$CodeUserSearch.='<a href="#">'.$car['vendedor'][$i].'</a>&nbsp';
		endfor;
	endif;
	if (count($car['hashTags'])>0):
		$CodeUserSearch.='<strong>Tags de Venda:</strong>&nbsp';
		for ($i = 0; $i < count($car['hashTags']); $i++):
			$CodeUserSearch.='<a href="#">'.$car['hashTags'][$i].'</a>&nbsp';
		endfor;
	endif;
	$CodeUserSearch.='</br>';
	
	// corrent query html code
	$userResult= join(" ", $ArrE);
	if ($SugestWords<>''):
		$code=str_replace("{question}", $userQuestion[0], $CodeBase);
	else:
		$code=str_replace("{question}", $userQuestion[0], $CodeBase);
		$SugestWords='<p>'.$userQuestion[1].'</p>';
	endif;
	$code.=str_replace('{sugestions}', $SugestWords, $sugestions);
	$code=str_replace("{result}", $userResult, $code);

	$code=str_replace("{ignorar}", join(" ",array_diff($ArrQ, $ArrE)), $code);

	include($server['root']['path'].'perguntar/afinar.php');
else: // no errors ToDo: no advanced options selected
	include($server['root']['path'].'anuncios/index.php');
endif;
?>