// código javascript  
$(document).ready(function () {

	carregarConteudo();

	function carregarConteudo() {

		$.ajax({
			//url:'consulta_sql.php',
			url: 'estatisticaHome',

			success: function (data) {
				$('#conteudo').html(data);
			},
			//continuação do ajax principal

			beforeSend: function () {
				$('#loader').css({ display: "block" });

			},

			complete: function () {
				$('#loader').css({ display: "none" });
			}
		});

		$.ajax({
			//url:'consulta_sql.php',
			url: 'relatorio_grafico',

			success: function (data) {
				$('#relatorio').html(data);
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