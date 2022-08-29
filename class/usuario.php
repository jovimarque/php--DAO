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

	public function __toString(){
			return json_encode(array("idusuario"=>$this->getIdUsuario(),
				"deslogin"=>$this->getDeslogin(),
				"dessenha"=>$this->getDessenha(),
				"dtcadastro"=>$this->getDtcadastro()
			));
	}	
}




?>