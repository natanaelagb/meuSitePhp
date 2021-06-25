<?php
	permissaoVisualizarPagina($_SESSION['cargo']);

	if(isset($_POST['acao']))
	{
		$titulo = $_POST['titulo'];
		$slug = Painel::gerarSlug($titulo);
		$conteudo = $_POST['conteudo'];
		$capa = $_FILES['capa'];
		$categoria = $_POST['categoria'];
		$data = $_POST['data'];
		
		if($capa['name'] != '' && $titulo != '' && $conteudo != '')
		{	

			if(Painel::selecionarUm("titulo=? AND categoria=?",array($titulo,$categoria),"tb_site.noticias") == 0)
			{
				if(Painel::validarImagem($capa,true))
				{
					$capa = Painel::carregarImagem($capa);

					if(Painel::inserir(array('titulo'=>$titulo,'slug'=>$slug,'conteudo'=>$conteudo,'capa'=>$capa,'categoria'=>$categoria,'data'=>$data),'tb_site.noticias'))
					Painel::alerta("Notícia cadastrada com sucesso!");			
				}
				else
					Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 1000KB!");

			}else
			Painel::alerta("A noticia inserida já está cadastrada nesta categoria!");

		}else
			Painel::alerta("Todos os campos devem ser preenchidos!");

	}

	$categorias = Painel::selecionarTudo("*","tb_site.categorias");
	
?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">


			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>   Título</label>
				<input type="text" name="titulo" value="<?php recuperarPost('titulo')?>" required>
			</div>

			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Categoria</label>
				<select name="categoria">

				<?php foreach ($categorias as $key => $value) { ?>
				
					<option <?php if($value['categoria'] == @$_POST['categoria']) echo 'selected' ?> value="<?php echo $value['categoria'] ?>">
						<?php echo $value['categoria'] ?>	
					</option>

				<?php  } ?>

				</select>	

			</div>


			<div class="form-group w100">
				<label><i class="fas fa-user"></i>   Conteúdo</label>
				<textarea class="tinymce" name="conteudo" placeholder="Digite aqui o conteúdo da notícia">
					<?php recuperarPost('conteudo')?>
				</textarea>
			</div>


			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Capa</label>
				<input type="file" name="capa" required />
			</div>

			<div class="form-group w50 left">
				<label>Data:</label>
				<input formato="data" type="text" name="data" value="<?php recuperarPost('data')?>">
			</div>
			
			<div class="clear"></div>
			<div class="form-group left" >
				<input type="submit" name="acao" value="Cadastrar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>

</div>