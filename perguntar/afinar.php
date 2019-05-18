<?php
defined('ON_SiTe') or die('Direct Access to this location is not allowed.');

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Procure Peças, Componentes e Acessórios para o seu automóvel através de uma rede de vendedores internacional</title>
	<meta name="description" content="Procure Peças, Componentes e Acessórios para o seu automóvel através de uma rede de vendedores internacional">
	<meta name="author" content="AeonLabs.de">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="../stylesheets/base.css">
	<link rel="stylesheet" href="../stylesheets/skeleton.css">
	<link rel="stylesheet" href="../stylesheets/layout.css">
	<link rel="stylesheet" href="../stylesheets/font-awesome.css">
	<link rel="stylesheet" href="../stylesheets/prettyPhoto.css">
	<link rel="stylesheet" href="../stylesheets/flexslider.css">
	<link rel="stylesheet" href="../stylesheets/custom.css">

	<!-- Google Font
  ================================================== -->
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,600' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>

	<!-- Javascript
  ================================================== -->
  	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="../js/custom.js"></script>
	<script src="../js/jquery.nav.js"></script>
	<script src="../js/jquery.scrollTo.js"></script>
	<script src="../js/jquery.prettyPhoto.js"></script>
	<script src="../js/jquery.flexslider.js"></script>
	<script src="../js/HttpRequests.lib.js"></script>
	<script src="../js/HtmlHandling.lib.js"></script>
	<script src="../js/FormsHandling.lib.js"></script>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="../images/favicon.ico">
	<link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../images/apple-touch-icon-114x114.png">

</head>
<body>

<!-- Start Intro -->
<section id="intro">
	<div class="container extra">
	<!-- Header -->
		<header>
			<div class="sixteen columns">
				<div class="logo"> <!-- Logo -->
					<a href="http://www.oficinaonline.eu"><img src="../images/logo.png" alt="yourlogo" height="20px" width="120px"></a>
				</div>
				<!-- End Logo -->
					
				<!-- Menu toggle -->
				<label id="toggle" class="toggle"></label>
				<nav id="navigation"> <!-- Nav -->
					<ul>
					<li><a href="http://www.oficinaonline.eu/#features">O que oferecemos</a></li>
					<li><a href="http://www.oficinaonline.eu/#tour">Mais Recentes</a></li>
					<li><a href="http://www.oficinaonline.eu/#faq">FAQ</a></li>
					<li><a href="http://www.oficinaonline.eu/perguntar">Anúncios</a></li>
					</ul>
				</nav>
				<!-- End Nav -->
			</div>
		</header>
		<!-- End Header -->
	</div>
	<!-- End Container -->
</section>
<!-- End Intro -->

<!-- Start Container -->
<div class="container extra main">
	<!-- Divisor -->
	<div class="divisor sixteen columns">
		<hr>
	</div>
	<!-- End Divisor -->
	
	<!-- Start SearchID -->
	<section id="SearchID">
		<!-- Start Grid -->
		<div class="container">
			<div id="RefreshSearchErrors" class="sixteen columns">
			<h2>Procurar</h2>
			<?php
			$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"perguntar")); // file system path
			if($code==''):
				include($server['root']['path'].'perguntar/index.php');
			endif;
			echo $code;
			?>
			</div>
		</div>
		<!-- End Grid -->
	</section>
	<!-- End SearchID -->
	<!-- Divisor -->
	<div class="divisor sixteen columns">
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- links horizontal medium oficina online -->
<ins class="adsbygoogle"
     style="display:inline-block;width:468px;height:15px"
     data-ad-client="ca-pub-1137397637659610"
     data-ad-slot="3899988084"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	</div>
	<!-- End Divisor -->
	<!-- Start SearchID -->
	<section id="UserSearch">
		<!-- Start Grid -->
		<div class="container">
			<div id="DisplayQuery" class="sixteen columns">

				<?php
					if (isset($CodeUserSearch)):
						echo '<p><strong>A sua pergunta nos anúncios está a seleccionar </strong></p>';
						echo $CodeUserSearch;
					endif;
				?>
				</br></br>
			</div>
		</div>
		<!-- End Grid -->
	</section>
	<!-- End SearchID -->
	<!-- Divisor -->
	<div class="divisor sixteen columns">
		<hr size=1>
	</div>
	<!-- End Divisor -->
	<!-- Start AdvSearchID -->
	<section id="AdvSearchID">
		<!-- Start Grid -->
		<div class="container">
			<script>

			function AdvSelections() {
				var Element= document.getElementById('AdvUsado');
				if (Element.checked) {
					document.getElementById('AdvManutencao').disabled=false;
				}else {
					document.getElementById('AdvManutencao').disabled=true;				
				}

				var Element= document.getElementById('AdvRecondicionado');
				if (Element.checked) {
					document.getElementById('AdvRecN1').disabled=false;
					document.getElementById('AdvRecN2').disabled=false;
					document.getElementById('AdvRecN3').disabled=false;
				}else {
					document.getElementById('AdvRecN1').disabled=true;				
					document.getElementById('AdvRecN2').disabled=true;				
					document.getElementById('AdvRecN3').disabled=true;				
				}

				var Element= document.getElementById('AdvRestauro');
				if (Element.checked) {
					document.getElementById('AdvResN1').disabled=false;
					document.getElementById('AdvResN2').disabled=false;
					document.getElementById('AdvResN3').disabled=false;
				}else {
					document.getElementById('AdvResN1').disabled=true;				
					document.getElementById('AdvResN2').disabled=true;				
					document.getElementById('AdvResN3').disabled=true;				
				}
			
			}
			</script>
			<!-- start of ms-selection-container-->
				<div class="AdvOpt-selection-wrapper AdvOpt-compat">
					<input type="checkbox" id="click-AdvOpt" /><label class="AdvOpt-selection-label" for="click-AdvOpt" onclick="document.getElementById('click-AdvOpt-contents').classList.toggle('closed');"></label><a href="#" class="nolinks" onclick="javascript: HtmlTogglePanel('click-AdvOpt');">&nbsp;Escolha manual de opções</a>
				</div>
				<div id="click-AdvOpt-contents" class="AdvOpt-slider closed AdvOpt-compat">
					<fieldset>
						O que procura é...</br>
						<input type="radio" <? echo $tst=($car['part']=='peca') ? 'checked="checked"' : '';?> name="part" id="AdvPeca" /> uma peça </br>
						<input type="radio" <? echo $tst=($car['part']=='componente') ? 'checked="checked"' : '';?> name="part" id="AdvComponent" /> um componente
						<input type="radio" <? echo $tst=($car['part']=='acessorio') ? 'checked="checked"' : '';?> name="part" id="AdvAcessorio" /> um acessório
					</fieldset>
					<table>
					<tr>
					<td>
						<fieldset>
							O que procura é um automóvel...</br>
							<input type="radio" <? echo $tst=($car['cartype']=='usado') ? 'checked="checked"' : '';?> name="car" id="AdvUsado" onchange="javascript:AdvSelections();" /> Usado</br>
							<input type="radio" <? echo $tst=($car['cartype']=='salvado') ? 'checked="checked"' : '';?> name="car" id="AdvSalvado" onchange="javascript:AdvSelections();" /> Salvado</br>
							<input type="radio" <? echo $tst=($car['cartype']=='recondicionado') ? 'checked="checked"' : '';?> name="car" id="AdvRecondicionado" onchange="javascript:AdvSelections();" /> Recondicionado</br>
							<input type="radio" <? echo $tst=($car['cartype']=='restauro') ? 'checked="checked"' : '';?> name="car" id="AdvRestauro" onchange="javascript:AdvSelections();" /> Restauro</br>
						</fieldset>							
					</td>
					<td>
						<br><input type="checkbox" id="AdvManutencao" disabled="disabled" /> com manutenção comprovada por facturas desde 0km
						<br>
						<br>
						<input type="radio" name="AdvRecLevels" id="AdvRecN1" disabled="disabled" /><a class="nolinks" href="#" title="Manutenção Total de mecânica e electronica com verificação de componentes e a sua durabilidade + renovação do interior com instalação de impermeabilização e insonorizarão melhorada">Nivel 1</a>  &nbsp;&nbsp;
						<input type="radio" name="AdvRecLevels" id="AdvRecN2" disabled="disabled" /> <a href="#" class="nolinks" title="Nivel 1  +  Actualização com instalação de peças e componentes tecnológicos + Actulização nivel de emissoes ">Nivel 2</a> &nbsp;&nbsp;
						<input type="radio"  name="AdvRecLevels" id="AdvRecN3" disabled="disabled" /><a href="#" class="nolinks" title="Nivel 1 & 2  +  Motor recondicionado a 0km + turbo recondicionado e sistema de admissão e escape 
						        garantia igual á exigida de fabrica no ano de fabrico (incluindo motor) e manutenção igual aos intervalos exigidos por a fábrica a 0km">Nível 3</a>  &nbsp;&nbsp;
						<br>
						<input type="radio" name="AdvResLevels" id="AdvResN1" disabled="disabled" /> <a href="#" class="nolinks" title="Restauro tradicional clássico á data de fabrico do automóvel">Clássico</a>&nbsp;&nbsp;
						<input type="radio" name="AdvResLevels" id="AdvResN2" disabled="disabled" /><a href="#" class="nolinks" title="Restauro clássico mas com actualização estrutural para melhoria da segurança passiva">Act. Estrutural</a>  &nbsp;&nbsp;
						<input type="radio" name="AdvResLevels" id="AdvResN3" disabled="disabled" /> <a href="#" class="nolinks" title="Restauro clássico, com actualização estrutural para melhoria da segurança passiva assim como instalação de componentes tecnologicos de conforto e segurança activa">Act. Estrutural + Tecnológica</a> &nbsp;&nbsp;
					</td>
					</tr>
					</table>
					<p style="text-align: right;"><small>Pare o rato uns segundos sobre o texto de cada opção para saber mais</small></p>
				</div>
			<!-- end of ms-selection-container--> 
		</div>
		<!-- End Grid -->
	</section>
	<!-- End AdvSearchID -->

	<section>
		<div class="container">
			<div style="height: 100px;" class="sixteen columns">
			&nbsp;
			</div>
		</div>
	</section>
	<!-- Divisor -->
	<div class="divisor sixteen columns">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- links horizontal medium oficina online -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:468px;height:15px"
		     data-ad-client="ca-pub-1137397637659610"
		     data-ad-slot="3899988084"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<!-- End Divisor -->

	<!-- Start Footer -->
	<footer id="footer">
		<!-- Start Container -->
		<div class="container">
			<div class="sixteen columns copyrights"> <!-- Copyrights -->
				<p> 
			    Website desenvolvido por <a href="http://www.aeonlabs.de">Aeonlabs&reg;</a>
			    <br> 2016 Oficina Online © onde se aplicar. A Base de Dados é disponibilizada no formato <a href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons</a> e <a href="http://www.opendatacommons.org/licenses/pddl/1.0/">Open Data Commons Open Database License</a> 
			    </p>
			</div>
			<!-- End Copyrights -->
			<div class="ten columns social"> <!-- Social -->
				<p>
	 				<a href="http://www.facebook.com/oficinaonline24"><i class="fa fa-facebook"></i></a>
					<a href="http://www.twitter.com/oficinaonline24"><i class="fa fa-twitter"></i></a>
				</p>
			</div>
			<!-- End Social -->
		</div>
		<!-- End Container -->
	</footer>
	<!-- End Footer -->
</div>
<!-- End Container -->

</body>
</html>
