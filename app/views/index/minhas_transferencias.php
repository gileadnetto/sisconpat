<?php

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location: index.php?error=1');
}

if (!isset($_GET['pg'])) {
	$pg = 1;
} 
else {
	$pg = $_GET['pg'];
	$_SESSION['pg'] =  $pg;
}

$error = isset($_GET['error'])? $_GET['error']:0;
?>

<!DOCTYPE html>
  <html>
    <head>
    	<title>Transferencias - SISCONPAT</title>
   		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="css/favicon/favicon-16x16.png">
		<link rel="manifest" href="css/favicon/manifest.json">

		<meta name="theme-color" content="#ffffff">

		<!--<script src ="jquery-3.2.1.js"></script>-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="./scripts/jquery3.2.1.js"></script>

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="css/jquery.form.js"></script>
		<script type="text/javascript" src="./scripts/minha_transferencias.js"></script>
		
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
			
	</head>
	
    <body >
		<?php
			include '../app/menu.php';
		?>
		<div class="row">
		
		<div class="col-md-12 ">
			<h2>Minhas Transferencias</h2>
			<!-- Formulario para pesquisa de transferencia-->
			<!-- <form  id="form_id_busca" name="form_busca" >
            
				<div class="panel panel-default">
					<div class="panel-body">

						<div class="col-md-6">
							<div class="form-group ">
								<div class="col-sm-10">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
										<input class="form-control" id="date" name="date" placeholder="DD/MM/AAA" type="text"/>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group" id="local_opcoes">
								<label >Local:</label>
								<select  class="form-control" name="loc"></select>
							</div>
							<button type="submit" class="btn btn-default" >Buscar</button>                  
						</div>
					</div>
				</div>
			</form> -->

			<!--conteudo principal-->
			<div id="conteudo" class="list-group">
				<!--//imagens de carregamento-->
				<center><img  src="imagens/inicio.gif" style="display: none;" id="loader"></center>
				<div class="panel-body">               
				</div>
			</div>
	    </div>
	</div>
        
	<!-- Janela Modal para atualização-->
	<form class="modal fade" id="modal_atualizacao" action="">
		<div class="modal-dialog ">
			<div class="modal-content">
				<!-- Cabecalho-->                    
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
					<h4 class="modal-title">Efetuar Atualização</h4>
				</div>
				<!-- corpo-->                    
				<div class="modal-body">
					<div class="form-group">
						<input type="text" class="form-control" name="local" id="local" placeholder="Digite a Localidade">
					</div>

					<div class="form-group">
						<input type="text" class="form-control"  name="endereco" id="endereco" placeholder="Digite o Endereço">
					</div>
				</div>


				<!-- rodape-->                    
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Atualizar</button>
				</div>
			</div>
		</div>
	</form>

<script src="./scripts/bootstrap.min.js"></script>
</body>
</html>