<?php

class Usuario {


	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function setIdUsuario($id){

		$this->idusuario = $id;	
	}


	public function getIdUsuario(){
		return $this->idusuario;
	}

	
	public function setDeslogin($login){

		$this->deslogin = $login;	
	}


	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDessenha($senha){

		$this->dessenha = $senha;	
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDtcadastro($data){

		$this->dtcadastro = $data;	
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}


	public function loadById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuario WHERE id = :ID", array(":ID"=> $id)); 

		if(count($result) > 1){

			$row = $result[0];
			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro($row['dtcadastro']);

		}
	}

	
	// essa função carrega estática carrega todos os usuários
	public  static function getList(){
		$sql = new Sql();
	return 	$sql->select("SELECT * FROM tb_usuario ORDER BY deslogin");
	}

	//essa  função estática carrega a lista de login pelo nome 
	public static function search($login){
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuario WHERE deslogin LIKE :SEARCH ORDER BY deslogin ", array('SEARCH'=>"%".$login."%"));
	}


	//essa função carrega o usuario após validar login e senha
	public function login($usario, $senha){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_usuario WHERE deslogin = :LOGIN AND dessenha = :SENHA" , array(
			":LOGIN"=> $usario,
			":SENHA"=>$senha

	)); 

		if(count($result) > 1){

			$row = $result[0];
			$this->setIdUsuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			$this->setDtcadastro($row['dtcadastro']);

		}else{

			throw new Exception("Login ou senha inválidos");
		}

	
	
	public function __toString(){
			return json_encode(array("idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()
			));
	}	
}




?>
