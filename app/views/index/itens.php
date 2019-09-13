
		<div class="titulo-adm">
			<h3>Produtos</h3>
			<p>Lista de Produtos cadastrados no sistema</p>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="row">
					      
					<!-- <button type="button"  id="btn_cad" class="btn btn-primary btn-sm  btn_cad" data-toggle="modal" data-target="#modal_adicionar" >
						<i class="fa fa-plus-circle fa-1x"> </i>  ADICIONAR
					</button> -->
					<button id="btn_cad" class=" btn_cad btnSisconpat " data-toggle="modal" data-target="#modal_adicionar">Adicionar<span class="fa fa-plus-circle fa-1x"></span></button>
					
					<script language="javascript" type="text/javascript"></script>
					<br>

					<div class="row">
						<div class="col-md-8"></div>

						<div class="col-md-3">
							<div id="buscar">
								<form  id="busca_form" name="busca_form" method="post" autocomplete="off" >
									<div class="input-group">
										<span class="input-group-addon" id="busca_produto_id">Pesquisar</span>
										<input type="text" class="form-control" id="produto_busca" name="produto" >
									</div>                                                                                                                        
								</form>
							</div>
						</div>
					</div><br>
				</div> <!-- fim row -->
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
			<center><strong>Sucesso!</strong> Produto <span id='alert_msg'></span> !!!</center>
		</div>
		<!--//Alerta Erro-->
		<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">
			<a id="linkClose" href="#" class="close">&times;</a>
			<center><strong><span id='alert_msg_erro'></strong></span></center>
		</div>
	</div>


	<!-- Janela Modal para atualização-->
	<form class="modal fade " id="modal_atualizacao"  enctype="multipart/form-data" action="javascript:atualizarProduto();" >
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
							<span class="input-group-addon" >Produto</span>
							<input type="text" class="form-control" name="produto_att_modal" id="produto_att_modal"  required>
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
						<center><img id="foto-attt" src="imagens/produtos/padrao.png" class="img-responsive" alt="Produto-IMG" width="160" ></center>
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
				var produto = button.data('PATRIMONIO'); 
				var descricao = button.data('descricao') ;
				var tombamento = button.data('tombamento');
				var foto = button.data('foto');
				var local = button.data('local');

				//$('#upload-foto').html(foto);//colocando o nome da foto no label
				//$('#upload-foto').attr(display:"block");
				var modal = $(this)
				modal.find('.modal-title').text('Modificar ' + produto)
				$("#produto_att_modal").attr("value", produto);
				$("#descricao_att_modal").attr("value", descricao);
				$("#tombamento_att_modal").attr("value", tombamento);
				$("#local_opcoes_modal").attr("value", local);
				$("#foto-att").attr("value", foto);
				$("#foto").attr("value", foto);
				$("#foto-attt").attr("src", "imagens/produtos/" + foto );

				//modal.find('.input produto_att_modal input').val(produto)
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
						<center><h3 class="modal-title">A D I C I O N A R</h3></center>
					</div>
					<!-- corpo-->                    
					<div class="modal-body">
						<div class="input-group">
							<span class="input-group-addon" id="produto_id">Produto</span>
							<input type="text" class="form-control" id="produto_id" name="produto"  required>
						</div>

						<br>
						<div class="input-group">
							<span class="input-group-addon" id="produto_id">Descricao</span>
							<input type="text" class="form-control" id="descricao_id" name="descricao" required>
						</div>
						<br>

						<div class="input-group">
							<span class="input-group-addon"  id="produto_id">Tombamento</span>
							<input type="number" min="0" class="form-control" id="tombamento_id" name="tombamento" required>
							<!--
							<span class="input-group-addon" id="produto_id">à</span>
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
							<center><img id="foto-add" src="imagens/produtos/padrao.png" class="img-responsive" alt="Produto-IMG" width="160" ></center>
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