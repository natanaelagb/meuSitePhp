<?php
	
	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	
	$autoload = function($class){
		if($class == 'Email'){
			include('classes/phpmailer/PHPMailerAutoLoad.php');
		}

		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);


	//contantes

	define("INCLUDE_PATH","http://localhost/projeto01/");
	define("INCLUDE_PATH_PAINEL","http://localhost/projeto01/painel/");
	define("BASE_DIR_PAINEL",__DIR__.'/painel/');

	define('HOST','localhost');
	define('DATABASE','phpprojeto01');
	define('USER','root');
	define('PASSWORD','');

	//funçoes
	function pegaCargo($cargo){
		$arr = array('0' => 'Normal', '1' =>'Sub-Administrador', '2' =>'Administrador');
		return $arr[$cargo];
	}

	function atualMenu($pagina){

		$url = @explode('/', $_GET['url'])[0];
		if($pagina == $url)
		{
			echo 'class="ativa-efeito"';
		}

	}

	function permissaoVisualizarMenu($cargo){

		if($cargo>=2){
			return;
		}else
			echo 'style="display:none;';

	}
	function permissaoVisualizarPagina($cargo){

		if($cargo>=2){
			return;
		}else{
			Painel::alerta("Você não tem permissão para visualizar esta página!");
			header("Location: http://localhost/projeto01/painel/");
			die();
			
		}

	}

	function recuperarPost($nome){
		if(isset($_POST[$nome])){
			echo $_POST[$nome];
		}
		else if(isset($_FILES[$nome])){
			echo $_FILES[$nome]['tmp_name'];
		}
	}


?>