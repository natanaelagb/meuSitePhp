<?php


	class Email
	{
		private $mailer;

		public function __construct($host,$username,$password,$name)
		{
			$this->mailer = new PHPMailer;


                   		
		    $this->mailer->isSMTP();                                           
		    $this->mailer->Host   	  = $host;                   				 
		    $this->mailer->SMTPAuth   = true;                                   
		    $this->mailer->Username   = $username;                    			 
		    $this->mailer->Password   = $password;                              
		    $this->mailer->SMTPSecure = 'tls';
		    $this->mailer->Port       = 587; 

		    $this->mailer->setFrom($username,$name);
		    $this->mailer->isHTML(true);   

		    
		}

		public function addAdress($username,$name){
		    $this->mailer->addAddress($username,$name); 
		}

		public function formatEmail($info){
			$this->mailer->Subject = $info['assunto'];
		    $this->mailer->Body    = $info['corpo'];
		    $this->mailer->AltBody = strip_tags($info['corpo']);
		}

		public function sendEmail(){
			if($this->mailer->send()){
		    	return true;
		    }else{
		    	return false;
		    }
		}

		
	}    

?>