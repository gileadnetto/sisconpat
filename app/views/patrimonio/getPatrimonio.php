                   
<?php
	$patrimonio = (array) $this->view->patrimonio;
	

	if(!isset($patrimonio['total']) || $patrimonio['total']<=0){
		echo"<center><h3>Nenhum patrimonio Cadastrado ou Encontrado</h3> </center>";
		exit;
	}
?>

	<table class="table table-striped table-bordered table-hover ">
	<thead>
	<tr>
	<th>Foto</th>
	<th>Patrimonio</th>
	<th>Descricao</th>
	<th>Tombamento</th>
	<th>Local</th>
	<th></th>
	</tr>
	</thead>
	<tbody>
	<?php
	$html ='';
	
	if(isset($patrimonio['results']) && $patrimonio['results']){
	    foreach ( $patrimonio['results'] as $res) {
	        $res = (array) $res;
	        $html .= '<tr>';
	        $html .= '<td><center><img src="imagens/patrimonio/'.$res['FOTO'].'" class="img-responsive" alt="Patrimonio-IMG" width="120" ></center></td>';
	        $html .= '<td>'.$res['PATRIMONIO'].'</td>';
	        $html .= '<td>'.$res['DESCRICAO'].'</td>';
	        $html .= '<td>'.$res['TOMBAMENTO'].'</td>';
	        $html .= '<td>'.$res['LOCAL'].'</td>';
	        $html .= ' <td>';
	        $html .= '<div class="btn-group" data-toggle="buttons">';
	        $html .='<button type="button"  id="btn_deletar_'.$res['TOMBAMENTO'].'" class="btn btn-danger  btn_deletar" data-tombamento="'.$res['TOMBAMENTO'].'" style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-trash"></spam></button>';
	        $html .='<button type="button"  id="btn_atualizar_'.$res['TOMBAMENTO'].'" class="btn btn-primary  btn_atualizar" data-tombamento="'.$res['TOMBAMENTO'].'" data-toggle="modal"';
	        $html .='data-target="#modal_atualizacao"  ';
	        $html .='data-tombamento="'.$res['TOMBAMENTO'].'" ';
	        $html .='data-produto="'.$res['PATRIMONIO'].'" ';
	        $html .='data-descricao="'.$res['DESCRICAO'].'"';
	        $html .='data-local="'.$res['ID_LOCALIDADE'].'" ';
	        $html .='data-foto="'.$res['FOTO'].'" ';
	        $html .= 'style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-pencil"></spam></button>';
	        $html .= '</div>';
	        $html .= ' <div class="clearfix"></div> ';
	        $html .= '</td>';
	        $html .= '</tr>';
	    }
	}
	echo $html;	
	$html = '';
?>
</tbody>
</table>


            

