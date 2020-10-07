<?php 

	require 'conexao.php';
	require 'tarefa.model.php';
	require 'tarefaService.php';

	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	if(!isset($_SESSION)){
		session_start();
	}
		
	if($acao == 'inserir'){
		if(empty($_POST['tarefa'])){
			header('Location: nova_tarefa.php?inclusao=2');
			die();
		}		
		$tarefa = new Tarefa();
		$tarefa->tarefa = $_POST['tarefa'];
		$tarefa->id_usuario = $_SESSION['id_usuario'];	
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->inserir()){
			header('Location: nova_tarefa.php?inclusao=1');
		}
	}

	else if($acao == 'recuperar'){
		$tarefa = new Tarefa();
		$tarefa->id_usuario = $_SESSION['id_usuario'];
		$conexao = new Conexao();
		$tarefaService = new tarefaService($conexao, $tarefa);
		$tarefas = $tarefaService->recuperar();
	}

	else if($acao == 'atualizar'){
		if(empty($_POST['tarefa'])){
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'home'){
				header('Location: home.php?atualizar=2');
				die();
			}
			header('Location: todas_tarefas.php?atualizar=2');
			die();
		}
		$tarefa = new Tarefa();
		$tarefa->tarefa = $_POST['tarefa'];
		$tarefa->id = $_POST['id'];
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->atualizar()){
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'home'){
				header('Location: home.php?atualizar=1');
				die();
			}
			header('location: todas_tarefas.php?atualizar=1');
		}
	}
	else if($acao == 'remover'){
		$tarefa = new Tarefa();
		$tarefa->id = $_GET['id'];
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->remover()){
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'home'){
				header('Location: home.php?remover=1');
				die();
			}
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'tarefas_realizadas'){
				header('Location: tarefas_realizadas.php?remover=1');
				die();
			}
			header('location: todas_tarefas.php?remover=1');
		}
	}
	else if($acao == 'marcar'){
		$tarefa  = new Tarefa();
		$tarefa->id = $_GET['id'];
		$tarefa->id_status = 2;
        date_default_timezone_set('America/Sao_Paulo');
        $tarefa->data_realizada = date('y/m/d H:i');
		$conexao = new Conexao();
		$tarefaService = new TarefaService($conexao, $tarefa);
		if($tarefaService->marcarRealizada()){
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'index'){
				header('Location: index.php?realizada=1');
				die();
			}
			if(isset($_GET['pagina']) and $_GET['pagina'] == 'home'){
				header('Location: home.php?realizada=1');
				die();
			}
			header('location: todas_tarefas.php?realizada=1');
		}
	}
?>