<?php
	include("../config.php");
	$mail = new Email('smtp.gmail.com','SEU EMAIL','SUA SENHA','SEU NOME DE USUARIO');
	$corpo = "";
	$data = array();
	foreach ($_POST as $key => $value){
		if($key != 'submit' && $key != 'identificador')
			$corpo.= ucfirst($key).": ".$value."<hr>";
	}
	$info = array('assunto'=>'Nova mensagem do site!','corpo'=>$corpo);
	$mail->addAdress('natanknight@gmail.com','Natanael');
	$mail->formatEmail($info);
	if($mail->sendEmail()){
		$data["retorno"]= true;
	}else{
		$data["retorno"] = false;
	}

	die(json_encode($data));
?>