var Local = function(){
	/**
	 * Função responsavel por carregar o conteudo da listagem de locais.
	 */
	var carregarConteudo = function()
	{
		$('#dataTableLocalidade').DataTable(
    		{
    			dom: 'Bfrtip',
    			"processing": true,
    	        "serverSide": true,
    	        "ajax": "getLocalidade",
    			columns: [
    				{ "data": "DESCRICAO" },
    			    { "data": "ENDERECO" },
    				{ "data": "DT_CAD",
    					render: function (data, type, row) {
    						return moment(data).format("DD/MM/YYYY HH:mm:ss");
    					}
        				
    				}
    	        ]
    		} 
        );
	}
	
	/**
	 * Função responsavel por deletar o local;
	 */
	var deletar = function()
	{
		 var id_local = $('#btn_deletar').data('id_local');  
         //alert(id_local);
	 	$.ajax({
	 		url:'deleteLocal',
	 		method:'post',
            data: {id_local : id_local},
            success: function(data){
            	if(data.success){
            		$('#alert_msg').html('deletada');
                    msghelper.showMsgSucess('Local deletado com sucesso.');
                    setTimeout(function () {
                    	$('#alerta').hide('fade');
                     }, 2000); 
                	carregarConteudo();   
            	} else {                          
            		$('#erro_delet').css({display:"block"});
            		msghelper.showMsgErro('Contem patrimonios cadastrados');
            		/*$('#alert_msg_erro').html('<strong> contem patrimonios cadastrados </strong>');//setar a msg de erro
            		$('#alerta_erro').show('fade');
            		setTimeout(function () {
        				$('#alerta_erro').hide('fade');
                     }, 2900); */
             	} 
            },
            error: function(data){
            	$('#erro_delet').css({display:"block"});
            	var msg = 'Não foi possivel deletar o local.' + data; 
            	msghelper.showMsgErro(msg);
            	/*$('#alert_msg_erro').html('<strong> Não foi possivel deletar o local.</strong>' + data);
        		$('#alerta_erro').show('fade');
        		setTimeout(function () {
    				$('#alerta_erro').hide('fade');
                 }, 2900);*/
            }
       });
	}
	/**
	 * Função responsavel por chamar a persistencia de um novo local.
	 */
	var cadastrar = function($form)
	{
		var form = $form.serialize();
		$.ajax({
			url:'cadastrarLocal', 
			method:'post',
			data:form,
			success: function(data){debugger;
				var result = JSON.parse(data);
				if(!result.erro){debugger;        
					$('#alert_msg').html('Adicionada');//setar a msg de sucesso
					$('#alerta').show('fade');
					setTimeout(function () {
						$('#alerta').hide('fade');
					}, 2000); 
					window.location.reload();
				} else {debugger;
					$('#alert_msg_erro').html('Nao foi possivel adicionar');//setar a msg de erro
					$('#alerta_erro').show('fade');
					setTimeout(function () {
						$('#alerta_erro').hide('fade');
					}, 2000); 
				} 
			},
			error: function(data){debugger;
				$('#alert_msg_erro').html('Nao foi possivel adicionar');//setar a msg de erro
				$('#alerta_erro').show('fade');
				setTimeout(function () {
					$('#alerta_erro').hide('fade');
				}, 2000); 
			}
		});
	}//fim funcao cadastrar
	
	/**
	 * Função responsavel chamar a persistencia dos dados para atualizar o local.
	 * @param form 
	 */
	 var atualizarlocal = function(form) 
	 {
         var form = $("#modal_atualizacao")[0];
         form = $(form).serialize()
         
         $.ajax({
             url:'updateLocal', 
             method:'post',
             data:form,
             success: function(data){
                 var result = JSON.parse(data);
                 if(!result.erro){
                     $('#alert_msg').html('Atualizado');//setar a msg de sucesso
                     $('#alerta').show('fade');
                     setTimeout(function () {
                     $('#alerta').hide('fade');
                     }, 2000);
                     $('[data-dismiss="modal"]').trigger('click');
                     carregarConteudoFora() 
                 } else {
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
                 let x = $("#modal_atualizacao")[0];
                 let input =$(x).find('input');
                 input.each(function() {
                   $(this).val('');
                 });
                 document.getElementById("btn_atualizar").innerHTML = "ATUALIZAR";
             },
             error: function(e) {}
         });
     }
     
	 /**
	  * Função responsavel por carregar o conteudo fora??
	  */
     var carregarConteudoFora = function()
     {                          
    	 $.ajax({
    		 url:'getLocalidade', 
             success: function(data){
            	 $('#conteudo').html(data); 
            	 $('.btn_deletar').click(function(){
	                 var id_local = $(this).data('id_local'); //id passada ao criar o botao 
	                 $.ajax({
	                	 url:'deletLocal',
	                	 method:'post',
	                	 data: {id_local : id_local},//mandar a var id_local para outra pagina com o nome da variavel id_local
	                	 success: function(data){ 
	                		 data = JSON.parse(data)
	                		 if(!data.erro){
	                			 $('#alert_msg').html('deletada');//setar a msg de sucesso
	                			 $('#alerta').show('fade');
	                			 setTimeout(function () {
	                				 $('#alerta').hide('fade');
	            			 	 }, 2000); 
	                			 carregarConteudoFora(); //atualizar a pagina apos deletado   
	                		 } else {       
	                			 $('#erro_delet').css({display:"block"});
	                			 $('#alert_msg_erro').html('<strong> contem patrimonios cadastrados </strong>');//setar a msg de erro
	                			 $('#alerta_erro').show('fade');
	                             setTimeout(function () {
	                            	 $('#alerta_erro').hide('fade');
	                             }, 2900); 
	                		 } 
	                	 }
	                 });
            	 }); 
             },
             beforeSend: function (){
            	 $('#loader').css({display:"block"});
         	},
         	complete: function(){
         		$('#loader').css({display:"none"});
         	}
    	 });    
     }
	
	return {
		cadastrar : cadastrar,
		deletar : deletar,
		carregarConteudo : carregarConteudo,
		atualizarlocal : atualizarlocal,
		carregarConteudoFora : carregarConteudoFora
	};
}

var local = new Local();

