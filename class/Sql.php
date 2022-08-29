<?php
	
#esse arquivo isola o banco de dados, e apenas precisamos usar duas linhas para acessar as informações através do select, esse arquivo permite acessar o banco de dados, fazer bindParam, executar e realizar um fetchAll()	
class Sql extends PDO {

	#variavel
	private $conn;


		#conexão com o banco de dados 
	public function __construct(){

			$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

	}

		public function setParams($statment,$parameters = array()){
			#chama o metodo setParam	
			foreach ($parameters as $key => $value) {
				$this->setParam($key,$value); 
			}

		}

	public function setParam($statment, $key,$value){

			$statment->bindParam($key, $value);

	}	

	#comandos sql, o parametro $params será um array
	public function query($rawQuery, $params = array()){
			$stmt = $this->conn->prepare($rawQuery);
			$this->setParams($stmt, $params);

			$stmt->execute();	
			return $stmt;
			
	}
	#acessa o banco de dados pega a informação retorna a informação
	public function select($rawQuery, $params = array()): array{
		$stmt = $this->query($rawQuery, $params);
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}

	



?>