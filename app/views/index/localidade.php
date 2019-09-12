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
		<title>Sysconpat - Localidade</title>
		
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
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<script type="text/javascript" src="./scripts/local.js"></script>
		<script type="text/javascript" src="./scripts/Helpers/msgHelper.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
			

	</head>

    <body>
		<?php
			include '../app/menu.php';
		?>
		
		<div class="row">
			<div class="col-md-12">
			<h2 style="margin-top:0px;">Gerenciamento de Localidade</h2>
				<div class="row">
					<div class="col-sm-9">
						<button type="button" id="btn_cad" class="btn btn-primary" data-toggle="modal"
							data-target="#form_adicionar_Localidade" >Novo
						</button>
					</div>
				</div><br>
				<table id="dataTableLocalidade" class="table table-striped table-bordered table-hover display" width="100%">
					<thead>
                        <tr>
                            <th>Descri��o</th>
                            <th>Endere�o</th>
                            <th>Data de Cadastro</th>
                    </thead>
				</table>
             
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
           	
           	<!-- Janela Modal para adicionar-->
    		<form class="modal fade " id="form_adicionar_Localidade" method="POST"  action="" enctype="multipart/form-data"  >
    			<div class="modal-dialog ">
    				<div class="modal-content">
    					<!-- Cabecalho-->                    
    					<div class="modal-header  modal-header-info ">
    						<button type="button" class="close"	data-dismiss="modal">
    							<span>&times;</span>
    						</button>
    						<center><h3 class="modal-title">Adicionar Localidade</h3></center>
    					</div>
    					<!-- corpo-->                    
    					<div class="modal-body">
							<div class="input-group">
								<span class="input-group-addon" >Local</span>
								<input type="text" class="form-control" name="localidade" id="loc" placeholder="Digite a Localidade">
							</div>
							<br>
							<div class="input-group">
								<span class="input-group-addon" >Endereço</span>
								<input type="text" class="form-control"  name="endereco" id="endereco" placeholder="Digite o Endereço">
							</div>
                      	</div>
    					<!-- rodape-->                    
    					<div class="modal-footer">
    						<button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
    						<button  type="submit" class="btn btn-primary" id="btn-cadastrar-localidade">CADASTRAR </button>
    					</div>
    				</div>
    			</div>
    		</form>

			<script type="text/javascript">
			
			local.carregarConteudo();
			
			$('#btn-cadastrar-localidade').on('click', function(){
				local.cadastrar($('#form_adicionar_Localidade'));
			});

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






















