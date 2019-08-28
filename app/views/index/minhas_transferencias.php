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
	<script>
	$(document).ready(function(){
		var date_input=$('input[name="date"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	
		date_input.datepicker({
		format: 'dd/mm/yyyy',
		endDate: "now",
		todayBtn: true,
		language: "pt-BR",
		container: container,
		todayHighlight: true,
		autoclose: true,
		})

		$('input[name="date2"]').datepicker({
			endDate: "now",
			todayBtn: true,
			language: "pt-BR"
		});
	})	
	</script>
