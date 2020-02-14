var Local = function(){
	
	var tableLocalidade;
	/**
	 * Função responsavel por carregar o conteudo da listagem de locais.
	 */
	var carregarConteudo = function()
	{
		tableLocalidade = $('#dataTableLocalidade').DataTable(
    		{
				"ajax": "getLocalidade",
				"bDestroy": true,
    	        columns: [
    	        	{ "data": "DESCRICAO"},
    				{ "data": "ATIVO",
    					render: function (data, type, row) {
    						return data ? '<span class="badge badge-success">Ativo</span>' : '<span class="badge badge-danger">Inativo</span>' 
    					}
    	        	},
    				{ "data": "LOCALIDADE"},
    				{ "data": "CEP"},
    				{ "data": "LOGRADOURO"},
    				{ "data": "BAIRRO"},
    				{ "data": "NUMERO"},
    				{ "data": "COMPLEMENTO"},
    				{ "data": "UF"},
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
	    	        emptyTable: "Nenhuma localidade cadastrada!",
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
				
		tableLocalidade.on( 'click', 'a', function () {
    		var data = tableLocalidade.row( $(this).parents('tr') ).data();
    		
    		var formAtualizarLocalidade = 'form_atualizar_Localidade';
    		
    		var configInputsFormAtualizar = [
    			{label : 'Descrição', name	: 'descricao', tamanho: 6, 'value' : data['DESCRICAO']},
    			{label : 'localidade', name : 'localidade' , tamanho: 6,  'value' : data['LOCALIDADE']},
    			{label : 'CEP', name : 'cep', tamanho: 4,  'value' : data['CEP']},
    			{label : 'UF', name : 'uf', tamanho: 2,  'value' : data['UF']},
    			{label : 'Bairro', name : 'bairro', tamanho: 6,  'value' : data['BAIRRO']},
    			{label : 'Logradouro', name : 'logradouro', tamanho: 12,  'value' : data['LOGRADOURO']},
    			{label : 'Numero', name : 'numero', tamanho: 4,  'value' : data['NUMERO']},
    			{label : 'Complemento', name : 'complemento', tamanho: 8,  'value' : data['COMPLEMENTO']},
    			{label : 'id_atualizacao', name : 'id_atualizacao', 'type':'hidden', 'value' : data['ID']}
			];
			
			var configButtonsFormAtualizar = [
				{'type' : 'button', 'class' : 'btn btn-danger', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-localidade', 'fechaModal' : true},
				{'type' : 'submit', 'class' : 'btn btn-primary', 'name' : 'Atualizar', 'id_button' : 'btn_atualizar', 'onClosureClick' : 'local.atualizarlocal($(\'#' + formAtualizarLocalidade + '\'))'}
				];
			
			modalhelper.modalCreate(formAtualizarLocalidade, 'Atualizar Localidade', htmlhelper.inputCreate(configInputsFormAtualizar), htmlhelper.buttonCreate(configButtonsFormAtualizar));
		} );
	}

	/**
	 * Função responsavel por chamar a persistencia de um novo local.
	 */
	var cadastrar = function($form)
	{
		var form = $form.serialize();

		// Limpando os erros de inputs
		$($form).find('.invalid-input').html('');
		
		$.ajax({
			type: "POST",                       
	        url:'cadastrarLocal', 
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
					tableLocalidade.ajax.reload();
					$($form).find('input').val('');
					$($form).find('.invalid-input ').html('');
				}
			},
			error: function(data){
				msghelper.showMsgErro('Erro ao cadastrar local.');
			}
		});
	}
	
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
	
	return {
		cadastrar : cadastrar,		
		carregarConteudo : carregarConteudo,
		atualizarlocal : atualizarlocal
	};
}

var local = new Local();

