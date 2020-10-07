<?php 

	require 'usuario_model.php';
	require 'conexao.php';
	require 'loginService.php';

	$acao = isset($_POST['acao']) ? $_POST['acao'] : $_GET['acao'];
	
	if($acao == 'cadastro'){
		if(empty($_POST['nome']) or empty($_POST['email']) or empty($_POST['senha']) or empty($_POST['confirmacao'])){
				header('location: cadastro.php?cadastro=3');
				die();
		}

        if(strlen($_POST['senha']) < 6){
			header('location: cadastro.php?cadastro=5');
			die();
		}

        if($_POST['senha'] != $_POST['confirmacao']){
			header('location: cadastro.php?cadastro=4');
			die();
		}

		$usuario = new Usuario();
		$usuario->nome = $_POST['nome'];
		$usuario->email = $_POST['email'];
		$usuario->senha = sha1($_POST['senha']);
		$conexao = new Conexao();
		$loginService = new loginService($conexao, $usuario);
		$registros = $loginService->recuperarDados();
		foreach ($registros as $registro) {
			if($usuario->email == $registro['email']){
				header('location: cadastro.php?cadastro=2');
				die();
			}
		}
		if($loginService->cadastrar()){
            $registros = $loginService->recuperarDados();
			foreach ($registros as $registro) {
			if($usuario->email == $registro['email'] and $usuario->senha == $registro['senha']){
					session_start();
					$_SESSION['id_usuario'] = $registro['id'];
					$_SESSION['login'] = 'sim';
					$_SESSION['nome'] = $registro['nome'];
					$_SESSION['boasvindas'] = 'sim';
					header('location: home.php');
					die();
			    }		
		    }
		}
	}

	if($acao == 'login'){
		if(empty($_POST['email']) or empty($_POST['senha'])){
			header('location: index.php?login=2');
			die();
		}
		$usuario = new Usuario();
		$usuario->email = $_POST['email'];
		$usuario->senha = sha1($_POST['senha']);
		$conexao = new Conexao();
		$loginService = new loginService($conexao, $usuario);
		$registros = $loginService->recuperarDados();
		foreach ($registros as $registro) {
			if($usuario->email == $registro['email'] and $usuario->senha == $registro['senha']){
					session_start();
					$_SESSION['id_usuario'] = $registro['id'];
					$_SESSION['login'] = 'sim';
					$_SESSION['nome'] = $registro['nome'];
					$_SESSION['boasvindas'] = 'sim';
					header('location: home.php');
					die();
			}		
		}
		header('location: index.php?login=1');
	}

	if($acao == 'sair'){
		session_start();
		session_destroy();
		header('location: index.php');
	}
?>