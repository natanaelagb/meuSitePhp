<?php

	$depoimentos = Painel::selecionarTudo("nome,depoimento","tb_site.depoimentos",0,3,"order_id");
	$servicos = Painel::selecionarTudo("servico","tb_site.servicos",0,7,"order_id");
	$slides = Painel::selecionarTudo("slide","tb_site.slides",0,4,"order_id");

	$info_autor = Painel::selecionarTudo("*","tb_site.autor");
	$especialidades = Painel::selecionarTudo("*","tb_site.especialidades");

?>

<section class="banner">

<?php foreach ($slides as $key => $value) {?>
	
	<div style="background-image: url('<?php echo INCLUDE_PATH_PAINEL?>uploads/<?php echo $value['slide']?>');" class="banner-single"></div><!--banner-single-->

<?php } ?>

	<div class="overlay"></div>

	<div class="center">
		<form class="ajax-form" method="post">
			<h2>Qual seu melhor email?</h2>
			<input type="email" name="email" required="">
			<input type="submit" name="submit" value="Cadastrar!">
			<input type="hidden" name="identificador" value="post_home">
		</form><!--center-->
	</div>
	<div class="bullets"></div><!--bullets-->
</section><!--banner-->


<section class= "autor">
	<div class="center">
		<div class="w50 left">
			<h2><?php echo $info_autor[0]['nome']; ?></h2>

		<?php

			$arr = explode("\n", $info_autor[0]['descricao']);

			foreach ($arr as $key => $value) {
				echo "<p>".$value."</p>";
			}

		?>
		</div><!--w50-->

		<div class="w50 left">
			<img  class="right" src='<?php echo INCLUDE_PATH_PAINEL.'/uploads/'.$info_autor[0]["foto"]; ?>' alt="imagem do autor do site">
		</div><!--w50-->

	</div><!--center-->
	<div class="clear"></div>


</section><!--autor-->
<section class="especialidades">
	<div class="center">

		<h2>Minhas especialidades</h2>

		<?php foreach ($especialidades as $key => $value) { ?>

			<div class="w33 left box-especialidade">
				<h3><i class="<?php echo $value['class']?>"></i></h3>
				<h4><?php echo $value['nome']?></h4>
				<p><?php echo $value['descricao']?></p>
			</div>

		<?php } ?>
		
	</div><!--center-->
	<div class="clear"></div>
</section><!--especialidades-->
<section class="extras">
	<div class="center">
		<div id="depoimentos" class="w50 left depoimentos-container">
			<h2 class="title">Depoimento dos nossos clientes</h2>

			<?php foreach ($depoimentos as $key => $value) { ?>
				
			<div class="depoimento-single">
				<p class="depoimento-descricao"><?php echo $value['depoimento'] ?></p>
				<p class="nome-autor"> <?php echo $value['nome'] ?> </p>
			</div><!--depoimento-single-->

			<?php } ?>

		</div><!--w50-->
		<div id="servicos" class="w50 left servicos-container">
			<h2 class="title">Serviços</h2>
			<div class="servicos">
			<ul>
			<?php
				foreach($servicos as $key => $value){
					echo '<li>'.$value['servico'].'</li>';
				}
			?>
			</ul>
			</div><!--servicos-->
		</div><!--w50-->
	</div><!--center-->
	<div class="clear"></div>
</section><!--depoimentos-->