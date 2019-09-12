<?php
$transferencias = (array)$this->view->resultado;

if($transferencias['total'] == 0){
	echo"<center><h3>Nenhum Patrimonio cadastrado(Disponivel) nessa dependencia</h3> </center>";
	return;
}

$html ='';
$html .='<table  class="table table-striped table-bordered table-hover ">';

	$html .='<thead>';
		$html .=' <tr>';
			$html .='<th>Patrimonio</th>';
			$html .='<th>descricao</th>';
			$html .='<th>Tombamento</th>';
			$html .='<th><center>Transferir</center></th>';
			$html .='</tr>';
			$html .='</thead>';
		$html .='<tbody>';

		foreach ($transferencias['results'] as $res) {
			$res = (array) $res;
			if($res['ATIVO'] != 0){
				$html .='<tr>';
						
					$html .='<td>'.$res['PATRIMONIO'].'</td>';
					$html .='<td>'.$res['DESCRICAO'].'</td>';
					$html .='<td>'.$res['TOMBAMENTO'].'</td>';
					$html .='<td>';
			
					$html .='<center>';
						$html .='<div class="btn-group" data-toggle="buttons">';
							// mudei para o id';
							$html .='<label   class="btn btn-primary ">'; 
								$html .='<input id="check_transferir_patrimonio_'.$res['ID'].'" value="'.$res['ID'].'" name="check_transferir_patrimonio[]"  data-id_patrimonio="'.$res['TOMBAMENTO'].'" type="checkbox" autocomplete="off" >';
								$html .='<span class="glyphicon glyphicon-ok"></span>';
							$html .='</label>';

						$html .='</div>';
					$html .='</center>';

					$html .='</td> ';                            
				$html .='</tr>';
			}
		}

	$html .='</tbody>';
$html .='</table>';
echo $html;
?>