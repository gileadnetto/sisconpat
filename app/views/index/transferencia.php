<div class="row">
	<div class="col-md-12">
	<h2 style="margin-top:0px;">Gerenciamento de Transferencias</h2>
		<div class="row">
			<div class="col-sm-9">
				<button type="button" id="btn_cad" class="btn btn-primary">Nova transferencia</button>
			</div>
		</div><br>
		<table id="dataTableTransferencia" class="table table-striped table-bordered table-hover display" width="100%">
			<thead>
                <tr>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Quantidade de itens</th>
                    <th>Data</th>
                    <th>Usuario</th>
                    <th>Acoes</th>
            </thead>
		</table>
     
	</div>
</div>
<script type="text/javascript">
var formAdicionarTransferencia = 'form_adicionar_Transferencia';
transferencia.carregarConteudo();

var configInputsFormTransferir = [
	{label : 'Origem', name : 'id_localidade_origem', tamanho: 12, type: 'select', url:'getAutoCompleteLocalidadeList', classe:'select2'},
	{label : 'Destino', name : 'id_localidade_destino', tamanho: 12, type: 'select', url:'getAutoCompleteLocalidadeList', classe:'select2'},
	{label : 'Data', name : 'data', tamanho: 4},
	{label : 'Patrimonios', name : 'ids_Patrimonios', tamanho: 12, type: 'select', url:'getAutoCompletePatrimonioList', classe:'select2',multiple:true},
];

var onclickClosure = 'transferencia.transferir($(\'#' + formAdicionarTransferencia + '\'))';

var configButtonsFormTransferir = [
	{'type' : 'button', 'class' : 'btn btn-default', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-transferencia', 'fechaModal' : true},
	{'type' : 'button', 'class' : 'btn btn-primary', 'name' : 'Transferir', 'id_button' : 'btn-cadastrar-transferencia', 'onClosureClick' : onclickClosure}
	];

var $modal = modalhelper.modalCreate(formAdicionarTransferencia, 'Realizar Transferencia', htmlhelper.createElementsByType(configInputsFormTransferir), htmlhelper.createElementsByType(configButtonsFormTransferir));

$modal.appendTo('body');

$('#btn_cad').on('click', function(){
	$($modal).modal('show');
	autocompleteHelper.createAutoComplete();
});
</script>





















