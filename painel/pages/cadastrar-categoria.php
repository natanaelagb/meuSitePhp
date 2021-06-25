<?php 

	if(isset($_POST['acao'])){

		$categoria = $_POST['categoria'];
		$slug = Painel::gerarSlug($categoria);

		if(Painel::selecionarUm("categoria=?",array($_POST['categoria']),'tb_site.categorias') == 0){
			if(Painel::inserir(array("categoria"=>$categoria,'slug'=>$slug),"tb_site.categorias"))
			Painel::alerta("Categoria cadastrada com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao cadastrar a categoria!");

		}else{
			Painel::alerta("A categoria já foi inserida!");
		}	

	}

?>
<div class="content">	
	<div class="box-content">
		<form method="post">

			<div class="form-group w100 left">
				<label><i class="fas fa-user"></i>   Categoria</label>
				<input type="text" name="categoria" value="<?php recuperarPost('categoria')?>" required>
			</div>

			<div class="clear"></div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Cadastrar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>
</div>