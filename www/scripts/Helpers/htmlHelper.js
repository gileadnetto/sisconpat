/**
 * Responsavel por centralizar a criação de html padrão
 */
var HtmlHelper = function()
{
	var createElementsByType = function(array){
		var html = [];
		array.some(function(key){
			switch(key['type']){
			case 'text':
				html += inputCreate(key);
				break;
			case 'select':
				html += inputSelectCreate(key);
				break;
			case 'date':
				html += inputDateCreate(key);
				break;
			case 'button':
				html += buttonCreate(key);
				break;
			default:
				html += inputCreate(key);
			}
		});
		
		return html;
	}
	
	/**
	 * Responsavel pela criação de input group
	 * array[
	 * 		{'type':'type', 'label':'label', 'name':'name', 'value':'value', 'tamanho':'tamanho' },
	 * 		...
	 * ]
	 */
	var inputCreate = function(array){
		var html = [];
		var tamanho, classe, type, label, name, value, disabled;
		
		tamanho = (array['tamanho'] ? " col-sm-" + array['tamanho'] : "");
		classe = (array['classe'] ? array['classe'] : "");
		type = (array['type'] ? 'type="' + array['type'] + '"' : 'type="text"');
		label = (array['type'] == 'hidden' ? '' :' <label>'+ array["label"] +'</label>');
		name = array["name"];
		value = (array['value'] ? 'value="' + array['value'] + '"' : '');
		disabled = (array['disabled'] ? "disabled" : "");
		
		
		html = [
			'<div class="form-group'+ tamanho +'">',
				label,
				'<input ' + type + ' class="form-control' + classe + '" name="' + name + '" id="' + name + '"' + value + disabled + '>',
			'</div>',				
		];

		return html.join('');
	}
	
	var inputSelectCreate = function(array){
		var html = [];
		var htmlInputs = [];
		var tamanho, classe, label, url;
		
		tamanho = (array['tamanho'] ? " col-sm-" + array['tamanho'] : "");
		classe = (array['classe'] ? array['classe'] : "");
		label = array["label"];
		name = array["name"];
		url = array["url"];
		multiple = (array['multiple'] ? "multiple='multiple'" : "");
		
		html = [
			'<div class="form-group '+ tamanho +' '+name+'">',
				'<label>'+ label,
				'</label>',
				'<div><select ' + multiple + ' name="'+name+'" id="'+name+'" class="form-control ' + classe + '" data-url="' + url + '"></select></div>',
			'</div>'
			];
		
		return html.join('');
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
		var type, classe, name, id_button, onClosureClick, fechaModal;
		
		type = (array["type"] || 'submit');
		classe = (array["class"] || 'btn btn-default');
		name = array["name"];
		id_button = (array["id_button"] || 'btn');
		onClosureClick = (array["onClosureClick"] ? 'onclick="' + array["onClosureClick"] + '"' : '');
		fechaModal = (array["fechaModal"] ? 'data-dismiss="modal"' : '' );
			
		html = [
			'<button type="' + type + '"' + fechaModal + ' class="' + classe + '" id="'+ id_button +'"' + onClosureClick + '>' + name + '</button>',
		];
		
		return html.join('');
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

	var inputDateCreate = function(array){
		var html = [];
		var tamanho, classe, type, label, name, value, disabled;
		
		tamanho = (array['tamanho'] ? " col-sm-" + array['tamanho'] : "");
		classe = (array['classe'] ? array['classe'] : "");
		type = (array['type'] ? 'type="' + array['type'] + '"' : 'type="text"');
		label = (array['type'] == 'hidden' ? '' :' <label>'+ array["label"] +'</label>');
		name = array["name"];
		value = (array['value'] ? 'value="' + array['value'] + '"' : '');
		disabled = (array['disabled'] ? "disabled" : "");
		
		
		html = [
			'<div id="datepicker-group" class="input-group date '+ tamanho +'" data-provide="datepicker">',
			'	<label>'+ label,
				'<input type="text" class="form-control" name="'+name+'" value="'+value+'">',
				'</label>',
				'<div class="input-group-addon">',
					'<span class="glyphicon glyphicon-th"></span>',
				'</div>',
			'</div>',
			
		];

		return html.join('');
	}
	

	
	return {
		createElementsByType	:	createElementsByType,
		dropdownAcoesCreate	:	dropdownAcoesCreate
	};
}

var htmlhelper = new HtmlHelper();

