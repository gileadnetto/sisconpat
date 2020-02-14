<!-- Page Header-->
<header class="page-header">
	<div class="container-fluid">
		<h2 class="no-margin-bottom">Gerenciamento de Localidade</h2>
	</div>
</header>

<div class="container-fluid mt-3">
	<div class="row mb-5">
		<div class="col-12">
	
			<button type="button" id="btn_cad" class="btn btn-primary m-2">Novo</button>
			
			<table id="dataTableLocalidade" class="table table-striped table-bordered table-hover display">
				<thead>
					<tr>
						<th>descriçao</th>
						<th>Status</th>
						<th>Localidade</th>
						<th>CEP</th>
						<th>Logradouro</th>
						<th>Bairro</th>
						<th>Numero</th>
						<th>Complemento</th>
						<th>UF</th>
						<th>data do Cadastro</th>
						<th>Acoes</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
var formAdicionarLocalidade = 'form_adicionar_Localidade';
local.carregarConteudo();

var configInputsFormCadastrar = [
	{label : 'Descriçao', name	: 'descricao', tamanho: 6},
	{label : 'localidade', name : 'localidade' , tamanho: 6},
	{label : 'CEP', name : 'cep', tamanho: 4},
	{label : 'UF', name : 'uf', tamanho: 2},
	{label : 'Bairro', name : 'bairro', tamanho: 6},
	{label : 'Logradouro', name : 'logradouro', tamanho: 12},
	{label : 'Numero', name : 'numero', tamanho: 4},
	{label : 'Complemento', name : 'complemento', tamanho: 8},	
];

var onclickClosure = 'local.cadastrar($(\'#' + formAdicionarLocalidade + '\'))';

var configButtonsFormCadastrar = [
	{'type' : 'button', 'class' : 'btn btn-default', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-localidade', 'fechaModal' : true},
	{'type' : 'button', 'class' : 'btn btn-primary', 'name' : 'Cadastrar', 'id_button' : 'btn-cadastrar-localidade', 'onClosureClick' : onclickClosure}
	];

var $modal = modalhelper.modalCreate(formAdicionarLocalidade, 'Adicionar Localidade', htmlhelper.createElementsByType(configInputsFormCadastrar), htmlhelper.createElementsByType(configButtonsFormCadastrar));

$modal.appendTo('body');

$('#btn_cad').on('click', function(){
	$($modal).modal('show');
});	
</script>





















