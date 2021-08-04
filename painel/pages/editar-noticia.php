<?php 

	if(isset($_POST['acao'])){

		$titulo = $_POST['titulo'];
		$slug = Painel::gerarSlug($titulo);
		$conteudo = $_POST['conteudo'];
		$capa = $_FILES['capa'];
		$capa_atual = $_POST['capa-atual'];
		$categoria = $_POST['categoria'];
		$data = $_POST['data'];
		$id = $_POST['id'];


		if($capa['name'] != '')
		{
			if(Painel::validarImagem($capa,true))
			{

				$capa = Painel::carregarImagem($capa);
				if(Painel::atualizar("id=?",array('titulo'=>$titulo,'slug'=>$slug,'conteudo'=>$conteudo,'capa'=>$capa,'categoria'=>$categoria,'data'=>$data,'id'=>$id),'tb_site.noticias'))
				{
					Painel::alerta("Notícia atualizada com sucesso!");
					Painel::deletarImagem($capa_atual);
				}
				else
					Painel::alerta("Ocorreu um erro ao atualizar a notícia!");
			}
			else
				Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 1000KB!");

		}
		else
		{
			$capa = $capa_atual;

			if(Painel::atualizar("id=?",array('titulo'=>$titulo,'slug'=>$slug,'conteudo'=>$conteudo,'capa'=>$capa,'categoria'=>$categoria,'data'=>$data,'id'=>$id),'tb_site.noticias'))
				Painel::alerta("Notícia atualizada com sucesso!");
			else

				Painel::alerta("Ocorreu um erro ao atualizar a notícia!");
		}
	
	}


	if(isset($_GET['id'])){

		$conteudo = Painel::selecionarUm("id=?",array($_GET['id']),"tb_site.noticias");

		if($conteudo == ''){
			header('Location: '.INCLUDE_PATH_PAINEL.'gerenciar-noticias');
			die();
		}		

	}else{
		header('Location: '.INCLUDE_PATH_PAINEL.'gerenciar-noticias');
		die();
	}

	$categorias = Painel::selecionarTudo("*",'tb_site.categorias');

?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>   Título</label>
				<input type="text" name="titulo" value = "<?php echo $conteudo['titulo'];?>" required>
			</div>

			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Categoria</label>
				<select name="categoria">

				<?php foreach ($categorias as $key => $value) { ?>
				
					<option  value="<?php echo $value['nome'] ?>"
						 <?php 
						 	if($conteudo['categoria'] == $value['nome'])
						 		echo "selected"; 
						 ?>>
						<?php echo $value['nome'] ?>	
					</option>

				<?php  } ?>

				</select>
			</div>	


			<div class="form-group w100">
				<label><i class="fas fa-user"></i>   Conteúdo</label>
				<textarea class="tinymce" name="conteudo" required=""><?php echo $conteudo['conteudo'];?>
				</textarea>
				
			</div>
	
			
			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Capa</label>
				<input type="file" name="capa" >
			</div>

			<div class="form-group w50 left" >
				<img width="200px" id="imagem" src='<?php echo INCLUDE_PATH_PAINEL."uploads/".$conteudo["capa"];?>'>
			</div>

			<div class="form-group w50 left">
				<label>Data:</label>
				<input formato="data" type="text" name="data" value="<?php echo $conteudo['data'] ?>">
			</div>

			<input type="hidden" name="capa-atual" value="<?php echo $conteudo['capa'];?>">
			<input type="hidden" name="id" value="<?php echo $conteudo['id'];?>">

			<div class="clear"></div>

			<div class="form-group left">
				<input type="submit" name="acao" value="Atualizar Dados">
			</div>	

		<div class="clear"></div>
		</form>
	</div>

</div>