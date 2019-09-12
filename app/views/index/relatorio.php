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
    <title>Sysconpat - Relatorio</title>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="css/vicon/favicon-16x16.png">
		<link rel="manifest" href="css/avicon/manifest.json">
		<link rel="mask-icon" href="css/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="theme-color" content="#ffffff">

		<!-- jquery - link cdn -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript" src="./scripts/jquery3.2.1.js"></script>
        <script type="text/javascript" src="./scripts/highcharts.js"></script>
		<script type="text/javascript" src="./scripts/exporting.js"></script>
		<script type="text/javascript" src="./scripts/relatorio.js"></script>
  
		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
			
	</head>

    <body>
		<?php
			include '../app/menu.php';
		?>
        <div class="row">
			
			<div class="col-md-12">
				<div class="row">
					<!--Conteudo principal-->
					<div id="conteudo" class="list-group">
						<!--//imagens de carregamento-->
						<center><img  src="imagens/inicio.gif" style="display: none;" id="loader" alt="carregamento"></center>
						<div class="panel-body"></div>
              		</div>
				</div> 
			</div>

		</div>  
		
		<script src="./scripts/bootstrap.min.js"></script>
	</body>
</html>