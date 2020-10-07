<?php 

	session_start();
	if(isset($_SESSION['login']) and $_SESSION['login'] == 'sim'){
		$nome = $_SESSION['nome'];
	} else {
		header('location: index.php?login=3');
		die();
	}
	
	$acao = 'recuperar';
	require 'tarefa_controller.php';
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

	<style type="text/css">
		.pointer{
			cursor: pointer;
		}
		.tam{
			width: 100%;
		}
	</style>

	<script type="text/javascript">
		
		function editar(id, valor){
			document.getElementById(id).innerHTML = 
			`<form action="tarefa_controller.php?acao=atualizar" method="post" class='d-flex col-12'>
					<input name='tarefa' class='form-control' type='text' value='${valor}'></input>
					<input type='hidden' name='id' value='${id}' ></input>
					<input class ='btn btn-primary'type='submit' value='Ok'>
			</form>`
		}
		function remover(id){			
			$('#exclusao').modal('show')
			$('#sim').click(() =>{
				window.location.href = 'todas_tarefas.php?acao=remover&id=' + id
			})

			$('#cancelar').click(() =>{
				$('#exclusao').modal('hide')
			})		
		}
		function marcarRealizada(id){
			window.location.href = 'todas_tarefas.php?acao=marcar&id=' + id;
		}

	</script>

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
			    			<a class="nav-item nav-link" href="feedbacks.php">Feedbacks</a>
			    		<?php } ?>
			    		<a class="nav-item nav-link" href="home.php">Home</a>
				      	<a class="nav-item nav-link" href="sobre.php">Sobre</a>
				      	<a class="nav-item nav-link" href="contato.php">Contato</a>
				      	<a class="nav-item nav-link" href="login_controller.php?acao=sair">Sair</a>
			    	</div>
		  		</div>
		   </div>
		</nav>

		<?php if(isset($_GET['atualizar']) and $_GET['atualizar'] == 1){ ?>
			<div class="bg-success text-light d-flex justify-content-center">
				<h6>Tarefa atualizada com sucesso</h6>
			</div>
			
		<?php } ?>

		<?php if(isset($_GET['atualizar']) and $_GET['atualizar'] == 2){ ?>
			<div class="bg-danger text-light d-flex justify-content-center">
				<h6>O campo descrição não pode ficar em branco</h6>
			</div>
			
		<?php } ?>

		<?php if(isset($_GET['remover']) and $_GET['remover'] == 1){ ?>
			<div class="bg-success text-light d-flex justify-content-center">
				<h6>Tarefa removida com sucesso</h6>
			</div>
			
		<?php } ?>

		<?php if(isset($_GET['realizada']) and $_GET['realizada'] == 1){ ?>
			<div class="bg-success text-light d-flex justify-content-center">
				<h6>Tarefa marcada como realizada</h6>
			</div>
			
		<?php } ?>

		<div class="container app">
			<div class="row">
				<div class="col-sm-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a href="index.php">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item active"><a href="todas_tarefas.php">Todas tarefas</a></li>
						<li class="list-group-item"><a href="tarefas_realizadas.php">Tarefas realizadas</a></li>
					</ul>
				</div>

				<div class="col-sm-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Todas tarefas</h4>
								<hr />

								<?php  foreach ($tarefas as $tarefa) { 	
                                    if($tarefa['ativo']){
                                        if($tarefa['id_status'] == 2){
                                            $data = explode(' ', $tarefa['data_realizada']);
                                            $data1 = explode('/', $data[0]);
                                            $data = 'Realizada em ' . $data1[2] . '/' . $data1[1] . '/' . $data1[0] . ', às ' . $data[1];
                                    } else {
                                            $data = explode(' ', $tarefa['data_cadastrado']);
                                            $data1 = explode('-', $data[0]);
                                            $data2 = explode(':', $data[1]);
                                            $horas =  ++$data2[0] . ':' . $data2[1];
                                            $data = 'Criada em ' . $data1[2] . '/' . $data1[1] . '/' . $data1[0] . ', às ' . $horas;
                                        }
                                ?>
                                    
								<div class="row mb-3 d-flex align-items-center tarefa" id="<?=$tarefa['id']?>">
									<div class="col-sm-9 mb-2"><?=$tarefa['tarefa']?><?php if(!(strlen($data) < 23)){ ?> <br>
                                    <div style="font-size: 0.8em; float: right"><?=$data?></div> <?php } ?></div>
									<div class="col-sm-3 mt-2 d-flex justify-content-between">
										<i class="fas fa-trash-alt fa-lg text-danger pointer" onclick="remover(<?=$tarefa['id']?>)"></i>										                            <?php if($tarefa['id_status'] == 2){ ?>
                                            <i class="fas fa-clipboard-check text-success"></i>
										<?php } ?>

										<?php if($tarefa['id_status'] == 1){ 
										?>		

										<i class="fas fa-edit fa-lg text-info pointer" onclick="editar(<?=$tarefa['id']?>,'<?=$tarefa['tarefa']?>')"></i>
										<i class="fas fa-check-square fa-lg text-success pointer" onclick="marcarRealizada(<?=$tarefa['id']?>)"></i>
										<?php } ?>
									</div>
								</div>
                                <hr>
								<?php } } ?>							
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="modal fade" id="exclusao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLongTitle">Atenção</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-danger">
        Deseja realmente excluir esta tarefa?
      </div>
      <div class="modal-footer">
        <button id="sim" type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
        <button id="cancelar" type="button" class="btn btn-primary">Cancelar</button>
      </div>
    </div>
  </div>
</div>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>