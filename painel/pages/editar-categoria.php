<?php
	
	if(isset($_POST['acao'])){

		$categoria = $_POST['nome'];
		$id = $_POST['id'];


		if( Painel::selecionarUm("nome=? AND id != ?",array($categoria,$id),'tb_site.categorias') == 0)
		{
			if(Painel::atualizar("id = ?",$_POST,"tb_site.categorias"))
				Painel::alerta("Categoria atualizada com sucesso!");
			else
				Painel::alerta("Ocorreu um erro ao atualizar a categoria!");
		}
		else
			Painel::alerta("A categoria já foi inserida!");

	}


	if(isset($_GET['id'])){

		$conteudo = Painel::selecionarUm("id=?",array($_GET['id']),"tb_site.categorias");

		if($conteudo == ''){
			header('Location: '.INCLUDE_PATH_PAINEL.'gerenciar-categorias');
			die();
		}		

	}else{
		header('Location: '.INCLUDE_PATH_PAINEL.'gerenciar-categorias');
		die();
	}


?>

<div class="content">	
	<div class="box-content">
		<form method="post">

			<div class="form-group w100 left">
				<label><i class="fas fa-user"></i>   Categoria</label>
				<input type="text" name="nome" value="<?php echo $conteudo['nome']?>" required>
			</div>
			
			<div id="hidden">
				<input type="hidden" name="id" value="<?php echo $conteudo['id']?>">
			</div>

			<div class="clear"></div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Atualizar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>
</div>