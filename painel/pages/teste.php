<?php
	$data = $_POST;
	if(isset($_POST)){
		$data['retorno']=true;
	}else{
		$data['retorno']=false;
	}
	die(json_encode($data));
?>