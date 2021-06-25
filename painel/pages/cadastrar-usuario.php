<?php
	permissaoVisualizarPagina($_SESSION['cargo']);



	if(isset($_POST['acao']))
	{
		$user = $_POST['user'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$nome = $_POST['nome'];
		$cargo = $_POST['cargo'];
		$image = $_FILES['image'];

		if(Usuario::validarCadastro($user,$password,$email,$nome,$cargo))
		{
			if($image['name'] != '')
			{
				if(Painel::validarImagem($image))
				{
					$image = Painel::carregarImagem($image);
					if(Usuario::inserirUsuario($user,$password,$email,$nome,$cargo,$image))
					{
						Painel::alerta("Conta Cadastrada com sucesso!");
					}
					else
						Painel::alerta("Ocorreu um erro ao Cadastrar a conta!");
				}
				else
					Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 300KB!");
			}
			else
			{

				$image = '';

				if(Usuario::inserirUsuario($user,$password,$email,$nome,$cargo,$image))
				{
					Painel::alerta("Conta Cadastrada com sucesso!");
				}
				else
					Painel::alerta("Ocorreu um erro ao Cadastrar a conta!");

			}
		}
	}

?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" required>
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-key"></i>   Usuário</label>
				<input type="text" name="user" required>
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-key"></i>   Password</label>
				<input type="password" name="password" required >
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-envelope"></i>   E-mail</label>
				<input type="email" name="email" required>
			</div>

			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Imagem</label>
				<input type="file" name="image"/>
			</div>

			<div class="form-group w50 left">
				<label><i class="fas fa-sitemap"></i>   Cargo</label>
				<select name="cargo">
					<option value="0">Normal</option>
					<option value="1">Sub-Administrador</option>
					<option value="2">Administrador</option>
				</select>
			</div>

			<div class="clear"></div>

			<div class="form-group left" >
				<input type="submit" name="acao" value="Cadastrar">
			</div>

			<div class="clear"></div>	
		</form>
	</div>

</div>