
<div class="row">
	<div class="col-md-12">
	
		<form id="tramitar_id_form" name="tramitar_form" method="post" action="javascript:tramitar();">  
			<!--action="javascript:tramitar();" para criar uma function tramitar fora do document . ready -->
			<div class="row">
				<h3>Transferencia</h3>
				<div class="panel panel-default">
					<div class="panel-body"> 
						<!--  <form  id="cadastro_form" name="cadastro_form" method="post" action="javascript:cadastrar();"> -->
							<div class="col-md-6">                             
								<div class="form-group dropup" id="local_opcoes_busca">
									<label >local Inicial:</label>
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

	