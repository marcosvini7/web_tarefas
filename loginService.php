<?php 

class LoginService{
	private $conexao;
	private $usuario;

	function __construct(Conexao $conexao, Usuario $usuario){
		$this->conexao = $conexao->conectar();
		$this->usuario = $usuario;
	}

	function cadastrar(){
		$query = 'insert into tb_usuarios(nome, email, senha) values
		(:nome, :email, :senha)';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':nome', $this->usuario->nome);
		$stmt->bindValue(':email', $this->usuario->email);
		$stmt->bindValue(':senha', $this->usuario->senha);
		return $stmt->execute();
	}

	function recuperarDados(){
		$query = 'select * from tb_usuarios';
		$stmt = $this->conexao->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

?>