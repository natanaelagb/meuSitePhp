<?php 

	if(isset($_POST['acao-autor'])){

		$id = $_POST['id'];
		$nome = $_POST['nome-autor'];
		$descricao = $_POST['descricao-autor'];
		$foto = $_FILES['foto-autor'];
		$foto_atual = $_POST['foto-autor-atual'];


		if($foto['name'] != '')
		{
			if(Painel::validarImagem($foto,true))
			{

				$foto = Painel::carregarImagem($foto, true);
				if(Painel::atualizar("id=?",array('nome-autor'=>$nome,'descricao-autor'=>$descricao,'foto-autor'=>$foto,'id'=>$id),'tb_site.editar'))
				{
					Painel::alerta("Informações atualizadas com sucesso!");
					Painel::deletarImagem($foto_atual);
				}
				else
					Painel::alerta("Ocorreu um erro ao atualizar as Informações!");
			}
			else
				Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 1000KB!");

		}
		else
		{
			$foto = $foto_atual;

			if(Painel::atualizar("id=?",array('nome-autor'=>$nome,'descricao-autor'
				=> $descricao,'foto-autor'=>$foto,'id'=>$id),'tb_site.editar'))
				Painel::alerta("Informações atualizadas com sucesso!");
			else
				Painel::alerta("Ocorreu um erro ao atualizar as informações!");
		}
	
	}else if (isset($_POST['acao-especialidades'])) {

		$id = $_POST['id'];
		$classe = $_POST['classe'];
		$nome = $_POST['nome-especialidade'];
		$descricao = $_POST['descricao-especialidade'];

		if(Painel::atualizar('id=?',array('classe'=>$classe, 'nome-especialidade'=>$nome, 'descricao-especialidade'=>$descricao, 'id'=>$id),'tb_site.especialidades'))
			Painel::alerta("Informações atualizadas com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao atualizar as informações!");
		
	}



	$autor = Painel::selecionarTudo("*",'tb_site.editar');
	$especialidades = Painel::selecionarTudo("*",'tb_site.especialidades');


?>

<div class="content">
	<div class="box-content">

	<form method="post" enctype="multipart/form-data">
	
		<h2 style="text-align: center; font-size: 25px;" >Informações sobre o Autor</h2>
		<br><br>

		<div class="form-group w100 left">
			<label><i class="fas fa-user"></i>   Nome do Autor</label>
			<input type="text" name="nome-autor" value = "<?php echo $autor[0]['nome-autor'];?>" required>
		</div>

		<div class="form-group w100 left">
			<label><i class="fas fa-user"></i>  Descrição do Autor</label>
			<textarea style="height: 120px;" name="descricao-autor" required=""><?php echo $autor[0]['descricao-autor'];?>
			</textarea>
		</div>
		
		<div class="form-group w50 left" >
			<label><i class="fas fa-image"></i>   Imagem do Autor</label>
			<input type="file" name="foto-autor" />
		</div>

		<input type="hidden" name="foto-autor-atual" value="<?php echo $autor[0]['foto-autor'] ?>">
		<input type="hidden" name="id" value="<?php echo $autor[0]['id'] ?>">

		<div class="form-group w50 left" >
			<img width="200px" id="imagem" src='<?php echo INCLUDE_PATH_PAINEL."uploads/".$autor[0]["foto-autor"];?>'>
		</div>

		<div class="clear"></div>

		<div class="form-group left">
			<input type="submit" name="acao-autor" value="Atualizar Dados">
		</div>	

		<div class="clear"></div>


	</form>
	</div><!--box-content-->

	<div class="box-content">

		<h2 style="text-align: center; font-size: 25px;" >Especialidades</h2>
		<br><br>

		<?php foreach ($especialidades as $key => $value) { ?>
		<form method="post">

		<div class="box-especialidade">
			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>   Nome da Especialidade</label>
				<input type="text" name="nome-especialidade" value = "<?php echo $value['nome-especialidade'];?>" required>
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>  Descrição da Especialidade</label>
				<textarea style="height: 120px; margin-bottom: 20px;" name="descricao-especialidade" required=""><?php echo $value['descricao-especialidade']; ?>
				</textarea>
			</div>
			
			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>  Classe do Icone</label>
				<input type="text" name="classe" value="<?php echo $value['classe'];?>" />
			</div>

			<div class="form-group w50 left" >
				<i style="font-size: 100px " id="imagem" class="<?php echo $value['classe']; ?>"></i>
			</div>

			<input type="hidden" name="id" value="<?php echo $value['id'] ?>">

			<div class="clear"></div>

			<div class="form-group left">
				<input type="submit" name="acao-especialidades" value="Atualizar Dados">
			</div>	
			<div class="clear"></div>

		</form>

		</div><!--box-especialidade-->
		<?php } ?>

		
	</div><!--box-contetn-->

</div>