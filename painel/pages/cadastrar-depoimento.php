<?php 
	if(isset($_POST['acao'])){

		if(Painel::inserir($_POST,"tb_site.depoimentos"))
			Painel::alerta("Depoimento cadastrado com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao cadastrar o depoimento!");

	}

?>
<div class="content">	
	<div class="box-content">
		<form method="post">

			<div class="form-group w100 left">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" value="<?php recuperarPost('nome')?>" required>
			</div>

			<div class="form-group w100 left">
				<label><i class="fas fa-comment-alt"></i>   Depoimento</label>
				<textarea name="depoimento"  placeholder="Insira aqui seu depoimento..."><?php recuperarPost('depoimento')?>
					
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