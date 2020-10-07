<?php 
	class Tarefa{
		private $id;
		private $id_status;
		private $tarefa;
		private $data_cadastrado;
		private $id_usuario;
        private $data_realizada;

		public function __get($attr){
			return $this->$attr;
		}
		public function __set($attr, $value){
			$this->$attr = $value;
		}
	}
?>