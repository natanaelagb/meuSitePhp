<?php

if (isset($_GET['logout'])) {
	Painel::logout();
	die();
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Painel de controle</title>
	<link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>estilo/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH ?>estilo/all.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH ?>favicon.ico">
</head>

<body>
	<base base="<?php echo INCLUDE_PATH_PAINEL; ?>" />
	<header>
		<div class="menu-btn">
			<i class="fas fa-bars"></i>
		</div>

		<div class="logout">
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"><i class="fas fa-sign-out-alt"></i></a>
		</div>
		<div class="home-btn">
			<a <?php if (@$_GET['url'] == '') echo 'style="color:#37474f"' ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fas fa-home"></i></a>
		</div>
		<div class="clear"></div>
	</header>
	<div class="fantasma"></div>
	<!-- <div class="overlay-menu"></div> -->

	<div class="menu">
		<!-- <div class="menu-wraper"> -->
		<div class="box-user">
			<div style="display: flex; justify-content: center;">
				<?php
				if ($_SESSION['img'] == "") {
				?>
					<div class="avatar-user">
						<i class="fa fa-user"></i>
					</div>
				<?php
				} else { ?>
					<div class="imagem-user">
						<img src="<?php echo INCLUDE_PATH_PAINEL; ?>uploads/<?php echo $_SESSION['img'] ?>">
					</div>

				<?php } ?>
			</div>
			<div class="info-user">
				<p><?php echo $_SESSION['nome']; ?></p>
				<p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
			</div>
		</div>
		<div class="box-links">

			<h2>Cadastro</h2>
			<a <?php atualMenu("cadastrar-depoimento"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimento">Cadastrar Depoimento</a>

			<a <?php atualMenu("cadastrar-servico"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-servico">Cadastrar Servi??o</a>

			<a <?php atualMenu("cadastrar-slide"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-slide">Cadastrar Slides</a>

			<h2>Gest??o</h2>
			<a <?php atualMenu("listar-depoimentos"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-depoimentos">Listar Depoimentos</a>

			<a <?php atualMenu("listar-servicos"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-servicos">Listar Servi??os</a>

			<a <?php atualMenu("listar-slides"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>listar-slides">Listar Slides</a>


			<h2>Adiministra????o do painel</h2>
			<a <?php atualMenu("cadastrar-usuario");
				permissaoVisualizarMenu($_SESSION['cargo']) ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-usuario">Cadastrar Usu??rio</a>

			<a <?php atualMenu("editar-usuario"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario">Editar Usu??rio</a>


			<h2>Configura????o Geral</h2>
			<a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>


			<h2>Gest??o de Not??cias</h2>
			<a <?php atualMenu("cadastrar-categoria"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-categoria">Cadastrar Categoria</a>

			<a <?php atualMenu("gerenciar-categorias"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-categorias">Gerenciar Categorias</a>

			<a <?php atualMenu("cadastrar-noticia"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-noticia">Cadastrar Not??cia</a>

			<a <?php atualMenu("gerenciar-noticias"); ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>gerenciar-noticias">Gerenciar Not??cias</a>

			<h2 <?php permissaoVisualizarMenu($_SESSION['cargo']) ?>>Gest??o de Clientes</h2>
			<a <?php atualMenu("cadastrar-cliente");
				permissaoVisualizarMenu($_SESSION['cargo']) ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-cliente">Cadastrar Cliente</a>

		</div>
		<!-- </div> -->
	</div>
	<!--menu-->


	<?php

	$url = isset($_GET['url']) ? $_GET['url'] : 'home';
	if (file_exists('pages/' . $url . '.php')) {
		include('pages/' . $url . '.php');
	} else {
		include('pages/home.php');
	}

	?>



	<script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<script>
		tinymce.init({
			selector: '.tinymce',
			plugins: "image",
			height: 300
		});
	</script>

</body>

</html>