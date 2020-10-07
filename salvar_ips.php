<?php 
	require 'conexao.php';

	$ip = $_SERVER['REMOTE_ADDR'];
	date_default_timezone_set('America/Sao_Paulo');
	$hora = date('d/m/Y - H:i:s');

	$conexao = new Conexao();
	$conexao = $conexao->conectar();
	$query = "insert into tb_ips(ip, data) values (:ip, :hora)";
	$stmt = $conexao->prepare($query);
	$stmt->bindValue(':ip', $ip);
	$stmt->bindValue(':hora', $hora);
	$stmt->execute();
?>
