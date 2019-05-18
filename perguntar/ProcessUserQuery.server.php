<?php 
/*
Input variables
	$q

Return variables
	$car  <- array of associated words 
	$ArrQ <- array of input user words
	$ArrE <- array of unknown words

*/
$in=$q;
$q = preg_replace("/\b(\w+)\s+\\1\b/i", "$1", $in);
$q = implode(' ',array_unique(explode(' ', $q)));

$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"perguntar")); // file system path

$car['cilindrada']='';
$car['marca']='';
$car['modelo']='';
$car['part'][]=''; // peca ou componente ou acessório
$car['cartype']='usado'; // usado, salvado, recondicionado, restaurado, novo
$car['manutencao']=''; // s/n
$car['km']=''; //km 
$car['potencia']=''; //potencia 
$car['ano']=''; //ano de fabrico 
$car['mes']=''; //mes de fabrico 
$car['preco']=''; //preço de venda
$car['matricula']=''; 
$car['combustivel']=array(); //combustivel 
$car['misc']=array(); // miscelaneous data
$car['vendedor']=array(); // miscelaneous data
$car['hashTags']=array(); // miscelaneous data
$car['descricao']=''; 
//
$user['id']='';
$user['username']='';
$user['full_name']='';
$user['morada']='';
$user['phone'][]='';
$user['email'][]='';
$user['facebook']='';
$user['instagram']='';
$user['flickr']='';
$user['nif']='';
$user['nome_empresa']='';
$user['logotipo']='';
$user['gps']=''; // GPS 41°08'13.3"N 8°19'12.1"W
$user['codPostal']='';


setlocale(LC_ALL, 'pt_PT');

$userResult='no string';

//load word lists
$dictionary='';
//basic day to day words: evident and obvious
$wordlist=file_get_contents($server['root']['path'].'resources/config/words.query.cfg');
$wordlist=str_replace(chr(10), chr(13), $wordlist);
$wordlist=strtolower($wordlist);
$dictionary.=$wordlist;
$intepreter=explode(chr(13), $wordlist);
//load car brands
include($server['root']['path'].'resources/config/brands.query.cfg');
$brands=$oc_t_item_car_make_attr;
unset($oc_t_item_car_make_attr);
foreach ($brands as $btmp)  $brandStr[] = $btmp['s_name'];
// car models
include($server['root']['path'].'resources/config/models.query.cfg');
$models=$oc_t_item_car_model_attr;
unset($oc_t_item_car_model_attr);
foreach ($models as $mtmp)  $modelStr[] = $mtmp['s_name'];
// load users DB
include($server['root']['path'].'resources/config/vendedores.db'); // $vendedores['id'];['user'];...
//load months names
$mo=array('janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro');

include_once($server['root']['path'].'perguntar/SpellCorrector.php');
$corrector= new SpellCorrector;

$q=str_replace(chr(10), chr(32), $q);
$q=str_replace(chr(13), chr(32), $q);
$q=strtolower($q);

$desc='+'.$q;
if (strpos($desc,'textolivre')!==false  ):
	$tmp=explode("textolivre", $desc); //Warning ERROR on INDEX might occur
	if ($tmp[0]=='+'):
		$car['descricao']=htmlentities($tmp[1], ENT_HTML5 | ENT_SUBSTITUTE, "UTF-8");
		$q='';
	else:
		$car['descricao']=htmlspecialchars($tmp[1], ENT_HTML5 | ENT_SUBSTITUTE, "UTF-8");
		$q=$tmp[0];
	endif;
endif;

if (strpos($q,'vw')!==false):
	$q=str_replace("vw", "Volkswagen", $q);
endif;


$ArrQ=explode(" ", $q); //array of words inputed by user

$unique = array();

foreach($ArrQ as $v):
  isset($k[$v]) || ($k[$v]=1) && $unique[] = $v;
 endforeach;

$ArrQ=$unique;
$q=join(" ", $unique );
	

$ArrQ[]='';
$ArrE=array(); // array of words that no meaning was found
for ($i = 0; $i < count($ArrQ); $i++):
	$ArrQ[$i]=strtolower($ArrQ[$i]);
	$ArrQ[$i]=str_replace(" ", "", $ArrQ[$i]);
	if($ArrQ[$i]=='' or $ArrQ[$i]==' '):
		continue;
	endif;
	if (in_array(ucfirst (strtolower($ArrQ[$i])), $brandStr)): //find brand
		$car['marca']=ucfirst (strtolower($ArrQ[$i]));
	endif;
	if (in_array(ucfirst (strtolower($ArrQ[$i])), $modelStr)): //find brand
		$car['modelo']=ucfirst (strtolower($ArrQ[$i]));
	endif;
	
	if(isset($ArrQ[$i][2])):
		if (is_numeric($ArrQ[$i][0]) and $ArrQ[$i][1]=='.' and is_numeric($ArrQ[$i][2])):
			if(isset($ArrQ[$i][3])):
				if (!is_numeric($ArrQ[$i][3])):
					$car['cilindrada']=substr($ArrQ[$i], 0, 3);			
				endif;
			elseif(isset($ArrQ[$i][4]) and isset($ArrQ[$i][3])):
				if (is_numeric($ArrQ[$i][3])):
					$car['cilindrada']=substr($ArrQ[$i], 0, 4);
				endif;
			else:
				$car['cilindrada']=$ArrQ[$i];			
			endif;
		endif;
	endif;
	
	if (is_numeric($ArrQ[$i]) and strlen($ArrQ[$i])==4): // ano
		$car['ano']=$ArrQ[$i]; //ano
	endif;
	if (in_array($ArrQ[$i], $mo)): // mês
		$car['mes']=$ArrQ[$i]; 
	endif;
	
	if (strlen($ArrQ[$i])>7 and substr_count($ArrQ[$i],'-')):
		$tst='';
		$tst=explode("-", $ArrQ[$i]);
		$tst1= (is_numeric($tst[0])) ? 1 :0 ;
		$tst2= (is_numeric($tst[1])) ? 1 :0 ;
		$tst3= (is_numeric($tst[2])) ? 1 :0 ;
		$tst=$tst1+$tst2+$tst3;
		if ($tst==2): // é uma matricula PT
			$car['matricula']=$ArrQ[$i];
		endif;
	endif;
	
	if ($ArrQ[$i]=='diesel' or $ArrQ[$i]=='gasoleo'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	if ($ArrQ[$i]=='gasolina'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	if ($ArrQ[$i]=='gpl'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	if ($ArrQ[$i]=='electrico'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	if ($ArrQ[$i]=='hidrogeneo'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	if ($ArrQ[$i]=='etanol'): // ano
		$car['combustivel'][]=$ArrQ[$i]; //ano
	endif;
	$last_char=$ArrQ[$i][strlen($ArrQ[$i])-1];
	//echo ord($last_char).'='.chr($last_char).'||';
	if ($last_char==172):
		$tst='';
		$tst=substr($ArrQ[$i], 0, strlen($ArrQ[$i])-1);
		if (is_numeric($tst)):
			$car['preco']=$tst;
		endif; 	
	endif;
	if( strpos($ArrQ[$i], "preço")!==false or strpos($ArrQ[$i], "preco")!==false): // ano
		$tst='';
		$tst=substr($ArrQ[$i], 6, strlen($ArrQ[$i]));
		if (is_numeric($tst)):
			$car['preco']=$tst;
		endif; 
	endif;
	if( strpos($ArrQ[$i], 'km') ): // find kilometers
			$tst=substr($ArrQ[$i], 0, strlen($ArrQ[$i])-2);
			$tst=str_replace(".", '', $tst);
			if(is_numeric($tst)):
				$car['km']=$tst;
			endif;		
	endif;
	if( strpos($ArrQ[$i], 'cv') ): // find horsepower
		$car['potencia']=$ArrQ[$i];			
	endif;

	if (is_numeric($ArrQ[$i]) and strlen($ArrQ[$i])==9):
		$tmp=0;
		for ($j=7; $j >= 0; $j--):
			$tmp=$tmp+$ArrQ[$i][$j]*(9-$j);
		endfor;
		$mod=fmod($tmp, 11);
		if ((11-$mod)==$ArrQ[$i][8]): // its a NIF
			$user['nif']=$ArrQ[$i];	
		else:
			$user['phone'][]=$ArrQ[$i];	
		endif;
	endif;	

	if ( filter_var($ArrQ[$i], FILTER_VALIDATE_EMAIL) ):
		$user['email'][]=$ArrQ[$i];	
	endif;
	
	$tst=array('n','s','e','w','o');
	if (in_array($ArrQ[$i][strlen($ArrQ[$i])-1], $tst) or in_array($ArrQ[$i][0], $tst)):
		$tst='';
		$tst=substr($ArrQ[$i], 0, strlen($ArrQ[$i])-2 );
		$tst2='';
		$tst2=substr($ArrQ[$i], 1, strlen($ArrQ[$i])-1 );		
		if (strpos($ArrQ[$i], "°")!==false  or strpos($ArrQ[$i], "'")!==false or strpos($ArrQ[$i], '"')!==false or is_numeric($tst) or is_numeric($tst2)):
			$user['gps'].=$ArrQ[$i];			
		endif;	
	endif;
	
	if (strlen($ArrQ[$i])==8 and strpos($ArrQ[$i],"-")!==false):
			$user['codPostal']=$ArrQ[$i];					
	endif;

	if(strpos($ArrQ[$i], 'flickr.com')!==false):
		$user['flickr']=$ArrQ[$i];
	endif;
	if(strpos($ArrQ[$i], 'facebook.com')!==false):
		$user['facebook']=$ArrQ[$i];
	endif;
	if(strpos($ArrQ[$i], 'instagram.com')!==false):
		$user['instagram']=$ArrQ[$i];
	endif;


	//echo '||'.$ArrQ[$i].':'.$ArrQ[$i][0].'||-';
	if($ArrQ[$i][0]=="#" ): // find hashtags
		$tmp=substr($ArrQ[$i], 1, strlen($ArrQ[$i]));
		if (in_array($tmp, $vendedores['id']) or in_array($tmp, $vendedores['user'])):
			$car['vendedor'][]=$ArrQ[$i];			
		else: // its a hashTag
			$car['hashTags'][]=$ArrQ[$i];
		endif;			
	endif;
	
	if ($ArrQ[$i]=='novo' or $ArrQ[$i]=='nova'):
		$car['cartype']='novo';
	endif;

	if ($ArrQ[$i]=='salvado' ):
		$car['cartype']='salvado';
	endif;

	if ($ArrQ[$i]=='recondicionado'):
		$car['cartype']='recondicionado';
	endif;

	if ($ArrQ[$i]=='restauro'):
		$car['cartype']='restauro';
	endif;
	
	
	if (in_array($ArrQ[$i], $intepreter)):
			$car['misc'][]=$ArrQ[$i];
	else: // word not found in interpreter dictionary - user must correct before results
		if ($ArrQ[$i]<>''): //store unknown words
			$ArrE[]=$ArrQ[$i];
			$car['description']=$ArrQ[$i];		
		endif;
		
		//attempt to find correct word
		$tmp='';//$corrector->correct($ArrQ[$i], $dictionary); 

	endif;
endfor;
?>