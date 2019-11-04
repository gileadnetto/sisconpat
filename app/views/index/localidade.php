<div class="row">
	<div class="col-md-12">
	<h2 style="margin-top:0px;">Gerenciamento de Localidade</h2>
		<div class="row">
			<div class="col-sm-9">
				<button type="button" id="btn_cad" class="btn btn-primary">Novo</button>
			</div>
		</div><br>
		<table id="dataTableLocalidade" class="table table-striped table-bordered table-hover display" width="100%">
			<thead>
                <tr>
                    <th>Descrição</th>
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
            </thead>
		</table>
     
	</div>
</div>
<script type="text/javascript">
var formAdicionarLocalidade = 'form_adicionar_Localidade';
local.carregarConteudo();

var configInputsFormCadastrar = [
	{label : 'Descrição', name	: 'descricao', tamanho: 6},
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





















