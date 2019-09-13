$(document).ready( function (){
	
	Local = function(){

		var conteudo = $('#conteudo'); 

		/**
		* 
		* @description funcão responsavel por carregar os locais
		*/
		var carregar = function(){
			$.ajax({
				url:'getLocalidade', 

				success: function(data){
					conteudo.html(data);
				},
		
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
		 * @param {*integer} id_local 
		 * @description funcão responsavel por remover um local pelo o seu id
		 */
		var remover = function(id_local){
			$.ajax({
				url: 'deletLocal',
				method: 'post',
				data: {id_local: id_local},

				success:function(data){
					$('#alert_msg').html('Deletado');//colocar a msg 
					$('#alerta').show('fade');

					setTimeout(function () {
						$('#alerta').hide('fade');
					}, 2000);  

					$('#'+id_local).closest('.tabela').remove();

				}
			});
		}

		var cadastrar = function(formData){   
			$.ajax({  
				type: "POST",                       
				url:'cadastrarLocal', 
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
						$('#form_cadastrar')[0].reset();
						
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
				
			}); 
			// window.location.reload();
		}

		var atualizar = function(dados){
			//var dados = $('#modal_atualizacao').serialize();
			$.ajax({
				url:'updateLocal', 
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
						$('#modal_atualizacao')[0].reset();
						
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
				
			});
		}

		return{
			carregar : carregar,
			cadastrar: cadastrar,
			atualizar : atualizar,
			remover : remover,
		}
	}

	local  = new Local;
	local.carregar();

	//clic para adicionar um local
	$(document).on('click',"#btn-cadastrar", function(e){
	 	e.preventDefault();

	 	var form = $("#form_cadastrar")[0];
	 	var formData = new FormData(form);
	 	local.cadastrar(formData);
	});

	//clic para remover um local
	$(document).on('click',".btn-deletar", function(e){
		e.preventDefault();

		var id = $(this).data("id");
		local.remover(id);
	});

	//clic para atualizar um local
	$(document).on('click',"#btn_atualizar_modal", function(e){
		e.preventDefault();

		var form = $(this).closest("form")[0]; 
		// $("#form_cadastrar")[0];
		var formData = new FormData(form);
		local.atualizar(formData);

	});

	function cadastrarLocal(){
		alert("teste");

	 	var form = $("#form_cadastrar")[0];
	 	var formData = new FormData(form);
	 	local.cadastrar(formData);
	}


});
	