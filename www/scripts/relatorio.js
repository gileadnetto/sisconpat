
// código javascript  
$(document).ready(function () {

	carregarConteudo();

	function carregarConteudo() {

		$.ajax({
			url: 'relatorio_grafico',
			success: function (data) {
				$('#conteudo').html(data);
			},
			beforeSend: function () {
				$('#loader').css({ display: "block" });
			},

			complete: function () {
				$('#loader').css({ display: "none" });
			}
		});

	} // fim da funcao carregar conteudo

});