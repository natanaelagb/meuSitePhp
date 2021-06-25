<?php
	include('../config.php');
	$user = $_POST['user'];
	$password = $_POST['password'];
	$data = array();
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
		$data['retorno'] = true;
		//header('Location: '.INCLUDE_PATH_PAINEL);
	}else{
		$data['retorno'] = false;
	}
	die(json_encode($data));
?>