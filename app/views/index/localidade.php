<?php

session_start();

if(!isset($_SESSION['usuario'])){
	header('Location: autenticar');;
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
		<title>Sysconpat - Escola</title>
		
		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="css/favicon/favicon-16x16.png">
		<link rel="manifest" href="css/favicon/manifest.json">
		<link rel="mask-icon" href="css/favicon/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="theme-color" content="#ffffff">

		<!-- jquery - link cdn -->
	
		<script type="text/javascript" src="./scripts/jquery3.2.1.js"></script>
		<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/estiloCheckbox.css">
		<script type="text/javascript" src="./scripts/local.js"></script>

		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
			

	</head>

    <body>
		<?php
			include '../app/menu.php';
		?>
		
		<div class="row">
			<div class="col-md-12">
				<div class="list-group">
					<div class='panel panel-default'>
						<div class="panel-body">
							<div class="row">
								<form  id="form_cadastrar"  method="post" action="javascript:cadastrar();">
									<div class="col-md-6">
										<div class="form-group" id="local_opcoes">
											<div class="input-group">
												<span class="input-group-addon">Local</span>
												<input type="text" name="loc" id="loc" class="form-control" required>
											</div>
										</div>
									</div>
										
									<div class="col-md-6">
										<div class="form-group">
											<div class="input-group">
												<span class="input-group-addon" for="endereco">Endereço</span>
												<input type="text" name="endereco" id="endereco" class="form-control" required>
											</div>
										</div>
										<br>
										<button class="btn btn-primary" id="btn_cadastrar">Cadastrar</button>
									</div>
									<br>
								</form>
							</div>
						</div>
    				</div>

					<!--//Alerta sucesso-->
					<div  id="alerta" class="alert alert-success alert-fixed collapse">
						<a id="linkClose" href="#" class="close">&times;</a>
						<center><strong>Sucesso!</strong> Escola <span id='alert_msg'></span> !!!</center>
					</div>

					<!--//Alerta Erro-->
					<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">
						<a id="linkClose" href="#" class="close">&times;</a>
						<center><strong>Erro!</strong> Escola <span id='alert_msg_erro'></span> !!!</center>
					</div>

					<!--conteudo principal-->
					<div id="conteudo" class="list-group">
						<!--//imagens de carregamento-->
						<center><img  src="imagens/inicio.gif" style="display: none;" id="loader"></center>
							<div class="panel-body">               
							</div>
						</div>
					</div>
				</div>
			</div>
        
			<!-- Janela Modal para atualização-->
			<form class="modal fade" id="modal_atualizacao" action="javascript:atualizarlocal();">
				<div class="modal-dialog ">
				
					<div class="modal-content">
						<!-- Cabecalho-->                    
						<div class="modal-header modal-header-success">
							<button type="button" class="close"	data-dismiss="modal">
								<span>&times;</span>
							</button>
							<center><h3 class="modal-title">A T U A L I Z A R</h3></center>
						</div>
						<!-- corpo-->                    
						<div class="modal-body">
							<div class="input-group">
								<span class="input-group-addon" >Local</span>
								<input type="text" class="form-control" name="local" id="local_atualizacao" placeholder="Digite a Localidade">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon" >Endereço</span>
								<input type="text" class="form-control"  name="endereco" id="endereco_atualizacao" placeholder="Digite o Endereço">
							</div>

							<input type="hidden" class="form-control" name="id_atualizacao" id="id_atualizacao">
                      	</div>
						<!-- rodape-->                    
						<div class="modal-footer">

							<button type="button"  class="btn btn-danger"
								data-dismiss="modal">CANCELAR                            
							</button>
									<button type="submit"  id="btn_atualizar" class="btn btn-primary">A T U A L I Z A R                       
							</button>
                      	</div>
                  	</div>
              	</div>
           	</form>

			<script type="text/javascript">
				$('#modal_atualizacao').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget) // Button that triggered the modal
					var endereco = button.data('endereco') 
					var descricao = button.data('descricao') 
					var id = button.data('id') 


					var modal = $(this)
					
						modal.find('.modal-title').text('Editar ' + descricao)
						$("#local_atualizacao").attr("value", descricao);
						$("#endereco_atualizacao").attr("value", endereco);
						$("#id_atualizacao").attr("value", id);
						
					//modal.find('.input produto_att_modal input').val(produto)
					// modal.find('.modal-body descricao_att_modal input').val(descricao)
					})
			</script>

			<script src="./scripts/bootstrap.min.js"></script>
	</body>
</html>






















