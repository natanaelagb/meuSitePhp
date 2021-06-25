
<?php

	include("../config.php");
	
	if(Painel::login()){
		include("main.php");
	}else{
		include("login.php");
	}


?>