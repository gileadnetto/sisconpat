$(document).ready( function (){
	Usuario = function(){

		var conteudo = $('#conteudo'); 

		/**
		* 
		* @description funcão responsavel por carregar os usuarios
		*/
		var carregar = function(){

			tabela = $('#dataTableUsuario').DataTable(
				{
					"ajax": "getUsuario",
					"bDestroy": true,
					columns: [
						{ "data": "login"},
						{ "data": "email"},
						{ "data": "perfil"},
						{ "data": "Acoes",
							render: function (data, type, row) {
							var buttons = [{'text' : 'Editar'}];
							  return htmlhelper.dropdownAcoesCreate(buttons);
							}
							
						}
					],
					language: {
						search: "Pesquisa",
						emptyTable: "Nenhum usuario cadastrado!",
						paginate: {
							"first":      "Inicio",
							"last":       "Fim",
							"next":       "Próximo",
							"previous":   "Anterior"
						},
						lengthMenu:"_MENU_",
						info:           "Mostrando _START_ até _END_ de _TOTAL_ registros",
						infoEmpty:      "Mostrando 0 até 0 de 0 registros",
	
					}
				} 
			);

		}

		/**
		 * 
		 * @param {*integer} id 
		 * @description funcão responsavel por remover um usuario pelo o seu id
		 */
		var remover = function(id){
			$.ajax({
				url: 'deletUsuario',
				method: 'post',
				data: {id: id},

				success:function(data){
					$('#alert_msg').html('Deletado');//colocar a msg 
					$('#alerta').show('fade');

					setTimeout(function () {
						$('#alerta').hide('fade');
					}, 2000);  

					$('#'+id).closest('.tabela').remove();

				}
			});
		}

		var cadastrar = function($form){   
			var form = $form.serialize();
			// Limpando os erros de inputs
			$($form).find('.invalid-input').html('');

			$.ajax({  
				type: "POST",                       
				url:'cadastrarUsuario', 
				data: form,
				success: function(data){
					var result = JSON.parse(data);
					if(result.sucesso) {  
						msghelper.showMsgSucess(result.msg);
					} else {

						// Percorrendo os erros e inserindo os inputs 
						if(result.constraint){
							var erros = result.constraint;
							for (var index in erros){
								$($form).find('input#'+index).after('<small class="invalid-input">'+ erros[index] +'</small>');
							}
						}

						// se temos msg de erro devo exibir
						if(result.msg){
							msghelper.showMsgErro(result.msg);
						}
						
					} 
				},
				complete: function(data){
					var result = JSON.parse(data.responseText);
					if(result.sucesso) { 
						$(".close").click();
						tabela.ajax.reload();
						$($form).find('input').val('');
					}
				},
				error: function(data){
					msghelper.showMsgErro('Erro ao cadastrar usuario.');
				}
			}); 
			// window.location.reload();
		}

		var atualizar = function(dados){
			//var dados = $('#modal_atualizacao').serialize();
			$.ajax({
				url:'updateUsuario', 
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
				
			});
		}

		return{
			carregar : carregar,
			cadastrar: cadastrar,
			atualizar : atualizar,
			remover : remover,
		}
	}

	usuario  = new Usuario;
	usuario.carregar();
});
   