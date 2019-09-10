
$(document).ready( function (){

	
    Produto = function(){
		// carregando elementos
		var conteudo = $('#conteudo');

		/**
		 * 
		 * @description funcão responsavel por carregar os produtos
		 */
		var carregar = function(){
			$.ajax({
				url:'getItens', 
	
				success: function(data){
					conteudo.html(data);
	
				},//continuação do ajax principal
		
				beforeSend: function (){
					$('#loader').css({display:"block"});
				},
	
				complete: function(){
					$('#loader').css({display:"none"});
				}
			});
		}

		/**
		 * 
		 * @param {*integer} tombamento 
		 * @description funcão responsavel por remover um produto pel o seu numero de tombamento
		 */
		var remover = function(tombamento){
			$.ajax({
				url: 'deletProduto',
				method: 'post',
				data: { tombamento: tombamento},

				success:function(data){
					//alert(data)
					$('#alert_msg').html('Deletado');//colocar a msg 
					$('#alerta').show('fade');

					setTimeout(function () {
						$('#alerta').hide('fade');
					}, 2000);  

					$('#'+tombamento).closest('.tabela').remove();

				}
			});
		}

		var cadastrar = function(formData){   
		
			//document.getElementById('onbot').value='Aguarde Gravando....';
			$.ajax({  
				type: "POST",                       
				url:'cadastrarProduto', 
				data: formData,
				processData:false,
				contentType:false,
		
				success: function(data){
					var result = JSON.parse(data);
					if( !result.erro){
						$('#erro_tombamento').css({display:"none"});
						$('#alert_msg').html('Adicionado');//setar a msg de sucesso
		
						$('#alerta').show('fade');
		
						setTimeout(function () {
							$('#alerta').hide('fade');
						}, 2000);

						carregar();

						$('#modal_adicionar [data-dismiss="modal"]').trigger('click');
						$('#modal_adicionar')[0].reset();
						
					}
					else{
						$('#erro_tombamento').css({display:"block"});
						$('#alert_msg_erro').html(result.mensagem);//setar a msg de erro
						$('#alerta_erro').show('fade');
		
						setTimeout(function () {
							$('#alerta_erro').hide('fade');
						
						}, 2000); 

						
						//document.location = "produto.php?error=1";;
					} 
				},
				beforeSend: function (){
					document.getElementById("btn-cadastrar").innerHTML = '<i class="fa fa-spinner fa-pulse"></i> Cadastrando';
		
				},
				complete: function(){
					document.getElementById("btn-cadastrar").innerHTML = "CADASTRAR";
					$("#foto-add").attr("src", "imagens/produtos/padrao.png");
				}      
			}); 
									
			// window.location.reload();
				
		}

		var atualizar = function(dados){
			//var dados = $('#modal_atualizacao').serialize();
			$.ajax({
				url:'updateProduto', 
				method:'post',
				processData:false,
				contentType:false,
				data:dados,
				success: function(data){
					var result = JSON.parse(data);
					
					if(!result.erro){
						$('#erro_tombamento').css({display:"none"});
						$('#alert_msg').html('Atualizado');//setar a msg de sucesso

						$('#alerta').show('fade');

						setTimeout(function () {
						$('#alerta').hide('fade');
						}, 2000);

						$('[data-dismiss="modal"]').trigger('click');

						carregar();
					}
					else{

						$('#erro_tombamento').css({display:"block"});

						$('#alert_msg_erro').html('Nao foi Atualizado');//setar a msg de erro

						$('#alerta_erro').show('fade');

						setTimeout(function () {
							$('#alerta_erro').hide('fade');
						}, 2000); 

					} 
				},
				beforeSend: function (){
					document.getElementById("btn_atualizar").innerHTML = '<i class="fa fa-spinner fa-pulse"></i> ATUALIZANDO';

				},
				complete: function(){
					document.getElementById("btn_atualizar").innerHTML = "ATUALIZAR";
					$("#foto-add").attr("src", "imagens/produtos/padrao.png");
				}
			});
		}

		/**
		 * @description funcão responsavel por carregar as opcoes de locais para criacao do select
		 */
		var carregarLocais = function(){
			 // chamada das opçoes de locais no dropdown
			 $.ajax({
				url:'getOptionLocal', 
				success: function(data){
					$('#local_opcoes').html(data);
					$('#local_opcoes_modal').html(data);  
				}              
			});
		}

		/**
		 * @description funcão responsavel por carregar as opcoes de locais para criacao do select
		 */
		var buscaProduto = function(query){
		
			$.ajax({
				url:'buscaProduto', 
				method: 'post',
				data: {query: query},

				success: function(data){
					conteudo.html(data);
				},

				//continuação do ajax v
				beforeSend: function (){
					$('#loader').css({display:"block"});
				},
	
				complete: function(){
					$('#loader').css({display:"none"});
				}
			}); 
			
		}

		/**
		 * @description funcão responsavel por carregar produto de 1 local 
		 */
		var carregarLocalConteudo = function(idLocal){
			$.ajax({
				url:'dao/produtoDAO/getProdutoBusca.php', 
				method: 'post',
				data: { idLocal: idLocal},
				success: function(data){
					conteudo.html(data); 
				},
				//continuação do ajax v
				//exemplo extra 
				beforeSend: function (){
					$('#loader').css({display:"block"});
				},
		
				complete: function(){
					$('#loader').css({display:"none"});
				}
			});

		}

		return{
			carregar : carregar,
			cadastrar: cadastrar,
			atualizar : atualizar,
			remover : remover,
			buscaProduto : buscaProduto,
			carregarLocalConteudo : carregarLocalConteudo,
			carregarLocais : carregarLocais
		}

	}

	produto  = new Produto;
	produto.carregar();
	produto.carregarLocais();

	//forma de evento para funcionar em mobile
	$(document).on('keyup',"#produto_busca", function(){
		var query = (document.getElementById('produto_busca').value);
		if(query.length >= 0){
			produto.buscaProduto(query);
	 	}
	});

	//clic para adicionar um produto
	$(document).on('click',"#btn-cadastrar", function(e){
		e.preventDefault();
		var form = $("#modal_adicionar")[0];
		var formData = new FormData(form);
		produto.cadastrar(formData);
	});

	$(document).on('click',".btn_deletar", function(e){
		e.preventDefault();
		var tombamento = $(this).attr('id');
		produto.remover(tombamento);

	});

	$(document).on('click',"#btn_atualizar", function(e){
		e.preventDefault();
		var form = $("#modal_atualizacao")[0];
		var dados = new FormData(form);
		produto.atualizar(dados);

	});

});

 function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

         reader.onload = function (e) {
         	$('#'+id).attr('src', e.target.result);
		}

    	 reader.readAsDataURL(input.files[0]);
	}
}