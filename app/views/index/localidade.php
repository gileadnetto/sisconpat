		<div class="titulo-adm">
			<h3>Locais</h3>
			<p>Locais cadastrados</p>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="list-group">
					<div class='panel panel-default'>
						<div class="panel-body">
							<div class="row">
								<form  id="form_cadastrar"  method="post"  onsubmit="cadastrarLocal()">
									<div class="col-md-6">
										<div class="form-group" id="local_opcoes">
											<div class="input-group">
												<span class="input-group-addon">Local</span>
												<input type="text" name="loc" id="loc" class="form-control" required >
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
										<button class="btn btn-primary" id="btn-cadastrar">Cadastrar</button>
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
			<form class="modal fade" id="modal_atualizacao">
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
									<button type="submit"  id="btn_atualizar_modal" class="btn btn-primary">A T U A L I Z A R                       
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























