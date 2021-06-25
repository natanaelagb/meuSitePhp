<?php 
	if(isset($_POST['acao'])){
		$user = $_SESSION['user'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$nome = $_POST['nome'];
		$image = $_FILES['image'];
		$imagem_atual = $_POST['imagem_atual'];


		if($image['name'] != '')
		{
			if(Painel::validarImagem($image))
			{

				$image = Painel::carregarImagem($image);
				if(Usuario::atualizarUsuario($password,$email,$nome,$image,$user))
				{
					Painel::alerta("Conta Atualizada com sucesso!");
					Painel::deletarImagem($imagem_atual);

				}
				else
					Painel::alerta("Ocorreu um erro ao atualizar a conta!");

			}
			else
				Painel::alerta("Formato de arquivo inválido ou tamanho da imagem superior a 300KB!");

		}
		else
		{

			$image = $imagem_atual;

			if(Usuario::atualizarUsuario($password,$email,$nome,$image,$user))

				Painel::alerta("Conta Atualizada com sucesso!");

			else

				Painel::alerta("Ocorreu um erro ao atualizar a conta!");

		}

	}

?>

<div class="content">
	<div class="box-content">
		<form method="post" enctype="multipart/form-data">

			<div class="form-group w50 left">
				<label><i class="fas fa-user"></i>   Nome</label>
				<input type="text" name="nome" value = "<?php echo $_SESSION['nome'];?>" required>
			</div>
			<div class="form-group w50 left">
				<label><i class="fas fa-key"></i>   Password</label>
				<input type="password" name="password" value = "<?php echo $_SESSION['password'];?>" required>
			</div>
			<div class="form-group w50 left">
				<label><i class="fas fa-envelope"></i>   E-mail</label>
				<input type="email" name="email" value = "<?php echo $_SESSION['email'];?>" required>
			</div>
			<div class="form-group w50 left" >
				<label><i class="fas fa-image"></i>   Imagem</label>
				<input type="file" name="image"/>
				<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img'];?>">
			</div>
			<div class="form-group left">
				<input type="submit" name="acao" value="Atualizar Dados">
			</div>	

		<div class="clear"></div>
		</form>
	</div>

</div>