<?php
	permissaoVisualizarPagina($_SESSION['cargo']);

	if(isset($_POST['acao']))
	{
		$nome = $_POST['nome'];
		$slide = $_FILES['slide'];
		
		if($slide['name'] != '' && $nome != '')
		{
			if(Painel::validarImagem($slide,true))
			{
				$slide = Painel::carregarImagem($slide);
				$retorno = Painel::inserir(array('nome'=>$nome,'slide'=>$slide),'tb_site.slides');
				if($retorno)
				{
					Painel::alerta("Slide cadastrado com sucesso!");
				}
				else
					Painel::alerta("Ocorreu um erro ao Cadastrar o slide!");
			}
			else
				Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 1000KB!");
		}else
			Painel::alerta("Todos os campos devem ser preenchidos!");

	}
	
?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group w100">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" value="<?php recuperarPost('nome')?>" required>
			</div>


			<div class="form-group w100" >
				<label><i class="fas fa-image"></i>   Slide</label>
				<input type="file" name="slide" required />
			</div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Cadastrar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>

</div>