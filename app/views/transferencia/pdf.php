<?php

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

$transferencias = $this->view->resultado;
$transferencia = reset($transferencias['results']);
$html = '';
// imagens\logo.png
$html .= '<div style="margin:0 43%;"> <img width="100"  style="transform: translateX(-50%);" src="imagens\logo.png"/></div>';

$html .= '<p style="text-align:center; margin:0;">Prefeitura Municipal de Iguaba Grande</p>';
$html .= '<p style="text-align:center; margin:0;">Movimentação de Bens Patrimoniais</p>';

$html .= '<p style="text-align:center; margin-top:1rem;">MOVIMENTAÇÂO PATRIMONIAL</p>';

    $html .= '<table border="1" style="width: 100%; border-collapse: collapse; margin:0 4%; ">';
        
        $html .= '<tr><td colspan="3" style="font-size: 110%; height: 27px; " ><strong>Movimentação nº: </strong>'.$transferencia['idT'].'</td></tr>';
        $html .= '<tr><td colspan="3" style="font-size: 110%; height: 27px;"><strong>Remetente (local Inicial): </strong>'.$transferencia['destino'].'</td></tr>';
        $html .= '<tr><td colspan="3" style="font-size: 110%; height: 27px;"><strong>Destinatario (local Final): </strong>'.$transferencia['origem'].'</td></tr>';

        $html .= '<tr style="height: 27px; background: #e1e1e1;text-align:center;">';
             $html .= '<td style="text-align:center; height: 27px;">PATRIMONIO</td>';
             $html .= '<td style="text-align:center; height: 27px;">DESCRIÇÃO</td>';
             $html .= '<td style="text-align:center; height: 27px;">TBM</td>';
        $html .= '</tr>';

        foreach($transferencias['results'] as $transferencia){
            $html .= '<tr>';
                $html .= '<td style=" height: 27px; padding: 0 5px;">'.$transferencia['patrimonio'].'</td>';
                $html .= '<td style=" height: 27px; padding: 0 5px; width: 230px;">'.$transferencia['descricao'].'</td>';
                $html .= '<td style=" height: 27px; padding: 0 5px;">'.$transferencia['TOMBAMENTO'].'</td>';
            $html .= '</tr>';
        }

        $html .= '<tr><td colspan="3" style="height: 27px; background: #e1e1e1;text-align:center;" >Autorizo a saída dos bens patrimoniais acima relacionados</td></tr>';
        $html .= '<tr>
                    <td colspan="1" style="padding: 4rem 0;  width: 180px;  height: 70px;">Assinatura: </td>
                    <td colspan="2" style="padding: 4rem 0;">Carimbo: </td>
                </tr>';

        $html .= '<tr><td colspan="3" style="height: 35px; padding: 1rem; background: #e1e1e1;text-align:center;" >Declaro ter recebido os bens patrimoniais acima descritos , desde já , assumo inteira responsabilidade por sua guarda e conservação , usando-os de maneira adequada para não diminuir sua vida útil.</td></tr>';
        $html .= '<tr>
                    <td colspan="1" style="height: 70px; padding: 4rem 0; min-width: 100px;">Assinatura: </td>
                    <td colspan="2" style="padding: 4rem 0;">Carimbo: </td>
                </tr>';

        $html .= '<tr style="background: #e1e1e1;">';
            $html .= '<td style=" text-align: center; height: 20px;">1ª Via - Remetente</td>';
            $html .= '<td style=" text-align: center; height: 20px;">2ª Via - Destinatario</td>';
            $html .= '<td style=" text-align: center; height: 20px;">3ª Via - Controle Patrimonial</td>';
        $html .= '</tr>';

    $html .= '</table>';

    echo $html;
   try {
       $html2pdf = new Html2Pdf('P', 'A4', 'fr', true, 'UTF-8', array(1, 1, 1, 1));
       $html2pdf->writeHTML($html);
       ob_end_clean();
       $html2pdf->output('teste.pdf');
   } catch (Html2PdfException $e) {
       $html2pdf->clean();
       $formatter = new ExceptionFormatter($e);
   }

// foreach($transferencias['results'] as $transferencia){
//     var_dump($transferencia['patrimonio']);
//     var_dump($transferencia['TOMBAMENTO']);
//     var_dump($transferencia['descricao']);
//     var_dump($transferencia['ativo']);
//     var_dump($transferencia['dt_mov']);
//     var_dump($transferencia['destino']);
//     var_dump($transferencia['origem']);
// }

//   $html2pdf = new Html2Pdf('P','A4');
//   $html2pdf->writeHTML($html);
//    ob_end_clean();
//   $html2pdf->output('eqas.pdf', 'D'); 
