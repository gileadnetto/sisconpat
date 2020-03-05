<!-- Page Header-->
<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Gerenciamento de Patrimonio</h2>
	</div>
</header>

<div class="container-fluid mt-3">
	<div class="row mb-5">
		<div class="col-12">
			<button type="button" id="btn_cad" class="btn btn-primary m-2">Novo</button>
			
			<table id="dataTablePatrimonio" class="table table-striped table-bordered table-hover display" width="100%">
				<thead>
					<tr>
						<th>Foto</th>
						<th>Patrimonio</th>
						<th>Descricao</th>
						<th>Tombamento</th>
						<th>Localidade</th>
						<th>Valor</th>
						<th>Vida Util(Anos)</th>
						<th>Valor de depreciaçao(Meses)</th>
						<th>Data do cadastro</th>
						<th>Acoes</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
var formAdicionarPatrimonio = 'form_adicionar_Patrimonio';
patrimonio.carregarConteudo();

var configInputsFormCadastrar = [
	{label : 'Patrimonio', name : 'patrimonio' , tamanho: 12},
	{label : 'Descricao', name : 'descricao', tamanho: 12},
	{label : 'Tombamento', name : 'tombamento', tamanho: 4},
	{label : 'Valor', name : 'valor', tamanho: 4},
	{label : 'Vida Util (Anos)', name : 'vidautil', tamanho: 4},
	{label : 'Localidade', name : 'id_localidade', tamanho: 12, type: 'select', url:'getAutoCompleteLocalidadeList', classe:'select2'}
];

var configButtonsFormCadastrar = [
	{'type' : 'button', 'class' : 'btn btn-default', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-patrimonio', 'fechaModal' : true},
	{'type' : 'button', 'class' : 'btn btn-primary ml-2', 'name' : 'Cadastrar', 'id_button' : 'btn-cadastrar-patrimonio'}
	];

var $modal = modalhelper.modalCreate(formAdicionarPatrimonio, 'Adicionar Patrimonio', htmlhelper.createElementsByType(configInputsFormCadastrar), htmlhelper.createElementsByType(configButtonsFormCadastrar));

$modal.appendTo('body');

$('#btn_cad').on('click', function(){
	$($modal).modal('show');
	autocompleteHelper.createAutoComplete();
});	

$('#btn-cadastrar-patrimonio').on('click', function(){
	patrimonio.cadastrar($("#"+formAdicionarPatrimonio), $modal);
});

</script>










































