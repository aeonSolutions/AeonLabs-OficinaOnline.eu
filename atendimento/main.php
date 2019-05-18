<?php
// load environment for submit a new user registration
if (constant('ON_SiTe') === null):
	define('ON_SiTe', true);
endif;
$ScriptCode='';
$server['root']['path']=substr(__FILE__,0,strpos(__FILE__,"atendimento")); // file system path
$pid='a1XJUhL8Nib67yzqKU0MGf95frgbkI';
include($server['root']['path'].'resources/authoring/newAuthEnvironment.server.php'); // after $ScriptCode variable is available for use
$params="['AssistNome','NewEmail','AssistFacebook','AssistInstagram','AssistLinkedIn','AssistTelef','ContactID','TokenID','g-recaptcha-response']";
$ScriptCode=str_replace("{DestinationID}", 'AssistRegisto', $ScriptCode);
$ScriptCode=str_replace("{params}", $params, $ScriptCode);
$ScriptCode=str_replace("{type}", "NCID", $ScriptCode);
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
<link rel="stylesheet" href="../stylesheets/DlgHolder.css">

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
	<script src="../js/jquery.flexslider.js"></script>

	<script src="../js/custom.js"></script>
	<script src="../js/HttpRequests.lib.js"></script>
	<script src="../js/HtmlHandling.lib.js"></script>
	<script src="../js/FormsHandling.lib.js"></script>
	<script src="../js/md5.lib.js"></script>
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
					  <li><a href="#features">Funções e Tarefas</a></li>
						<li><a href="#tour">Efectuar Registo</a></li>
						<li><a href="#faq">FAQ</a></li>
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
	<!-- Start Features -->
	<section id="features">
			<div class="preamble twelve columns offset-by-two">
				<h2>Funções e tarefas do atendimento telefónico</h2>
				<p class="lead">
					Para este trabalho de atendimento é requisito mínimo que esteja disponível para atender telefonemas durante o dia dentro do horário de trabalho. 
				</p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-clock-o"></i>
				<h5>Rapidez na Resposta</h5>
				<p>Atender todos os telefonemas e dar uma resposta imediata sobre o que o cliente procura.</p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-file-text-o"></i>
				<h5>ligação á internet</h5>
				<p> Ter uma ligação á internet para que possa consultar os preços de vendas a decorrer aqui nesta página web.</p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-credit-card"></i>
				<h5>Para ganhar uns mais trocos</h5>
				<p>Não é um salário nem um emprego. É para quem utiliza o smartphone todo o dia com ligação á internet.</p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-mobile"></i>
				<h5>Perfil</h5>
				<p>Necessita de ter o seu perfil no facebook actualizado todos os dias com fotos e comentários. Assim como gerir o seu perfil no linkedIn todos os meses.</p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-truck"></i>
				<h5>Quanto recebe?</h5>
				<p>O valor da chamada de valor acrescentado quando telefonarem para o seu número (o custo típicos da chamada é de 0.60c).<br>
				  <br>
			  </p>
			</div>
			<div class="one-third column feature">
				<i class="fa fa-comments"></i>
				<h5>Avaliação</h5>
				<p>O seu atendimento é avaliado por os utilizadores e clientes através de feedback e classificação de 1 a 5. É importante que goste e entenda de Peças Auto.</p>
			</div>
	</section>
	<!-- End Features -->

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
	
	<!-- Start Tour -->
	<section id="tour">
		<!-- Start Grid -->
		<div id="AssistRegisto" class="grid">
				<h2>Efectuar registo</h2>
				<p class="lead">
					Para que o seu serviço de atendimento telefónico seja publicitado aqui na página, tem que todos os dias, dar inicio á sua disponibilidade logo de manhã entre as 8h e as 9h.
					Ao fim do dia não se pode esquecer de encerrar mais tardar ás 20h.  <br />
					Lembre-se que o seu atendimento será avaliado por os utilizadores através da página de classificação de atendimento, feedback e Rating. 
				</p>
				<div class="stripped">
					Nome&nbsp;<input type="text" class="InputField" style="display: inline-block; width: 300px;" id="AssistNome" placeholder="Nome completo" />
					&nbsp;&nbsp;e-mail&nbsp;<input type="text" class="InputField" style="display: inline-block; width" id="NewEmail" placeholder="email de contacto" /></br>
					Redes Sociais</br>
					As redes sociais são muitos importantes. Dão a conhecer a pessoa por detrás do telefone e permitem dar mais confiança e credibilidade ao potencial cliente. Para isso necessita de ser utilizador/a diário no facebook e com acesso público. Procure na web tutoriais de como optimizar a sua conta de facebook para maximizar o negócio. 
					<ul>
					<li>Facebook&nbsp;<input class="InputField" type="text" id="AssistFacebook" placeholder="http://www.facebook.com" /></li>
					<li>Instagram&nbsp;<input class="InputField" type="text" id="AssistInstagram" placeholder="http://www.instagram.com" /></li>
					<li>LinkedIn&nbsp;<input class="InputField" type="text" id="AssistLinkedIn" placeholder="http://www.linkedIn.com" /></li>
					</ul>
					Contacto telefónico que disponibiliza para que potenciais clientes possam utilizar para esclarecer as suas dúvidas</br>
					<input type="text" id="AssistTelef" placeholder="número de telefone" /></br>
					Escolha um contact ID <small>pode ser desde o numero de telefone pessoal a uma frase que goste e fácil de lembrar ou memorizar. Não pode ter espaços. Max 50 caracteres.</small></br>
					<input type="text" id="ContactID" placeholder="contacto" /></br>
					Cole na box abaixo uma chave de acesso Token<small>&nbsp;(tem que ter no mínimo 100 caracteres. Utilize uma App como o <a href="http://www.autistici.org/rpg/" target="_blank">RPG</a> para gerar uma)</small>
					<textarea id="TokenID" class="contactIDToken" placeholder="coloque aqui a sua chave de acesso pessoal e intransmissivel. Tem que ter no minimo 100 characteres alfanumericos A-Z, a-z, 0-9"></textarea></br>
					
					<div style="margin-left: -webkit-calc(50% -100px); margin-top: 0px;" class="g-recaptcha" data-sitekey="6LdYhR8TAAAAAJNdz8ocmgdPh3C1maHmNBgFSAwZ"></div>
					<script src='https://www.google.com/recaptcha/api.js'></script>
				</div>

				<p>
				Para saber ou obter mais informação sobre como obter um numero de valor acrescentado recomenda-se que se desloque a uma loja de um qualquer operador de telecomunicações: PT, NOS ou Vodafone ou então através da ANACON.
				</p>
				<p>
				Para ver quem está disponível neste momento para atendimento clique <a href="http://www.oficinaonline.eu/atendimento/online.php">aqui</a>.</br>
				Após a validação do registo quando receber o email, pode autenticar-se na página inicial clicando no icon ao lado de "Cotação na Hora".
				</p>
				</br>
				<p>
				A informação que disponibiliza é de acesso público. Está disponível para consulta 24H por dia. </br>O Token de acesso não é guardado na web.
				</p>
				<button style="float: right;" class="" onclick="javascript: SendAuth();">registar-me</button>
		</div>
		<!-- End Grid -->
		
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
		
	</section>
	<!-- End Tour -->
	
	<!-- Start FAQ -->
	<section id="faq">
		<div class="preamble twelve columns offset-by-two">
			<h2>FAQ</h2>
			<p class="lead">O nosso processo de pesquisa e orçamentação é muito simples e não requer registo no site para que possa comprar. Abaixo apresentamos as dúvidas mais comuns dos nossos utilizadores. Caso não fique satisfeito pode entrar em contacto connosco através do serviço telefónico ou via email, <a href="mailto:info@oficinaonline.eu">info@oficinaonline.eu</a></p>
		</div>
		<div class="eight columns question">
			<blockquote>
				<h5>Como se processa o envio da cotação ?</h5>
				<p>A resposta ao pedido de cotação é via email. Este inclui toda a ficha técnica da peça ou componente, com descrição detalhada, registo fotográfico e tempo de entrega. Caso aceite, e queira proceder à compra, basta clicar no link que lhe é enviado no email para dar continuidade ao processo de pagamento e envio.</p>
			</blockquote>
		</div>
		<div class="eight columns question">
			<blockquote>
				<h5>Como funciona ?</h5>
				<p>O processo é muito simples, não necessita de abrir conta nem agora nem depois para pagamento. Preencha o formulário apresentado no topo da página, com a informação necessária. Tenha especial atenção em indicar a Marca do veículo automóvel, modelo e ano de matricula no campo indicado.</p>
			</blockquote>
		</div>
		<div class="eight columns question">
			<blockquote>
				<h5>Como posso adicionar a minha empresa ?</h5>
				<p>Para clientes o contactarem necessita de adicionar alguma informação sobre a sua empresa, como a localização do seu negócio, contactos como email e telefónico, horário de funcionamento, enfim, aquela informação que deixa o seu cliente mais descansado na compra que vai fazer. Para adicionar a sua empresa faça-o através do seguinte <a href="http://oficinaonline.eu/adicionarempresa/">formulário</a> </p>
				</blockquote>
		</div>        
		<div class="eight columns question">
			<blockquote>
				<h5>Sou particular também posso listar as minhas peças ?</h5>
				<p>Se é particular necessita de providenciar alguma tipo de informação ao interessado na sua venda. Essa informação ser-lhe á pedida á medida que o negócio se vai concretizando via email. Para adicionar a sua venda faça-o através do seguinte <a href="http://oficinaonline.eu/vender/">formulário</a> </p>
				</blockquote>
		</div> 
 
		<div class="eight columns question">
        	<blockquote>
				<h5>Que tipo de entrega é disponibilizado ?</h5>
				<p>É despachado todo o tipo de material de mecânica, como motores completos a componentes específicos desde ao mais urgente (24H) ao mais barato.  Pergunte ao vendedor quais são as opções de entrega que disponibiliza.</p>
			</blockquote>
		</div>      
   
	<div class="eight columns question">
		<blockquote>
			<h5>O que posso comprar ?</h5>
			<p>A plataforma está adequada a responder a veículos de todas as marcas e modelos, mesmo internacionais ou carros de colecção. Deste modo pode requisitar para uma cotação, nem que seja para poder dar um orçamento ao seu cliente.  Caso não encontre envie um email <a href="mailto:info@oficinaonline.eu">info@oficinaonline.eu</a> a requisitar essa funcionalidade. </p>
		</blockquote>
	</div>
<div class="eight columns question">
	<blockquote>
		<h5>Como é establecido o Contacto ?</h5>
		<p>De modo a obter o preço mais baixo do mercado, o contacto inicial preferencial é via email. Envie-nos a informação no formulário acima que a plataforma trata do restante. Caso pretenda um contacto mais presencial ou para pedidos urgentes, pode fazê-lo através da linha de atendimento telefónico. Este último têm um custo acrescido no serviço prestado.</p>
		</blockquote>
</div> 
  <div class="eight columns question">
  	<blockquote>
  		<h5>Como efectuo a compra e pagamento ?</h5>
  		<p>Para dar inicio ao processo de compra, clique no link na mensagem de email que recebeu para aceder novamente ao OfinicaOnline. O processo é bastante simples, necessita apenas indicar o tipo de entrega que pretende assim como o tipo de pagamento. Esta plataforma dá preferência a pagamento processado por <a href="http://www.paypal.pt" target="_blank">PayPal</a>, pela rapidez. Embora também vá estar disponível pagamento por multibanco, transferência bancária ou cartão de crédito. Quanto a pagamento "á cobrança CTT" fica disponível por mútuo acordo de ambas as partes. Durante o contacto.  </p>
  	</blockquote>
  </div>  
<div class="eight columns question">
	<blockquote>
		<h5>O que é Open Data ?</h5>
		<p>Open Data significa que o que está guardado na base de dados é de acesso livre e aberto. Se tem algum receio sobre questões de privacidade experimente e veja pos si próprio como funciona. Para aceder clique no seguinte <a href="http://oficinaonline.eu/opendata/">link</a></p>
		</blockquote>
</div>        
<div class="eight columns question">
	<blockquote>
		<h5>Qual é o critério de listar as vendas ?</h5>
		<p>Não existe page rank nem pagamento para publicitar a venda. Existe contudo um feedback com classificação tanto do vendedor como do cliente.</p>
		</blockquote>
</div> 
	</section>
	<!-- End FAQ -->

	<!-- Divisor -->
	<div class="divisor sixteen columns">
		<hr>
	</div>
	<!-- End Divisor -->
	
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
<!-- Start of Dialogs -->
<div id="PageMask"></div>
<div id="Dialogs"></div>
<!-- End of Dialogs -->
<?php
echo $ScriptCode; 
 ?>
</body>
</html>
