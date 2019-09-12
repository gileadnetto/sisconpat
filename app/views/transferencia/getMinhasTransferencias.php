<?php
$transferencias = $this->view->resultado;

$html = '';

$html .= '<div class="panel-group" id="accordion">';
	foreach ($transferencias['results'] as $res) {
		$res = (array) $res;
		$html .= '<div class="panel panel-default">';
			$html .= '<div class="panel-heading" role="tab" id="heading'.$res['ID'].'">';
				$html .= '<h4 class="panel-title">';
					
					$html .= '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$res['ID'].'" aria-expanded="true" aria-controls="collapse'.$res['ID'].' ">';
						$html .= '<spam class="fa fa-angle-double-down detalhes"></spam>&nbsp  <Strong> '.$res['origem'].'</Strong> Para  <Strong>'.$res['destino'].'</Strong>&nbsp;-&nbsp; Nº:'.$res['ID'].'';
					
						$html .= '<p class= "list-group-item-text pull-right">';
						$html .= '<small style="color:#ff6666;"> QTD Produto(s) '.$res['QUANT'].'</small>';
						$html .= ' - <spam class="data_minha_transferencia">'.$res['DT_MOV'].'</spam> </p>';  
					$html .= '</a>';
				$html .= '</h4>';
			$html .= '</div>';
								
			$html .= '<div ID="collapse'.$res['ID'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$res['ID'].'">';
				$html .= '<div class="panel-body">';
					$_SESSION['idTransferencia'] =  $res['ID'];
				$html .= '</div>';
				$html .= '<a class="list-group-item pdfmaker"  target="_blank" href="gerarPDFTransferencia?idTransferencia='.$res['ID'].'"><center><i class="fa fa-file-pdf-o fa-fw" aria-hidden="true"></i>&nbsp; Gerar PDF</center></a>';
			$html .= '</div>';
		$html .= '</div>';
	}	
$html .= '</div>';
$html .= '</div>';

echo $html;


?>