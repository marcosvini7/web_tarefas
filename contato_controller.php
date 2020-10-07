<?php 
	
	require 'conexao.php';
	require 'contatoService.php';

	$acao = isset($_POST['acao']) ? $_POST['acao'] : $acao;

	if($acao == 'inserir'){
		if(empty($_POST['email']) or empty($_POST['titulo']) or empty($_POST['feedback'])){
			header('location: contato.php?erro=1');
			die();
		}		
		$conexao = new Conexao();
		$contatoService = new ContatoService($conexao);
		$contatoService->email = $_POST['email'];
		$contatoService->titulo = $_POST['titulo'];
		$contatoService->feedback = $_POST['feedback'];
		if($contatoService->inserir()){
			header('location: contato.php?sucesso=1');
		}
	}

	if($acao == 'carregar'){
		$conexao = new Conexao();
		$contatoService = new ContatoService($conexao);
		$contatos = $contatoService->carregarTodos();

		$query = 'select * from tb_ips order by data desc';
		$conexao = $conexao->conectar();
		$stmt = $conexao->query($query);
		$ips = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$quantidadeIps = sizeof($ips);
		$quantidadeFeedbacks = sizeof($contatos);
	}
	
?>
