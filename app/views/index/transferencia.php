<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: autenticar');;
	}
	$error = isset($_GET['error'])? $_GET['error']:0;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Transferencia - SISCONPAT</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="css/favicon/favicon-16x16.png">
		<link rel="manifest" href="css/favicon/manifest.json">
		<link rel="mask-icon" href="css/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="theme-color" content="#ffffff">

		<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="./scripts/jquery3.2.1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="css/jquery.form.js"></script>
		<script type="text/javascript" src="./scripts/transferencias.js"></script>
	
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
			
	</head>

    <body>
		<?php
			include '../app/menu.php';
		?>

        <div class="row">
			<div class="col-md-12">
              
				<form id="tramitar_id_form" name="tramitar_form" method="post" action="javascript:tramitar();">  
					<div class="row">
						<h3>Transferencia</h3>
						<div class="panel panel-default">
							<div class="panel-body"> 
									<div class="col-md-6">                             
										<div class="form-group dropup" id="local_opcoes_busca">
											<label >Origem:</label>
											<select  class="form-control" name="local_inicial" id="local_inicial"></select>
										</div>
									</div>

									<div class="col-md-6">                             
										<div class="form-group" id="local_opcoes_destino">
											<label >Destino:</label>
											<select  class="form-control" name="local_destino" id="local_destino"></select>
										</div>
										<!--  <button type="submit" class="btn btn-primary" id="btn_cadastrar">Tramitar</button> -->
										</div>
									<!-- </form>-->
							</div>
						</div>
					</div> <!-- fim row -->

					<!--Conteudo principal-->
					<!-- <form method="post" action="escolhasTransferencias.php"> -->
					<div id="conteudo" class="list-group">
						<!--//imagens de carregamento-->
						<center><img  src="imagens/inicio.gif" style="display: none;" id="loader"></center>
						<div class="panel-body">               
						</div>
					</div>
					<button type="submit" class="btn btn-danger" id="btn_tramitar" style="float:right;">Tramitar</button>
				</form>
			</div>
		</div><!-- fim conteiner -->
		<!--//Alerta sucesso-->
		<div  id="alerta" class="alert alert-success alert-fixed collapse">
			<a id="linkClose" href="#" class="close">&times;</a>
			<center><strong>Sucesso!</strong> <span id='alert_msg'></span> !!!</center>
		</div>

		<!--//Alerta Erro-->
		<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">
			<a id="linkClose" href="#" class="close">&times;</a>
			<center><strong>Erro!</strong>  <span id='alert_msg_erro'></span> !!!</center>
		</div>
  
		<script src="./scripts/bootstrap.min.js"></script>
	</body>
</html>