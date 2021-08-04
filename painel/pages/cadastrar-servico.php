<?php 
	if(isset($_POST['acao'])){

		if(Painel::inserir($_POST,"tb_site.servicos"))
			Painel::alerta("Serviço cadastrado com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao cadastrar o serviço!");

	}

?>
<div class="content">	
	<div class="box-content">
		<form method="post">


			<div class="form-group w100 left">
				<label><i class="fas fa-cogs"></i>   Serviço</label>
				<textarea name="servico" placeholder="Insira aqui seu serviço..."><?php recuperarPost('servico')?>
				</textarea>
			</div>
			
			<input type="hidden" name="data" value='<?php echo date("d/m/Y")?>'>

			<div class="clear"></div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Cadastrar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>
</div>