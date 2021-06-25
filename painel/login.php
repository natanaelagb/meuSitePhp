<?php
	if(isset($_COOKIE['lembrar'])){
		$user=$_COOKIE['user'];
		$password=$_COOKIE['password'];

		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));

		if($sql->rowCount() == 1){
			$info = $sql->fetch();
			$_SESSION['login'] = true;
			$_SESSION['user'] = $user;
			$_SESSION['password'] = $password;
			$_SESSION['email'] = $info['email'];
			$_SESSION['nome'] = $info['nome'];
			$_SESSION['cargo'] = $info['cargo'];
			$_SESSION['img'] = $info['img'];
		}
		header('Location: '.INCLUDE_PATH_PAINEL);
		die();
	}

?>

<?php

	if(isset($_POST['acao'])){

		$user = $_POST['user'];
		$password = $_POST['password'];
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));
		if($sql->rowCount() == 1){
			$info = $sql->fetch();
			$_SESSION['login'] = true;
			$_SESSION['user'] = $user;
			$_SESSION['password'] = $password;
			$_SESSION['email'] = $info['email'];
			$_SESSION['nome'] = $info['nome'];
			$_SESSION['cargo'] = $info['cargo'];
			$_SESSION['img'] = $info['img'];
			if(isset($_POST['lembrar'])){
				setcookie('lembrar',true,time()+(60*60*24),'/');
				setcookie('user',$user,time()+(60*60*24),'/');
				setcookie('password',$password,time()+(60*60*24),'/');
			}
			header('Location: '.INCLUDE_PATH_PAINEL);
			die();
		}
		else
		{	
			Painel::alerta("O Usuario ou a Senha está incorreto!");

		}
		

	}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Página de Login</title>
	<link rel="stylesheet"  href="<?php echo INCLUDE_PATH_PAINEL?>/estilo/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH?>estilo/all.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="icon" type="image/x-icon" href="<?php echo INCLUDE_PATH?>favicon.ico">
</head>
<body>

	<div class="site-btn">
		<a  href="<?php echo INCLUDE_PATH?>"><i class="fas fa-home"></i></a>
	</div>

	<div class="login">
		<p>Login</p>
		<form method="post">
			<div class="form-login">
				<input type="text" name="user" placeholder="Usuário" required="">
			</div>
			<div class="form-login">
				<input type="password" name="password" placeholder="Senha"  required="">
			</div>
			<div class="form-login">
				<input type="checkbox" name="lembrar">
				<label>Manter conexão</label>
			</div>
			<div class="form-login">
				<input type="submit" name="acao" value="Logar">
			</div>
				
		</form>

	</div>
	<script src="<?php echo INCLUDE_PATH;?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH_PAINEL;?>js/login.js"></script>
</body>
</html>