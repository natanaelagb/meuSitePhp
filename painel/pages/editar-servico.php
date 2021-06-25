<?php
	
	if(isset($_POST['acao'])){

		if(Painel::atualizar("id = ?",$_POST,"tb_site.servicos"))
			Painel::alerta("Serviço atualizado com sucesso!");
		else
		{
			header('Location: '.INCLUDE_PATH_PAINEL.'listar-servicos');
			die();
		}
	}


	if(isset($_GET['id'])){

		$conteudo = Painel::selecionarUm("id=?",array($_GET['id']),"tb_site.servicos");

		if(count($conteudo)==0){
			header('Location: '.INCLUDE_PATH_PAINEL.'listar-servicos');
			die();
		}		

	}else{
		header('Location: '.INCLUDE_PATH_PAINEL.'listar-servicos');
		die();
	}


?>

<div class="content">	
	<div class="box-content">
		<form method="post">

			<div class="form-group w100 left">
				<label><i class="fas fa-comment-alt"></i>   Serviço</label>
				<textarea name="servico" placeholder="Insira aqui seu serviço..."><?php echo $conteudo['servico']?></textarea>
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