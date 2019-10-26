<div class="row">
	<div class="col-md-12">
	<h2 style="margin-top:0px;">Gerenciamento de Patrimonio</h2>
		<div class="row">
			<div class="col-sm-9">
				<button type="button" id="btn_cad" class="btn btn-primary">Novo</button>
			</div>
		</div><br>
		<table id="dataTablePatrimonio" class="table table-striped table-bordered table-hover display" width="100%">
			<thead>
                <tr>
                    <!-- <th>Foto</th> -->
                	<th>Patrimonio</th>
                	<th>Descricao</th>
                	<th>Tombamento</th>
                	<th>Localidade</th>
                	<th>Valor</th>
                	<th>Vida Util(Anos)</th>
                	<th>Valor de depreciação(Meses)</th>
                	<th>Data do cadastro</th>
                    <th>Acoes</th>
            </thead>
		</table>
     
	</div>
</div>

<script type="text/javascript">
var formAdicionarPatrimonio = 'form_adicionar_Patrimonio';
patrimonio.carregarConteudo();
	
$('#btn_cad').on('click', function(){
	var configInputsFormCadastrar = [
		//{label : 'Foto', name	: 'descricao', tamanho: 6},
		{label : 'Patrimonio', name : 'patrimonio' , tamanho: 12},
		{label : 'Descricao', name : 'descricao', tamanho: 12},
		{label : 'Tombamento', name : 'tombamento', tamanho: 4},
		{label : 'Valor', name : 'valor', tamanho: 4},
		{label : 'Vida Util (Anos)', name : 'vidautil', tamanho: 4},
		{label : 'Localidade', name : 'id_localidade', tamanho: 6, type: 'select', url:'getAutoCompleteLocalidadeList', classe:'select2'}
	];

	var onclickClosure = 'patrimonio.cadastrar($(\'#' + formAdicionarPatrimonio + '\'))';
	
	var configButtonsFormCadastrar = [
		{'type' : 'button', 'class' : 'btn btn-danger', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-localidade', 'fechaModal' : true},
		{'type' : 'button', 'class' : 'btn btn-primary', 'name' : 'Cadastrar', 'id_button' : 'btn-cadastrar-localidade', 'onClosureClick' : onclickClosure}
		];

	var $modal = modalhelper.modalCreate(formAdicionarPatrimonio, 'Adicionar Patrimonio', htmlhelper.inputCreate(configInputsFormCadastrar), htmlhelper.buttonCreate(configButtonsFormCadastrar));

	setTimeout(function(){ autocompleteHelper.createAutoComplete(); }, 1000);
});  
	
</script>










































