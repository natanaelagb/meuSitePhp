<?php 

	if(isset($_POST['acao'])){

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$foto = $_FILES['foto'];
		$foto_atual = $_POST['foto-atual'];


		if($foto['name'] != '')
		{
			if(Painel::validarImagem($foto,true))
			{

				$foto = Painel::carregarImagem($foto, true);
				if(Painel::atualizar("id=?", array('nome'=>$nome,'descricao'=>$descricao,'foto'=>$foto,'id'=>$id), 'tb_site.autor'))
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

			if(Painel::atualizar("id=?",array('nome'=>$nome,'descricao'
				=> $descricao,'foto'=>$foto,'id'=>$id),'tb_site.autor'))
				Painel::alerta("Informações atualizadas com sucesso!");
			else
				Painel::alerta("Ocorreu um erro ao atualizar as informações!");
		}
	
	}else if (isset($_POST['acao-especialidades'])) {

		$id = $_POST['id'];
		$class = $_POST['class'];
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];

		if(Painel::atualizar('id=?',array('class'=>$class, 'nome'=>$nome, 'descricao'=>$descricao, 'id'=>$id),'tb_site.especialidades'))
			Painel::alerta("Informações atualizadas com sucesso!");
		else
			Painel::alerta("Ocorreu um erro ao atualizar as informações!");
		
	}



	$autor = Painel::selecionarTudo("*",'tb_site.autor');
	$especialidades = Painel::selecionarTudo("*",'tb_site.especialidades');

	

?>

<div class="content">
	<div class="box-content">

	<form method="post" enctype="multipart/form-data">
	
		<h2 style="text-align: center; font-size: 25px;" >Informações sobre o Autor</h2>
		<br><br>

		<div class="form-group w100 left">
			<label><i class="fas fa-user"></i>   Nome do Autor</label>
			<input type="text" name="nome" value = "<?php echo $autor[0]['nome'];?>" required>
		</div>

		<div class="form-group w100 left">
			<label><i class="fas fa-user"></i>  Descrição do Autor</label>
			<textarea style="height: 120px;" name="descricao" required=""><?php echo $autor[0]['descricao'];?>
			</textarea>
		</div>
		
		<div class="form-group w50 left" >
			<label><i class="fas fa-image"></i>   Imagem do Autor</label>
			<input type="file" name="foto" />
		</div>

		<input type="hidden" name="foto-atual" value="<?php echo $autor[0]['foto'] ?>">
		<input type="hidden" name="id" value="<?php echo $autor[0]['id'] ?>">

		<div class="form-group w50 left" >
			<img width="200px" id="imagem" src='<?php echo INCLUDE_PATH_PAINEL."uploads/".$autor[0]["foto"];?>'>
		</div>

		<div class="clear"></div>

		<div class="form-group left">
			<input type="submit" name="acao" value="Atualizar Dados">
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
				<input type="text" name="nome" value = "<?php echo $value['nome'];?>" required>
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>  Descrição da Especialidade</label>
				<textarea style="height: 120px; margin-bottom: 20px;" name="descricao" required=""><?php echo $value['descricao']; ?>
				</textarea>
			</div>
			
			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>  Classe do Icone</label>
				<input type="text" name="class" value="<?php echo $value['class'];?>" />
			</div>

			<div class="form-group w50 left" >
				<i style="font-size: 100px " id="imagem" class="<?php echo $value['class']; ?>"></i>
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