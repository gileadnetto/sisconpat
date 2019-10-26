var Patrimonio = function(){
	
	var tablePatrimonio;
	/**
	 * Função responsavel por carregar o conteudo da listagem de patrimonios.
	 */
	var carregarConteudo = function()
	{
		tablePatrimonio = $('#dataTablePatrimonio').DataTable(
    		{
    			"ajax": "getPatrimonio",
    	        columns: [
    	        	/*{ "data": "FOTO",
    					render: function (data, type, row) {
    						return '<center><img src="imagens/patrimonio/'+data+'" class="img-responsive" alt="Patrimonio-IMG" width="120" ></center>';    						
    					}
    	        	},*/
    				{ "data": "PATRIMONIO"},
    				{ "data": "DESCRICAO"},
    				{ "data": "TOMBAMENTO"},
    				{ "data": "LOCALIDADE"},
    				{ "data": "VALOR",
    					render: function (data, type, row) {
						return "R$" + data;
					}
				},
    				{ "data": "VIDAUTIL"},
    				{ "data": "VALORDEPRECIACAO",
    					render: function (data, type, row) {
    						return "R$" + data;
    					}
    				},
    				{ "data": "DT_CAD",
    					render: function (data, type, row) {
    						return moment(data).format("DD/MM/YYYY HH:mm:ss");
    					}
    				},
    				{ "data": "Acoes",
    					render: function (data, type, row) {
    					var buttons = [{'text' : 'Editar'}];
    					  return htmlhelper.dropdownAcoesCreate(buttons);
    					}
        				
    				}
    	        ],
    	        language: {
	    	        search: "Pesquisa",
	    	        emptyTable: "Nenhum patrimonio cadastrado!",
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
				
		tablePatrimonio.on( 'click', 'a', function () {
    		var data = tablePatrimonio.row( $(this).parents('tr') ).data();
    		
    		var formAtualizarPatrimonio = 'form_atualizar_Patrimonio';
    		
    		var configInputsFormAtualizar = [
    			{label : 'Patrimonio', 				name : 'patrimonio', 		tamanho: 12, 	'value' : data['PATRIMONIO']},
    			{label : 'Descrição', 				name : 'descricao' , 		tamanho: 12, 	'value' : data['DESCRICAO']},
    			{label : 'Tombamento', 				name : 'tombamento', 		tamanho: 4, 	'value' : data['TOMBAMENTO']},
    			{label : 'Valor', 					name : 'valor', 			tamanho: 4, 	'value' : data['VALOR']},
    			{label : 'Vida Util (Anos)',		name : 'vidautil', 			tamanho: 4,		'value' : data['VIDAUTIL']},
    			{label : 'Valor depreciação(Mês)',	name : 'valordepreciacao',	tamanho: 6,		'value' : data['VALORDEPRECIACAO'], 'disabled': true},
    			{label : 'Localidade', 				name : 'localidade', 		tamanho: 6, 	'value' : data['LOCALIDADE']},
    			{label : 'id_atualizacao', 			name : 'id_atualizacao', 	'type':'hidden','value' : data['ID']}
			];
    		
    		var onclickClosure = 'patrimonio.atualizarlocal($(\'#' + formAtualizarPatrimonio + '\'))';
			
			var configButtonsFormAtualizar = [
				{'type' : 'button', 'class' : 'btn btn-danger', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-localidade', 'fechaModal' : true},
				{'type' : 'submit', 'class' : 'btn btn-primary', 'name' : 'Atualizar', 'id_button' : 'btn_atualizar', 'onClosureClick' : onclickClosure}
				];
			
			modalhelper.modalCreate(formAtualizarPatrimonio, 'Atualizar Patrimonio', htmlhelper.inputCreate(configInputsFormAtualizar), htmlhelper.buttonCreate(configButtonsFormAtualizar));
		} );
	}
	
	/**
	 * Função responsavel por chamar a persistencia de um novo local.
	 */
	var cadastrar = function($form)
	{debugger;
		var form = $form.serialize();
		$.ajax({
			type: "POST",                       
	        url:'Cadastrarpatrimonio', 
	        data: form,
			success: function(data){
				var result = JSON.parse(data);
				if(result.sucesso) {  
					msghelper.showMsgSucess('Patrimonio cadastrado com sucesso.');
				} else {
					msghelper.showMsgErro('Erro ao cadastrar patrimonio. '+ result.constraint);
				} 
			},
			complete: function(data){
				$(".close").click();
				window.location.reload(true);
			},
			error: function(data){
				msghelper.showMsgErro('Erro ao cadastrar local.');
			}
		});
	}
	
	return {
		carregarConteudo : carregarConteudo,
		cadastrar		 : cadastrar
	};
}

var patrimonio = new Patrimonio();	

    