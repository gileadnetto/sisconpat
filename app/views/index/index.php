<?php
	$error = isset($_GET['error'])? $_GET['error']:0;
?>

<!DOCTYPE html>
	<html>
		<head>
			<title>Login - SISCONPAT</title>
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

			<meta name="theme-color" content="#ffffff">
    	</head>
    <body>

		<div class="jumbotron">
			<div class="container">
				<img class="img-responsive" src="imagens/logo3.png">
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-4 " >  </div>
				<div class="col-md-4 " >
					<div class="panel panel-default">
						<div class="panel-body">           
                 			 <form class="form-group" method="post" action="login" id="formLogin" >
								<h3>Entrar</h3>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user-o fa-fw"></i></span>
										<input type="text" name="usuario" class="form-control" id="campo_usuario" placeholder="Digite seu login" required>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
										<input type="password" name="senha" class="form-control" id="campo_senha" placeholder="Digite sua senha" required>
									</div>
								</div>

								<?php
									if($error == 1){
										echo "<font color='#ff0000'> Usuario ou senha inválido(s)</font><br>";
									}
								?>
								<button type="submit" class="btn btn-primary btn-block" id="btn_login">Logar</button>
							</form>
						</div>
                	</div>
				</div>

				<div class="col-md-4 " ></div>
			</div>
		</div>
		<script src="./scripts/bootstrap.min.js"></script>
    </body>
</html>
        