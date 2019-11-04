var msgHelper = function(){
	
	var showMsgSucess = function(msg)
	{
		var html = [
		'<div  id="alerta" class="alert alert-success alert-fixed collapse">',
			'<a id="linkClose" href="#" class="close">&times;</a>',
			'<center><strong>Sucesso! </strong><span id="alert_msg">' + msg + '</span> !!!</center>',
		'</div>'
		]
		var html = html.join('');
		
		$(html).appendTo('body').show('fade');
		setTimeout(function () {
			$("#alerta").hide('fade');
         }, 3000);
	}
	
	var showMsgErro = function(msg)
	{
		var html = [
		'<div  id="alerta_erro" class="alert alert-danger alert-fixed collapse">',
			'<a id="linkClose" href="#" class="close">&times;</a>',
			'<center><strong>Erro! </strong><span id="alert_msg_erro">' + msg + '</span> !!!</center>',
		'</div>'
		]
		var html = html.join('');
		$(html).appendTo('body').show('fade');
		
		setTimeout(function () {
			$('#alerta_erro').hide('fade');
         }, 3000);
	}

	return {
		showMsgSucess : showMsgSucess,
		showMsgErro : showMsgErro
	};
}

var msghelper = new msgHelper();

