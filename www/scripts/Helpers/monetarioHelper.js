/**
 * Responsavel por centralizar todos os metodos de estilização visual dos valores monetarios da view.
 */
var MonetarioHelper = function()
{
	
	var formatToBr = function(valor)
	{
		
	}
	/**
	 * return float valor - 27.199,90
	 */
	var usaToBr = function(valor)
	{
		return valor;
	}
		
	return {
		formatToBr : formatToBr,
		usaToBr : usaToBr
	};
}

var monetarioHelper = new MonetarioHelper();

