<?php 	
	session_start();
	if(isset($_SESSION['id_usuario']) and $_SESSION['id_usuario'] == 1){
		$nome = $_SESSION['nome'];
	} else {
		header('location: index.php');
		die();
	}

	$acao = 'carregar';
	require 'contato_controller.php';

?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>

	<body>
		<nav class="navbar navbar-expand-md navbar-light bg-light">
			<div class="container">
		  		<a class="navbar-brand" href="home.php">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
		 		</a>
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			  		<span class="navbar-toggler-icon"></span>
			  	</button>

		  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    	<div class="navbar-nav ml-auto">
			    		<?php if($_SESSION['id_usuario'] == 1){ ?>
			    			<a class="nav-item nav-link active" href="feedbacks.php">Feedbacks</a>
			    		<?php } ?>
			    		<a class="nav-item nav-link" href="home.php">Home</a>
				      	<a class="nav-item nav-link" href="sobre.php">Sobre</a>
				      	<a class="nav-item nav-link" href="contato.php">Contato</a>
				      	<a class="nav-item nav-link" href="login_controller.php?acao=sair">Sair</a>
			    	</div>
		  		</div>
		   </div>
		</nav>

		<div class="container">
			<div class="row mb-3">
				<div class="col-md-8 col-sm-6">
					<h3 class="m-3">Feedbacks: <?= $quantidadeFeedbacks ?></h3>
					
					<?php foreach ($contatos as $contato) { ?>						
						<ul class="list-group">
							<li class="list-group-item">
								<b>Email: </b><?= $contato['email'] ?><br>
								<b>Título: </b><?= $contato['titulo'] ?><br>
								<b>feedback: </b><?= $contato['feedback'] ?><br>
							</li>
						</ul>

					<?php } ?>	
				</div>
			
			<div class="col">
				<h3 class="m-3">Acessos: <?= $quantidadeIps ?> </h3>

				<?php foreach ($ips as $ip) { ?>
					
					<ul class="list-group">
						<li class="list-group-item">
							<b>IP: </b><?= $ip['ip'] ?><br>
							<b>Data de acesso: </b><?= $ip['data'] ?><br>
						</li>
					</ul>

				<?php } ?>	
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>	
	</body>
</html>			