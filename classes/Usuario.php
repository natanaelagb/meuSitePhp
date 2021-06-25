<?php


	class Usuario
	{
	
		public static function inserirUsuario($user,$password,$email,$nome,$cargo,$img){

			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.usuarios` (id,user,password,email,nome,cargo,img) VALUES (NULL,?,?,?,?,?,?)");
			if($sql->execute(array($user,$password,$email,$nome,$cargo,$img))){
				return true;
			}else
				return false;

		}
		
		public static function atualizarUsuario($password,$email,$nome,$img,$user){
			$sql = MySql::connect()->prepare("UPDATE `tb_admin.usuarios` SET password = ?, email = ?, nome = ?, img = ? WHERE user = ?");
			if($sql->execute(array($password,$email,$nome,$img,$user)) == true)
			{
				$_SESSION['password'] = $password;
				$_SESSION['email'] = $email;
				$_SESSION['nome'] = $nome;
				$_SESSION['img'] = $img;

				return true;
			}
			else{
				return false;
			}
		}

		public static function validarCadastro($user,$password,$email,$nome,$cargo)
		{

			$sql = MySql::connect()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=? OR email=?");
			$sql->execute(array($user,$email));
	
			if($user == ''){
				Painel::alerta("O campo Usuário está vazio!");
				return false;
			}
			else if($sql->rowCount() >= 1){
				Painel::alerta("O Usuário ou Email já está cadastrado no sistema");
				return false;
			}
			else if($password == ''){
				Painel::alerta("O campo Password está vazio!");
				return false;
			}
			else if($email == ''){
				Painel::alerta("O campo Email está vazio!");
				return false;
			}
			else if($nome == ''){
				Painel::alerta("O campo Nome está vazio!");
				return false;
			}
			else if($cargo >= $_SESSION['cargo']){
				Painel::alerta("Você não tem permissão para selecionar este cargo!");
				return false;
			}
			else 
				return true;
		}


	}


?>