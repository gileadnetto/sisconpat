
<?php
	session_start();
	if(!isset($_SESSION['usuario'])){
		header('Location: autenticar');
	}
	$error = isset($_GET['error'])? $_GET['error']:0;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisconpat - Patrimonios</title>

		<meta charset="utf-8">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon -->
		<link rel="apple-touch-icon" sizes="180x180" href="css/favicon/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="css/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="css/favicon/favicon-16x16.png">
		<link rel="manifest" href="css/favicon/manifest.json">
		<meta name="theme-color" content="#ffffff">


		<!-- jquery - link cdn -->

		<!--<script src ="jquery-3.2.1.js"></script>-->
		<link rel="stylesheet" type="text/css" href="css/bootstrap/css/bootstrap.min.css">
		<script type="text/javascript" src="./scripts/jquery3.2.1.js"></script>

		<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">

		<!-- link tabledata 
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
		<script type="text/javascript" language="javascript" src="css/dataTables.min.js"></script>
		<script type="text/javascript" language="javascript" src="css/dataTables.bootstrap.min.js"></script>
		-->
		<script type="text/javascript" src="css/jquery.form.js"></script>
		<script type="text/javascript" src="./scripts/patrimonio.js"></script>

		<link rel="stylesheet" type="text/css" href="css/menu.css">
		<script type="text/javascript" src="./scripts/menu.js"></script>
		

	</head>
	<body>
		<?php
			include '../app/menu.php';
		?>

		<div class="row">
			<div class="col-md-12">
			<h2 style="margin-top:0px;">Gerenciamento de Patrimonios</h2>
					<div class="row">
						<div class="col-sm-9">
						<button type="button" id="btn_cad" class="btn btn-primary" data-toggle="modal"
							data-target="#modal_adicionar" >Novo
						</button>
						</div>

						<div class="col-md-3">
							<div id="buscar">
								<form  id="busca_form" name="busca_form" method="post" autocomplete="off" >
									<div class="input-group">
										<span class="input-group-addon" id="busca_patrimonio_id">Pesquisar</span>
										<input type="text" class="form-control" id="patrimonio_busca" name="patrimonio" >
									</div>                                                                                                                        
								</form>
							</div>
						</div>
					</div><br>
			<!--Conteudo principal-->
			<div id="conteudo" class="list-group">
				<!--//imagens de carregamento-->
				<center><img  src="imagens/inicio.gif" style="display: none;" id="loader" alt="carregamento"></center>
				<div class="panel-body"> </div>
			</div>
		</div>

		<!--//Alerta sucesso-->
		<div  id="alerta" class="alert alert-success alert-fixed collapse">
			<a id="linkClose" href="#" class="close">&times;</a>
			<center><strong>Sucesso!</strong> Patrimonio <span id='alert_msg'></span> !!!</center>
		</div>
		<!--//Alerta Erro-->
		<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">
			<a id="linkClose" href="#" class="close">&times;</a>
			<center><strong><span id='alert_msg_erro'></strong></span></center>
		</div>
	</div>


	<!-- Janela Modal para atualização-->
	<form class="modal fade " id="modal_atualizacao"  enctype="multipart/form-data" action="javascript:atualizarPatrimonio();" >
		<div class="modal-dialog ">
			<div class="modal-content">
				<!-- Cabecalho-->                    
				<div class="modal-header modal-header-primary">
					<button type="button" class="close"
					data-dismiss="modal">
					<span>&times;</span>
					</button><center><h3 class="modal-title">A t u a l i z a r</h3></center></div>
					<!-- corpo-->                    
					<div class="modal-body">
						<div class="input-group">
							<span class="input-group-addon" >Patrimonio</span>
							<input type="text" class="form-control" name="patrimonio_att_modal" id="patrimonio_att_modal"  required>
						</div>
						<br>
						
						<div class="input-group">
							<span class="input-group-addon" >Descrição</span>
							<input type="text" class="form-control" name="descricao_att_modal" id="descricao_att_modal"  required>
						</div>
						<br>
						<input type="hidden" class="form-control" name="tombamento_att_modal" id="tombamento_att_modal">
						
						<input type="hidden" class="form-control" name="loc" id="local_opcoes_modal">
						<input type="hidden" class="form-control" name="foto" id="foto">

						<!--
							<div class="form-group" id="local_opcoes_modal">
								<label >Local:</label>
								<select  class="form-control" name="loc">
								</select>
							</div>
						-->
						

						<label class="btn btn-default" for="foto-id-att">
							<input id="foto-id-att" name="foto_att_modal" type="file" style="display:none" 
							onchange="readURL(this,'foto-attt');"><i class="fa fa-camera" aria-hidden="true"></i> 
						</label>
						<span class='label label-info' id="upload-foto"></span>
						<center><img id="foto-attt" src="imagens/patrimonios/padrao.png" class="img-responsive" alt="Patrimonio-IMG" width="160" ></center>
						<br><br>
					</div>
					<!-- rodape-->                    
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
						<button  type="submit" class="btn btn-primary" id="btn_atualizar">ATUALIZAR</button>
					</div>
				</div>
			</div>
		</form>

		<script type="text/javascript">
			$('#modal_atualizacao').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var patrimonio = button.data('patrimonio'); 
				var descricao = button.data('descricao') ;
				var tombamento = button.data('tombamento');
				var foto = button.data('foto');
				var local = button.data('local');

				//$('#upload-foto').html(foto);//colocando o nome da foto no label
				//$('#upload-foto').attr(display:"block");
				var modal = $(this)
				modal.find('.modal-title').text('Modificar ' + patrimonio)
				$("#patrimonio_att_modal").attr("value", patrimonio);
				$("#descricao_att_modal").attr("value", descricao);
				$("#tombamento_att_modal").attr("value", tombamento);
				$("#local_opcoes_modal").attr("value", local);
				$("#foto-att").attr("value", foto);
				$("#foto").attr("value", foto);
				$("#foto-attt").attr("src", "imagens/patrimonios/" + foto );

				//modal.find('.input patrimonio_att_modal input').val(patrimonio)
				// modal.find('.modal-body descricao_att_modal input').val(descricao)
			})
		</script>

		<!-- Janela Modal para adicionar-->
		<form class="modal fade " id="modal_adicionar" method="POST"  enctype="multipart/form-data"  >
			<div class="modal-dialog ">
				<div class="modal-content">
					<!-- Cabecalho-->                    
					<div class="modal-header  modal-header-info ">
						<button type="button" class="close"	data-dismiss="modal">
							<span>&times;</span>
						</button>
						<center><h3 class="modal-title">Adicionar Patrimonio</h3></center>
					</div>
					<!-- corpo-->                    
					<div class="modal-body">
						<div class="input-group">
							<span class="input-group-addon" id="patrimonio_id">Patrimonio</span>
							<input type="text" class="form-control" id="patrimonio_id" name="patrimonio"  required>
						</div>

						<br>
						<div class="input-group">
							<span class="input-group-addon" id="patrimonio_id">Descricao</span>
							<input type="text" class="form-control" id="descricao_id" name="descricao" required>
						</div>
						<br>

						<div class="input-group">
							<span class="input-group-addon"  id="patrimonio_id">Tombamento</span>
							<input type="number" min="0" class="form-control" id="tombamento_id" name="tombamento" required>
							<!--
							<span class="input-group-addon" id="patrimonio_id">à</span>
							<input type="number"  class="form-control" id="tombamento_pacote" name="tombamento_pacote" >
							-->
						</div> 

						<br>
						<div class="form-group" id="local_opcoes">
							<label >Local:</label>
							<select  class="form-control" name="loc"> </select>
						</div>

						<label class="btn btn-default" for="foto-id">
							<input id="foto-id" name="foto" type="file" style="display:none" 
							onchange="readURL(this,'foto-add');"><i class="fa fa-camera" aria-hidden="true"></i>  
						</label>
						<div>
							<center><img id="foto-add" src="imagens/patrimonios/padrao.png" class="img-responsive" alt="Patrimonio-IMG" width="160" ></center>
						</div>
					</div>
					<!-- rodape-->                    
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
						<button  type="submit" class="btn btn-primary" id="btn-cadastrar">CADASTRAR </button>
					</div>
				</div>
			</div>
		</form>

		<script src="./scripts/bootstrap.min.js"></script>
	</body>
</html>