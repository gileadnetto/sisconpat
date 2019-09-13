usuario = function(){

	var conteudo = $('#conteudo').html(data); 

	/**
	* 
	* @description funcão responsavel por carregar os locais
	*/
	var carregar = function(){
		$.ajax({
			url:'getUsuario', 

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

	var cadastrar = function(formData){   
		$.ajax({  
			type: "POST",                       
			url:'cadastrarUsuario', 
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

usuario  = new Local;
usuario.carregar();
   