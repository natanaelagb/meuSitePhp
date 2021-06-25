<?php include("config.php"); ?>

<?php 
	Painel::updateUsuariosOnline();
	Painel::contador(); 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Meu Website</title>
	<link href="<?php echo INCLUDE_PATH;?>estilo/all.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>estilo/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chaves,do,meu,site">
	<meta name="description" content="Descrição do meu site">
	<meta charset="utf-8"/>
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH?>favicon.ico">
	
</head>
<body>
	<base base="<?php echo INCLUDE_PATH; ?>"/>
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;
			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}
	?>
	<div class="overlay-loader" ><img src="<?php echo INCLUDE_PATH?>imagens/ajax-loader.gif"></div>
	<div class="sucesso">E-mail enviado com sucesso!</div>
	<div class="erro">Ocorreu um erro ao enviar o e-mail!</div>

	<header>		
		<div class="center">
			<div class="logo left"><a href="<?php echo INCLUDE_PATH;?>">Meu Website</a></div>
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
					<li><a href="<?php echo INCLUDE_PATH_PAINEL;?>">Painel</a></li>

				</ul>
			</nav><!--desktop-->
			<nav class="mobile right">
				<div class="botao-menu-mobile"><i class="fas fa-bars" aria-hidden="true"></i>
				</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH;?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>depoimentos">Depoimentos</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH;?>noticias">Notícias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH;?>contato">Contato</a></li>
					<li><a href="<?php echo INCLUDE_PATH_PAINEL;?>">Painel</a></li>
				</ul>
			</nav><!--mobile-->
		<div class="clear"></div>
		</div><!--center-->
	</header>
	<div class="container-meio">
	<?php

	if (file_exists('pages/'.$url.'.php')){
		include('pages/'.$url.'.php');
	}else if($url != 'depoimentos' && $url != 'servicos'){
		if(explode("/", $url)['0']=='noticias')
			include('pages/noticias.php');
		else{
			include('pages/404.php');
			$pagina404 = true;
		}
	}else{
		include 'pages/home.php';
	}

	?>
	</div><!--container-meio-->
	<footer <?php if(isset($pagina404) && $pagina404 == true) echo "class='absoluta'";?>><p>Site genérico - Todos os direitos reservados</p></footer>
	
	<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbzYjfKLYtIZCyB6UuEvB7039_OSx31E0">
	</script>
	<script src='<?php echo INCLUDE_PATH;?>js/jquery.js'></script>
	<script src="<?php echo INCLUDE_PATH;?>js/constants.js"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/scripts.js"></script>
	<!--<script src="<?php echo INCLUDE_PATH;?>js/exemplo.js"></script>-->
	<?php 
	if($url=='home' || $url=='depoimentos' || $url=='servicos'){
	?>
	<script src="<?php echo INCLUDE_PATH;?>js/slider.js"></script>
	<?php 	} ?>
	<script src="<?php echo INCLUDE_PATH;?>js/formularios.js"></script>


</body>
</html>