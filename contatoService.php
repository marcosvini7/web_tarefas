<?php 

	class ContatoService{
		private $conexao;
		private $email;
		private $titulo;
		private $feedback;

		function __construct(Conexao $conexao){
			$this->conexao = $conexao->conectar();
		}

		function __get($attr){
			return $this->$attr;
		}

		function __set($attr, $value){
			$this->$attr = $value;
		}

		function inserir(){
			$query = 'insert into tb_contato(titulo, email,feedback) values(:titulo, :email, :feedback)';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':titulo', $this->titulo);
			$stmt->bindValue(':email', $this->email);
			$stmt->bindValue(':feedback', $this->feedback);
			return $stmt->execute();
		}

		function carregarTodos(){
			$query = 'select * from tb_contato';
			$stmt = $this->conexao->query($query);
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}

?>