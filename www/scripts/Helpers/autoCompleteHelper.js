/**
 * Responsavel por centralizar a criação de autocomplete
 */
var autoCompleteHelper = function()
{
	var createAutoComplete = function($input)
	{
		var $input = $('.select2');
		$input.each(function() {
			$(this).select2({
				ajax: {
					url: this.getAttribute('data-url'),
					delay: 250,
				    data: function (params) {
				        return {
				          q: params.term,
				          page: params.page
				        };
				    },
				    processResults: function (data, params) {
				    	var result = formatResults(data);
				    	return result;
			        },
			        cache: true
				},
				placeholder: 'Pesquisar',
				minimumInputLength: 3,
			});
		});
	}
	
	var formatResults = function(data)
	{
		var data = JSON.parse(data);
		var result = {};
		result = data[0].map(function(row, indice){
			return {
			      "id": row.ID,
			      "text": row.DESCRICAO
			    }
		});
		
		return {"results": result};
	}
	
	var getSelectedData = function()
	{
		var dataSelected = [];
		$(".select2 option:selected").each(function(row) {
			dataSelected.push({
					'name' : this['text'],
					'id' : this['value']
					});
		});
		return dataSelected;
	}
	return {
		createAutoComplete : createAutoComplete,
		getSelectedData : getSelectedData
	};
}

var autocompleteHelper = new autoCompleteHelper();

