<?php
	$localidades = (array) $this->view->resultado;
	//var_dump($localidades);
	
	$html ='';
	
	$html .='<div class="input-group">';
		$html .='<span class="input-group-addon" id="busca_loc">Destino</span>';
		$html .='<select class="form-control" name="local_destino">';
			$html .='<option value="0">Selecione Local</option>';
			if(isset($localidades['results']) && $localidades['results']){
				foreach ( $localidades['results'] as $res) {
					$res = (array) $res;
					$html .='<option value='.$res['ID'].'>'.$res['DESCRICAO'].'</option>';
				}
			}
		$html .='</select>';
	$html .='</div>';

	echo $html;
?>

