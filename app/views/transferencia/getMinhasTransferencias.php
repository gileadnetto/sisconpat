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
									
					// $webservice= curl_init();
					// 	curl_setopt_array($webservice, array(
					// 		CURLOPT_URL=>BUSCA_ITENS_USUARIO_TRANSFERENCIA.$res['ID'],// url passado e definido na Constant no  CONFIG.PHP
					// 		CURLOPT_POST=> false,
					// 		CURLOPT_RETURNTRANSFER =>true
					// 	));

					// $resp = curl_exec($webservice);
					// curl_close($webservice);
					// $result  = json_decode($resp);

					// $result  = (array)  $result ;
					
					// foreach ($result['results'] as $resposta) {
					// 	$resposta  = (array)  $resposta ;
					// 	//echo "<br>".$resposta->produto;
					// 	$html .= '<div class="list-group-item">';
					// 		$html .= '<strong>'.$resposta['produto'].'</strong> - <small style="color:#666666;">'.$resposta['descricao'].'</small> - <small style="color:#ff8080;"> Tombamento: '.$resposta['TOMBAMENTO'].'</small>';
					// 		if($resposta['ativo']==="0"){
					// 			$html .= '<small> - produto inativo</small> ';
								
					// 		}
					// 		$html .= '<div class="clearfix"></div>';//ajeitar a tela , 
					// 	$html .= '</div>';
					// }
					$_SESSION['idTransferencia'] =  $res['ID'];
						//gerarPDF.php?idTransferencia='.$res['ID'].'"
							// <a class="list-group-item pdfmaker"  target="_blank" href="gerarPDF"><center><i class="fa fa-file-pdf-o fa-fw" aria-hidden="true"></i>&nbsp; Gerar PDF</center></a>';
				$html .= '</div>';
				$html .= '<a class="list-group-item pdfmaker"  target="_blank" href="gerarPDFTransferencia?idTransferencia='.$res['ID'].'"><center><i class="fa fa-file-pdf-o fa-fw" aria-hidden="true"></i>&nbsp; Gerar PDF</center></a>';
			$html .= '</div>';
		$html .= '</div>';
	}	
$html .= '</div>';
$html .= '</div>';

echo $html;


?>