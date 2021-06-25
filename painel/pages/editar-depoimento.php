<?php
	
	if(isset($_POST['acao'])){

		if(Painel::atualizar("id = ?",$_POST,"tb_site.depoimentos"))
			Painel::alerta("Depoimento atualizado com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao atualizar o depoimento!");
	}


	if(isset($_GET['id'])){

		$conteudo = Painel::selecionarUm("id=?",array($_GET['id']),"tb_site.depoimentos");

		if($conteudo == ''){
			header('Location: '.INCLUDE_PATH_PAINEL.'listar-depoimentos');
			die();
		}		

	}else{
		header('Location: '.INCLUDE_PATH_PAINEL.'listar-depoimentos');
		die();
	}


?>

<div class="content">	
	<div class="box-content">
		<form method="post">

			<div class="form-group w100 left">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" value="<?php echo $conteudo['nome']?>" required>
			</div>

			<div class="form-group w100 left">
				<label><i class="fas fa-comment-alt"></i>   Depoimento</label>
				<textarea name="depoimento" placeholder="Insira aqui seu depoimento..."><?php echo $conteudo['depoimento']?></textarea>
			</div>
			
			<div id="hidden">
				<input type="hidden" name="id" value="<?php echo $conteudo['id']?>">
				<input type="hidden" name="data" value="<?php echo date("d-m-Y")?>">
			</div>

			<div class="clear"></div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Atualizar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>
</div>