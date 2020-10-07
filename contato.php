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
		  		<a class="navbar-brand" href="index.php">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
		 		</a>
			  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
			  		<span class="navbar-toggler-icon"></span>
			  	</button>

		  		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			    	<div class="navbar-nav ml-auto">
			    		<?php 
				    		session_start();
				    		if(isset($_SESSION['id_usuario'])) { ?>
				    			<a class="nav-item nav-link" href="home.php">Home</a>
			    		<?php } ?>
				      	<a class="nav-item nav-link" href="sobre.php">Sobre</a>
				      	<a class="nav-item nav-link active" href="contato.php">Contato</a>
				      	<?php 
				    		if(!isset($_SESSION)){
				    			session_start();
				    		}
				    		if(isset($_SESSION['id_usuario'])) { ?>
				    			<a class="nav-item nav-link" href="login_controller.php?acao=sair">Sair</a>
			    		<?php } ?>
			    	</div>
		  		</div>
		   </div>		   
		</nav>

		<?php if(isset($_GET['sucesso']) and $_GET['sucesso'] == 1){ ?>
			<div class="bg-success text-light d-flex justify-content-center">
				<h6>Feedback enviado com sucesso</h6>
			</div>
			
		<?php } ?>

		<?php if(isset($_GET['erro']) and $_GET['erro'] == 1){ ?>
			<div class="bg-danger text-light d-flex justify-content-center">
				<h6>Existem campos que não foram preenchidos</h6>
			</div>
			
		<?php } ?>

		<div class="container mt-5">
			<h3>Envie-nos um feedback!</h3>
			<h5>Sua opinião é de grande importância para que possamos melhorar</h5>
			<form class="mt-3" action="contato_controller.php" method="post">	 <h6>Email: </h6>
				<input class="form-control" type="email" name="email" placeholder="Digite o seu email...">	
				<h6>Título: </h6>
				<input class="form-control" type="text" name="titulo" placeholder="Digite o título...">
				<h6>Feedback: </h6>
				<textarea class="form-control" name="feedback" placeholder="Digite sua sugestão..."></textarea>
				<input type="hidden" name="acao" value="inserir">
				<input type="submit" class="btn btn-outline-info mt-2" value="Enviar">
			</form>
		</div>
	  </div>

	  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>