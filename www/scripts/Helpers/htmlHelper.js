/**
 * Responsavel por centralizar a criação de html padrão
 */
var HtmlHelper = function()
{
	/**
	 * Responsavel pela criação de input group
	 * array[
	 * 		{'type':'type', 'label':'label', 'name':'name', 'value':'value', 'tamanho':'tamanho' },
	 * 		...
	 * ]
	 */
	var inputCreate = function(array){
		var html = [];
		var htmlInputs = [];
		var type, label, name, value, tamanho, disabled;
		
		array.some(function(key){
			tamanho = (key['tamanho'] ? " col-sm-" + key['tamanho'] : "");
			classe = (key['classe'] ? key['classe'] : "");
			
			if(key['type'] != "select"){
				type = (key['type'] ? 'type="' + key['type'] + '"' : 'type="text"');
				label = (key['type'] == 'hidden' ? '' :' <label>'+ key["label"] +'</label>');
				name = key["name"];
				value = (key['value'] ? 'value="' + key['value'] + '"' : '');
				disabled = (key['disabled'] ? "disabled" : "");
				
				
				html = [
					'<div class="form-group'+ tamanho +'">',
						label,
						'<input ' + type + ' class="form-control' + classe + '" name="' + name + '" id="' + name + '"' + value + disabled + '>',
					'</div>',				
				];
			} else {
				html = [
					'<div class="form-group'+ tamanho +'">',
						'<label>'+ key["label"] +'</label>',
						'<select  class="form-control ' + classe + '" data-url="' + key["url"] + '"></select>',
					'</div>'
					];
			}

			htmlInputs += html.join('');
		});	

		return htmlInputs;
	}
	
	/**
	 * Responsavel pela criação de botões
	 * @param array[
	 * 			{'type':'type','class':'class','name':'name', 'id_button':'id_button', 'onClosureClick':'onClosureClick','fechaModal':'fechaModal'},
	 * 			...
	 * 		  ]
	 */
	var buttonCreate = function(array){		
		var html = [];
		var htmlButtons = [];
		var type, classe, name, id_button, onClosureClick, fechaModal;
		
		array.some(function(key){
			type = (key["type"] || 'submit');
			classe = (key["class"] || 'btn btn-default');
			name = key["name"];
			id_button = (key["id_button"] || 'btn');
			onClosureClick = (key["onClosureClick"] ? 'onclick="' + key["onClosureClick"] + '"' : '');
			fechaModal = (key["fechaModal"] ? 'data-dismiss="modal"' : '' );
				
			html = [
				'<button type="' + type + '"' + fechaModal + ' class="' + classe + '" id="'+ id_button +'"' + onClosureClick + '>' + name + '</button>',
			];
			
			htmlButtons += html.join('');
		});	
		
		return htmlButtons;
	}
	
	/**
	 * Responsavel pela criação do dropdown de ações dos datatables
	 * @param array[
	 * 			{'href':'href','text':'text'},
	 * 			...
	 * 		  ]
	 */
	
	var dropdownAcoesCreate = function(array){
		var html = [];
		var htmlOptions = [];
		var htmlOptionsAux = [];
		
		array.some(function(key){
			htmlOptionsAux = [
				'<li><a href="#">' + key['text'] + '</a></li>'
			]
			
			htmlOptions += htmlOptionsAux.join('');
		});
		
		html = [
			'<div class="dropdown">',
				'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ações',
				  '<span class="caret"></span></button>',
				  '<ul class="dropdown-menu">',
				    htmlOptions,
				  '</ul>',
			'</div>'];
		
		return html.join('');
	}
	
	return {
		inputCreate 	: inputCreate,
		buttonCreate	: buttonCreate,
		dropdownAcoesCreate	:	dropdownAcoesCreate
	};
}

var htmlhelper = new HtmlHelper();

