


<div class="row">
	<div class="col-md-12">
	<h2 style="margin-top:0px;">Gerenciamento de Usuarios</h2>
		<div class="row">
			<div class="col-sm-9">
				<button type="button" id="btn_cad" class="btn btn-primary">Novo</button>
			</div>
		</div><br>
		<table id="dataTableUsuario" class="table table-striped table-bordered table-hover display" width="100%">
			<thead>
                <tr>
                    <th>Login</th>
                    <th>Email</th>
                    <th>perfil</th>
					<th>Acoes</th>
				</tr>
            </thead>
		</table>
     
	</div>
</div>
<script type="text/javascript">
var formAdicionar = 'form_adicionar_Usuario';

var configInputsFormCadastrar = [
	{label : 'Nome', name	: 'login', tamanho: 12},
	{label : 'Email', name : 'email' , tamanho: 5},
	{label : 'Senha', name : 'senha', tamanho: 5},
	{label : 'Perfil', name : 'perfil', tamanho: 5},	
];

var onclickClosure = 'usuario.cadastrar($(\'#' + formAdicionar + '\'))';

var configButtonsFormCadastrar = [
	{'type' : 'button', 'class' : 'btn btn-default', 'name' : 'Cancelar', 'id_button' : 'btn-cancelar-localidade', 'fechaModal' : true},
	{'type' : 'button', 'class' : 'btn btn-primary', 'name' : 'Cadastrar', 'id_button' : 'btn-cadastrar-localidade', 'onClosureClick' : onclickClosure}
	];

var $modal = modalhelper.modalCreate(formAdicionar, 'Adicionar Usuario', htmlhelper.createElementsByType(configInputsFormCadastrar), htmlhelper.createElementsByType(configButtonsFormCadastrar));

$modal.appendTo('body');

$('#btn_cad').on('click', function(){
	$($modal).modal('show');
});	

</script>