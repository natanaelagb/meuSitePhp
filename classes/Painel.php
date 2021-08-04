<?php  


class Painel 
{
	public static function gerarSlug($str){
        $str = mb_strtolower($str); //Vai converter todas as letras maiúsculas pra minúsculas
        $str = preg_replace('/(â|á|ã)/', 'a', $str);
        $str = preg_replace('/(ê|é)/', 'e', $str);
        $str = preg_replace('/(í|Í)/', 'i', $str);
        $str = preg_replace('/(ú)/', 'u', $str);
        $str = preg_replace('/(ó|ô|õ|Ô)/', 'o',$str);
        $str = preg_replace('/(_|\/|!|\?|#)/', '',$str);
        $str = preg_replace('/( )/', '-',$str);
        $str = preg_replace('/ç/','c',$str);
        $str = preg_replace('/(-[-]{1,})/','-',$str);
        $str = preg_replace('/(,)/','-',$str);
        $str=strtolower($str);
        return $str;
    }  

	public static function login(){
		return isset($_SESSION["login"]) ? true : false;
	}	

	public static function logout(){
		setcookie('lembrar',true,time()-1,'/');
		setcookie('password',true,time()-1,'/');

		session_destroy();
		header("Location: ".INCLUDE_PATH_PAINEL);
	}
	
	public static function updateUsuariosOnline()
	{	

		if(isset($_SESSION['online']))
		{
			$token = $_SESSION['online'];
			$dataAtual = date("Y-m-d H:i:s");
			$sql = MySql::connect()->prepare("UPDATE `tb_admin.online` SET ultima_acao=? WHERE token=?");
			$sql->execute(array($dataAtual,$token));

			if($sql->rowCount() == 0)
			{
				$ip = $_SERVER['REMOTE_ADDR'];	
				$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
				$sql->execute(array($ip,$dataAtual,$token));
			}
		}
		else
		{
			$ip = $_SERVER['REMOTE_ADDR'];	
			$_SESSION['online'] = uniqid();
			$token = $_SESSION['online'];
			$dataAtual = date("Y-m-d H:i:s");
			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.online` VALUES (null,?,?,?)");
			$sql->execute(array($ip,$dataAtual,$token));

		}
	}

	public static function listarUsuariosOnline()
	{
		self::limparUsuariosOnline();
		$sql = MySql::connect()->prepare("SELECT * FROM `tb_admin.online`");
		$sql->execute();
		$conteudo = $sql->fetchAll();
		return $conteudo;

	}

	public static function limparUsuariosOnline()
	{
		$dataAtual = date("Y-m-d H:i:s");
		MySql::connect()->exec("DELETE FROM `tb_admin.online` WHERE ultima_acao < '$dataAtual' - INTERVAL 1 MINUTE");
	}

	public static function listarUsuariosCadastrados()
	{
		$sql= MySql::connect()->prepare("SELECT nome,cargo FROM `tb_admin.usuarios`");
		$sql->execute();
		$cadastrados= $sql->fetchAll();

		return $cadastrados;

	}

	public static function contador()
	{
		if(!isset($_COOKIE['visita']))
		{
			setcookie("visita","true",time()+(60*60*24));
			$ip = $_SERVER['REMOTE_ADDR'];
			$dia = date("Y-m-d");
			$sql = MySql::connect()->prepare("INSERT INTO `tb_admin.visitas` VALUES(null,?,?)");
			$sql->execute(array($ip,$dia));
		}

	}

	public static function alerta($mensagem){

		echo '<div class="overlay-alert" style="display:block;">
		</div>
			<div class="box-alert" style="display:block;">
			<p>'.$mensagem.'</p>
			<input type="button"  value="Ok">
		</div>';

	}

	public static function inserir($matriz,$tabela){


		$query = "INSERT INTO `$tabela` VALUES(NULL";
		foreach ($matriz as $key => $value) 
		{
			if($key == 'acao' || $key == 'hidden'){
				continue;
			}
			if($value== ''){
				Painel::alerta("Todos os campos devem ser preenchidos!");
				return false;
			}
			$conteudo[]=$value;
			$query.=',?';
		}
		$conteudo[]= 0;
		$query.=",?)";
		$sql = MySql::connect()->prepare($query);

		if($sql->execute($conteudo)){

			$lastId = MySql::connect()->lastInsertId();
			$sql = MySql::connect()->prepare("UPDATE `$tabela` SET order_id=? WHERE id=$lastId");
			$sql->execute(array($lastId));

			return true;

		}else
			return false;

	}

	public static function selecionarTudo($campos,$tabela,$indice=null,$quantidade=null,$ordem = 'id'){

		if($quantidade!=null)
			$sql = MySql::connect()->prepare("SELECT $campos FROM `$tabela` ORDER BY $ordem LIMIT $indice,$quantidade ");
		else
			$sql = MySql::connect()->prepare("SELECT $campos FROM `$tabela` ORDER BY $ordem");

		$sql->execute();

		return $sql->fetchAll();
	}

	public static function selecionarUm($query,$arr,$tabela){

		$sql = MySql::connect()->prepare("SELECT * FROM `$tabela` WHERE $query");

		$sql->execute($arr);

		return $sql->fetch();
	}

	public static function comandoPorQuery($query, $metodo_id, $arr = null){

		$sql = MySql::connect()->prepare($query);
		$sql->execute($arr);

		switch ($metodo_id) {
			case 1:
				return $sql->fetchAll();
				break;

			case 2:
				return $sql->fetch();
				break;

			case 3:
				return $sql->rowCount();
				break;
		}
		
	}

	public static function deletar($arr,$tabela, $query=false){

		if($query==false){
			$sql = MySql::connect()->prepare("DELETE FROM `$tabela`");
			$sql->execute();
		}	
		else{
			$sql = MySql::connect()->prepare("DELETE FROM `$tabela` WHERE $query");
			$sql->execute($arr);
		}

		return $sql->rowCount();

	}

	static public function atualizar($where,$arr,$tabela){

		$query = "UPDATE `$tabela` SET ";
		$primeiro = true;
		$query2 = "";

		foreach ($arr as $nome => $valor) {
			if($nome == 'acao' || $nome == 'id' || $nome == 'acao-autor' || $nome == 'acao-especialidades'){
				continue;
			}
			if($valor == ''){
				Painel::alerta("Todos os campos devem ser preenchidos!");
				return false;
			}
			$conteudo[]=$valor;

			if($primeiro){
				$query.= "`$nome`".'=?';
				$primeiro = false;
				$query2 .= "`$nome`".'=?';
			}
			else{
				$query.= ','."`$nome`".'=?';
				$query2 .= " AND `$nome`".'=?';
			}
		}


		$conteudo[]= $arr['id'];
		$query .= ' WHERE '.$where;
		$query2 .= 'AND id = ?';

		if(Painel::selecionarUm($query2,$conteudo,$tabela) != 0){
			return true;
		}
//

		$sql = MySql::connect()->prepare($query);
		$retorno = $sql->execute($conteudo);

		if ($sql->rowCount()==0 || $retorno == false)
			return false;
		else
			return true;

	}

	public static function ordenar($orderType,$id,$tabela){

		if($orderType == 'up'){

			$orderIdAtual = Painel::selecionarUm("id=?",array($_GET['id']),$tabela);
			$orderIdUp = Painel::selecionarUm("order_id < ? ORDER BY order_id DESC",array($orderIdAtual['order_id']),$tabela);

			if($orderIdUp == '')
				return;
			else
			{
				Painel::atualizar("id = ?",array('order_id'=>$orderIdUp['order_id'],'id'=>$id),$tabela);

				Painel::atualizar("id = ?",array('order_id'=>$orderIdAtual['order_id'],'id'=>$orderIdUp['id']),$tabela);
			}


		}else if($orderType == 'down'){

			$orderIdAtual = Painel::selecionarUm("id=? ",array($_GET['id']),$tabela);
			$orderIdDown = Painel::selecionarUm("order_id > ? ORDER BY order_id ASC",array($orderIdAtual['order_id']),$tabela);

			if($orderIdDown == '')
				return;
			else
			{
				Painel::atualizar("id = ?",array('order_id'=>$orderIdDown['order_id'],'id'=>$id),$tabela);

				Painel::atualizar("id = ?",array('order_id'=>$orderIdAtual['order_id'],'id'=>$orderIdDown['id']),$tabela);
			}


		}

	}


	public static function redirecionar($url){
		echo '<script>location.href="'.$url.'"</script>';
		die();
	}

	public static function validarImagem($image,$slide=false){
		if($image['type'] == 'image/jpg' || $image['type']  == 'image/jpeg' || $image['type']  == 'image/png'){

			$size = intval($image['size']/1000);

			if($size<=1000){
				if($slide == true)
					return true;
				else if($size <= 300)
					return true;
				return false;
			}
			else
				return false;
		
		}else
			return false;
	}

	public static function carregarImagem($image){

		$imagemFormato = explode('.', $image['name']);
		$imagemNome= uniqid().'.'.$imagemFormato[count($imagemFormato)-1];

		if(move_uploaded_file($image['tmp_name'],BASE_DIR_PAINEL.'uploads/'.$imagemNome))
			return $imagemNome;
		else
			return false;

	}

	public static function deletarImagem($image){	
		return @unlink('uploads/'.$image);
	}
}

?>