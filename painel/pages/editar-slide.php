<?php 

	if(isset($_POST['acao'])){

		$id = $_POST['id'];
		$nome = $_POST['nome'];
		$slide = $_FILES['slide'];
		$slide_atual = $_POST['slide-atual'];


		if($slide['name'] != '')
		{
			if(Painel::validarImagem($slide,true))
			{

				$slide = Painel::carregarImagem($slide);
				if(Painel::atualizar("id=?",array('nome'=>$nome,'slide'=>$slide,'id'=>$id),'tb_site.slides'))
				{
					Painel::alerta("Slide atualizado com sucesso!");
					Painel::deletarImagem($slide_atual);
				}
				else
					Painel::alerta("Ocorreu um erro ao atualizar o slide!");
			}
			else
				Painel::alerta("Formato de arquivo inválido ou tamanho do slide superior a 1000KB!");

		}
		else
		{
			$slide = $slide_atual;

			if(Painel::atualizar("id=?",array('nome'=>$nome,'slide'=>$slide,'id'=>$id),'tb_site.slides'))
				Painel::alerta("Slide atualizado com sucesso!");
			else

				Painel::alerta("Ocorreu um erro ao atualizar o slide!");
		}
	
	}


	if(isset($_GET['id'])){

		$conteudo = Painel::selecionarUm("id=?",array($_GET['id']),"tb_site.slides");

		if($conteudo == ''){
			header('Location: '.INCLUDE_PATH_PAINEL.'listar-slides');
			die();
		}		

	}else{
		header('Location: '.INCLUDE_PATH_PAINEL.'listar-slides');
		die();
	}


?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group w100 ">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" value = "<?php echo $conteudo['nome'];?>" required>
			</div>
			
			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Slide</label>
				<input type="file" name="slide" />
			</div>

			<div class="form-group w50 left" >
				<img width="200px" id="imagem" src='<?php echo INCLUDE_PATH_PAINEL."uploads/".$conteudo["slide"];?>'>
			</div>

			<input type="hidden" name="slide-atual" value="<?php echo $conteudo['slide'];?>">
			<input type="hidden" name="id" value="<?php echo $conteudo['id'];?>">

			<div class="form-group left">
				<input type="submit" name="acao" value="Atualizar Dados">
			</div>	

		<div class="clear"></div>
		</form>
	</div>

</div>