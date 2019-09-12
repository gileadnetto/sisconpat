<?php
	$results =  (array) $this->view->resultado ;
	
	function desenha_zebrado($pdf, $value_zeb){
		
		if (!$value_zeb){
			$pdf->SetFillColor(255,255,255);
			$value_zeb = true ; 
		} else {
			$pdf->SetFillColor(225,225,225);
			$value_zeb = false ; 
		}
		$pdf->SetX(10); 
		$pdf->Cell(190,10, ' ',0,0,'L',true); 
		$pdf->SetX(10); 
		
		return !$value_zeb ; 
	}
	
			
	function desenha_vermelho($pdf, $value_red){
		
		if (!$value_red){
			$pdf->SetFillColor(255, 194, 179);
			$value_red = true ; 
		} else {
			$pdf->SetFillColor(255, 194, 179);
			$value_red = false ; 
		}
		$pdf->SetX(10); 
		$pdf->Cell(190,10, ' ',0,0,'L',true); 
		$pdf->SetX(10); 
		
		return !$value_red ; 
	}


	$zebrado = true ;
	$inativo = true ;
	// include autoloader
	require_once("plugins/fpdf/fpdf.php");

	$pdf=new FPDF();
	$pdf->addPage();
	$pdf->setFont("Arial","",9);

	$pdf->Image('imagens\logo.png' , 40,05, 28 , 32,'PNG', '');

	//$pdf->Cell(200,6, ' ',0,0,'L',true);

	$pdf->Ln(7);//espaço
	$pdf->Cell(0,10,utf8_decode("Prefeitura Municipal de Iguaba Grande"),0,1,'C');
	$pdf->Cell(0,0,utf8_decode("Movimentação de Bens Patrimoniais"),0,1,'C');
	$pdf->Ln(10);//espaço

	$pdf->Cell(0,10,utf8_decode("MOVIMENTAÇÂO PATRIMONIAL"),0,1,'C');
	//$pdf->MultiCell( 0, 40, "reportSubtitle", 1,'C');

	$pdf->Cell(100,10,"Data:".$results['results'][0]->dt_mov ,1,0);
                
	$pdf->Cell(0,10,utf8_decode("Movimentação nº:  ".$results['results'][0]->idT ),1,1);
	$pdf->Cell(0,10,utf8_decode("Remetente (local Inicial):  ".$results['results'][0]->origem),1,1);
	$pdf->Cell(0,10,utf8_decode("Destinatario (local Final):  ".$results['results'][0]->destino),1,1);

	//$pdf->Ln(8);//espaço

	$zebrado = desenha_zebrado($pdf, $zebrado ) ;//cria uma listra colorida em cima  para ter uma aparencia de background colorido
	
	$pdf->Cell(50,10,"PATRIMONIOTO",1,0,'C');
	$pdf->Cell(110,10,"DESCRICAO",1,0,'C');
	$pdf->Cell(30,10,"TBM",1,1,'C');
	$pdf->setFont("Arial","",8);

	foreach ($results['results'] as $res) {
        if($res->ativo != 0){
        
			$pdf->Cell(50,10,utf8_decode($res->patrimonio),1,0);
			$pdf->Cell(110,10,utf8_decode($res->descricao),1,0);
			$pdf->Cell(30,10,utf8_decode($res->TOMBAMENTO),1,1);
		}

		else{
			$inativo = desenha_vermelho($pdf, $inativo ) ;//cria uma listra colorida em cima  para ter uma aparencia de background colorido
			$pdf->Cell(50,10,utf8_decode($res->patrimonio),1,0);
			$pdf->Cell(110,10,utf8_decode($res->descricao),1,0);
			$pdf->Cell(30,10,utf8_decode($res->TOMBAMENTO),1,1);
			
		}
	}

	$pdf->Cell(50,10,"",1,0);
	$pdf->Cell(110,10,"",1,0);
	$pdf->Cell(30,10,"",1,1);    
     
	$pdf->setFont("Arial","",9);
	$zebrado = desenha_zebrado($pdf, $zebrado ) ;
	$pdf->MultiCell(0,5,utf8_decode("Declaro ter recebido os bens patrimoniais acima descritos , desde já , assumo inteira responsabilidade por sua guarda e conservação , usando-os de maneira adequada para não diminuir sua vida útil."),1,1,'C',1);

	//$end_final   = "Transferencia_".date('d/m/Y').".pdf";
	$end_final   = "Transferencia_".$results['results'][0]->idT;
	$tipo_pdf	=  "I"; //D é para download
	$pdf->Output($end_final, $tipo_pdf);

?>