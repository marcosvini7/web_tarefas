<?php 

class Usuario{
	private $id;
	private $nome;
	private $email;
	private $senha;

	function __get($attr){
		return $this->$attr;
	}

	function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>