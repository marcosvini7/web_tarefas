<?php 
	class TarefaService{
		private $conexao;
		private $tarefa;

		function __construct(Conexao $conexao, Tarefa $tarefa){
			$this->conexao = $conexao->conectar();
			$this->tarefa = $tarefa;
		}

		public function inserir(){
			$query = "insert into tb_tarefas(tarefa, id_usuario) values(:tarefa, :id_usuario)";
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':tarefa', $this->tarefa->tarefa);
			$stmt->bindValue(':id_usuario', $this->tarefa->id_usuario);
			return $stmt->execute(); 
		}
		public function recuperar(){
			$query = 'select * from tb_tarefas where id_usuario = :id_usuario order by id desc';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id_usuario', $this->tarefa->id_usuario);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		public function atualizar(){
			$query = 'update tb_tarefas set tarefa = :tarefa where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':tarefa',$this->tarefa->tarefa);
			$stmt->bindValue(':id',$this->tarefa->id);		
			return $stmt->execute();
		}
		public function remover(){
			$query = 'update tb_tarefas set ativo = :ativo where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id',$this->tarefa->id);
            $stmt->bindValue(':ativo', 0);
			return $stmt->execute();
		}

		public function marcarRealizada(){
			$query = 'update tb_tarefas set id_status = :id_status, data_realizada = :data_realizada where id = :id';
			$stmt = $this->conexao->prepare($query);
			$stmt->bindValue(':id_status', $this->tarefa->id_status);
            $stmt->bindValue(':data_realizada', $this->tarefa->data_realizada);
			$stmt->bindValue(':id', $this->tarefa->id);
			return $stmt->execute();
		}
	}
?>