var Transferencia = function(){
	
	var tableTransferencia;
	/**
	 * Função responsavel por carregar o conteudo da listagem de locais.
	 */
	var carregarConteudo = function()
	{
		tableTransferencia = $('#dataTableTransferencia').DataTable(
    		{
    	        "ajax": "getTransferencia",
    	        columns: [
    	        	{ "data": "ORIGEM"},
    				{ "data": "DESTINO"},
    				{ "data": "QUANT"},
    				{ "data": "DATA",
    					render: function (data, type, row) {
    						return moment(data).format("DD/MM/YYYY");
    					}
    				},
    				{ "data": "USUARIO"},
    				{ "data": "Acoes",
    					render: function (data, type, row) {
    					var buttons = [{'text' : 'Editar'}];
    					  return htmlhelper.dropdownAcoesCreate(buttons);
    					}
        				
    				}
    	        ],
	    		language: {
	    	        search: "Pesquisa",
	    	        emptyTable: "Nenhuma transferencia localizada!",
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
	
	var transferir = function($form)
	{
		var data = $form.serializeArray();
		
		$.ajax({
			type: "POST",                       
	        url:'transferir', 
	        data: {data},
			success: function(data){
				var result = JSON.parse(data);
				if(result.sucesso) {  
					msghelper.showMsgSucess('Transferencia cadastrado com sucesso.');
				} else {
					msghelper.showMsgErro('Erro ao Transferir os patrimonio. '+ result.constraint);
				} 
			},
			complete: function(data){
				$(".close").click();
				window.location.reload(true);
			},
			error: function(data){
				msghelper.showMsgErro('Erro ao realizar a transferencia.');
			}
		});
	}
	
	return {
		carregarConteudo : carregarConteudo,
		transferir		 : transferir
	};
}

var transferencia = new Transferencia();
