<?php 

class Conexao{

	public function conectar(){
		try{
			$conexao = new PDO('mysql:host=localhost;dbname=web','root','');
			return $conexao;
		} catch (PDOException $e){
			echo 'Error: ' . $e->getMessage();
		}
	}
}

?>