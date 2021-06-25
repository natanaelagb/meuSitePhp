<?php

		$mail = new Email('smtp.gmail.com','natanknight@gmail.com','natan0000','Natanael');
		if(isset($_POST['submit']) && $_POST['identificador'] == 'post_home'){
			if($_POST['email'] != ""){
				$email = $_POST['email'];

				
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$mail->addAdress('natanknight@gmail.com','Natanael');
					$info = array('assunto'=>'Novo Email cadastrado no site!','corpo'=>'Email cadastrado no site:<hr>'.$email);
					$mail->formatEmail($info);
					$mail->sendEmail();
				}
				else{
					echo '<script>alert("Email invalido!")</script>';
				}
			}else{
				echo '<script>alert("Campos vazios não são permitidos!")</script>';
			}
		}else if(isset($_POST['submit']) && $_POST['identificador'] == 'post_contato'){
			$corpo = "";
			foreach ($_POST as $key => $value) {
				if($key != 'submit' && $key != 'identificador')
					$corpo.= ucfirst($key).": ".$value."<hr>";
			}
			$info = array('assunto'=>'Nova mensagem de contato!','corpo'=>$corpo);
			$mail->addAdress('natanknight@gmail.com','Natanael');
			$mail->formatEmail($info);
			$mail->sendEmail();

		}
	?>