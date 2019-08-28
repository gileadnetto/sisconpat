
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-body"> 

                 		<form id="cadastro_form" name="cadastro_form" method="post" action="javascript:cadastrar();">            <div class="col-md-6">         
							
						 	<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" for="nome">Nome</span>                            
									<input type="text" name="nome" class="form-control" id="nome" required>
								</div>
							</div>

							<div class="form-group">
								<div class="input-group">
									<span class="input-group-addon" for="email">Email</span>
									<input type="email" name="email" class="form-control" id="email" required>
								</div> 
							</div>
							</div>

							<div class="col-md-6">         
								<div class="form-group">
									<div class="input-group">
										<span class="input-group-addon" for="senha">Senha</span>
										<input type="password" name="senha" class="form-control" id="senha" required>
									</div>
								</div>
                        
								<div class="radio">
									<label><input type="radio" name="perfil" value="usuario" checked>Usuario</label>
									<label><input type="radio" name="perfil" value="administrador">Administrador</label>
								</div>
                        		<button type="submit" class="btn btn-default">Cadastrar</button>
							</div>
                		</form>
					</div>
				</div> 
            </div> <!-- fim row -->

			<!--//Alerta sucesso-->
			<div  id="alerta" class="alert alert-success alert-fixed collapse">
				<a id="linkClose" href="#" class="close">&times;</a>
				<center><strong>Sucesso!</strong> Usuario <span id='alert_msg'></span> !!!</center>
			</div>

			<!--//Alerta Erro-->
			<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">
				<a id="linkClose" href="#" class="close">&times;</a>
				<center><strong>Erro!</strong> Usuario <span id='alert_msg_erro'></span> !!!</center>
			</div>

			<!--Conteudo principal-->
			<div id="conteudo" class="list-group">

				<!--//imagens de carregamento-->
				<center><img  src="imagens/inicio.gif" style="display: none;" id="loader"></center>
				<div class="panel-body"></div>
			</div>
        </div>
    </div>
</div>

		<!-- Janela Modal para atualização-->
		<form class="modal fade" id="modal_atualizacao" action="javascript:atualizarUsuario();">
			<div class="modal-dialog ">
				
				<div class="modal-content">
					<!-- Cabecalho-->                    
					<div class="modal-header modal-header-primary">
						<button type="button" class="close" data-dismiss="modal">
							<span>&times;</span>
						</button>

						<center><h3 class="modal-title">A t u a l i z a r</h3></center>
					</div>
					<!-- corpo-->                    
					<div class="modal-body">
						<div class="input-group">
							<span class="input-group-addon" >Usuario</span>
							<input type="text" class="form-control" name="usuario_modal" id="usuario_modal" required>
						</div>
						<br>

						<div class="input-group">
							<span class="input-group-addon" >Email</span>
							<input type="text" class="form-control" name="email_modal" id="email_modal"  required>
						</div>

						<div class="radio">                          
							<label><input type="radio" name="perfil" value="usuario" checked>Usuario</label>
							<label><input type="radio" name="perfil" value="administrador">Administrador</label>               
						</div>

						<input type="hidden" class="form-control" name="id_modal" id="id_modal">                        
					</div>

					<!-- rodape-->                    
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-primary">A T U A L I Z A R</button>
					</div>
				</div>
			</div>
		</form>

		<script type="text/javascript">

			$('#modal_atualizacao').on('show.bs.modal', function (event) {
				var button = $(event.relatedTarget) // Button that triggered the modal
				var email = button.data('email') 
				var usuario = button.data('login')
				var id = button.data('id') 

				var modal = $(this)
				modal.find('.modal-title').text('Atualizar ' + usuario)
					$("#usuario_modal").attr("value", usuario);
					$("#email_modal").attr("value", email);
					$("#id_modal").attr("value", id);
					//modal.find('.input produto_att_modal input').val(produto)
					// modal.find('.modal-body descricao_att_modal input').val(descricao)
				})
		</script>
