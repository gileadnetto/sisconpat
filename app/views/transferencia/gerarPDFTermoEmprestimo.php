<?php
$results =  (array) $this->view->resultado ; 
	require_once("plugins/fpdf/fpdf.php");
        
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

	$zebrado = true ;
	$pdf=new FPDF();
	$pdf->addPage();
	$pdf->setFont("Arial","",10);
	
	//$pdf->Cell(200,6, ' ',0,0,'L',true);
	$pdf->Image('imagens\logo.png' , 10,05, 28 , 32,'PNG', 'http://www.iguabagrande.com.br');
	$pdf->Ln(7);//espaço
	$pdf->Cell(0,10,utf8_decode("Prefeitura Municipal de Iguaba Grande"),0,1,'C');
	$pdf->Cell(0,0,utf8_decode("Movimentação de Bens Patrimoniais"),0,1,'C');
	$pdf->Ln(15);//espaço
        
	$pdf->Cell(190,10,utf8_decode("TERMO DE EMPRÉSTIMO / DEVOLUÇÃO"),1,1,'C');
	// $pdf->Ln(15);//espaço
	//$pdf->MultiCell( 0, 40, "reportSubtitle", 1,'C');
	$pdf->setFont("Arial","",8);
	$pdf->Cell(100,9,utf8_decode("Unidade Cedente : SEMEC") ,1,0);         
	$pdf->Cell(0,9,utf8_decode("Responsavel : "),1,1);
        
	$pdf->Cell(130,9,utf8_decode("Nome Requisitante: "),1,0);
	$pdf->Cell(0,9,utf8_decode("CPF / matricula :  "),1,1);
        
	$pdf->Cell(80,9,utf8_decode("Endereço/Unidade/Setor : "),1,0);
	$pdf->Cell(50,9,utf8_decode("Data Solicitação :  "),1,0);
	$pdf->Cell(60,9,utf8_decode("Data prevista devolução :  "),1,1);
        
	// $pdf->Cell(50,10,utf8_decode($res->patrimonio),1,0);
	//$pdf->Cell(110,10,utf8_decode($res->descricao),1,0);
	//$pdf->Cell(30,10,utf8_decode($res->tombamento),1,1);
        
        

//$pdf->Ln(8);//espaço

	$zebrado = desenha_zebrado($pdf, $zebrado ) ;//cria uma listra colorida em cima  para ter uma aparencia de background colorido
	$pdf->setFont("Arial","",7);
	$pdf->Cell(50,10,"PATRIMONIO",1,0,'C');
	$pdf->Cell(110,10,"DESCRICAO",1,0,'C');
	$pdf->Cell(30,10,"TOMBAMENTO",1,1,'C');
	  
	$pdf->setFont("Arial","",8);
	$pdf->Cell(50,10,"Datashow",1,0,"C");
	$pdf->Cell(110,10,"Datashow epson powerlite S27 ",1,0,"C");
	$pdf->Cell(30,10,"28276",1,1,"C");
	
	$pdf->Cell(50,10,"",1,0);
	$pdf->Cell(110,10,"",1,0);
	$pdf->Cell(30,10,"",1,1);
        
	$pdf->Ln(5);//espaço
	$pdf->Cell(0,10,utf8_decode("TERMO DE RESPONSABILIODADE"),1,1,'C',1);

	// $pdf->MultiCell( 0, 5,"  Pelo presenteTermo de Entrega e Responsabilidade , o requisitante acima qualificado declara que recebeu os bens acima especificados , assumindo o "
		//      . "compromisso  de manter a guarda pessoal sobre o mesmos , ficando a sua responsabilidade"
		//    . "     Comprometer-se a não conceder emprestimo ou confiar outrem;"
			//  . "     ", 1,1);

	$pdf->MultiCell(0, 5, utf8_decode("  Pelo presente Termo de Entrega e Responsabilidade , o requisitante acima qualificado declara que recebeu os bens acima especificados , assumindo o "
		. "compromisso  de manter a guarda pessoal sobre o mesmos , ficando a sua responsabilidade: \r\n"
		. "       - Comprometer-se a não conceder emprestimo ou confiar outrem;\r\n"
		. "       - Comunicar , imediatamente , qualquer incidente e ocorrencia com os bens sob guarda e responsabilidade;\r\n"
		. "       - Indenizar os danos causados por negligência , má utilização , guarda inadequada , desleixo, ou outro dano que possa decorrer"
			. ", direta ou indiretamente , se sua ação ou omissão."),1,'L', false);
	
		
	$pdf->Ln(5);//espaço         
            
	$pdf->Cell(45,9,"Data de retirada : ___/___/___",1,0,"L");
	$pdf->Cell(70,9,"Ass do Requisitante ________________________",1,0,"L");
	$pdf->Cell(75,9,"Ass Unidade Cedente ________________________",1,1,"L");

	$pdf->Ln(5);//espaço
	$pdf->Cell(0,8,utf8_decode("PREENCHER DEVOLUÇÃO NESSE CAMPO"),1,1,'C');
        
	$pdf->Cell(0,10,utf8_decode("TERMO DE DEVOLUÇÃO"),1,1,'C',1);
         
	$pdf->MultiCell(0,5,utf8_decode("      Pelo presente Termo de Devolução , o requisitante acima qualificado declara que devolveu os bens acima especificados ,"
	. " nas mesmas condiçoes que os recebeu ."),1);
        
	$pdf->Ln(3);//espaço
	$pdf->MultiCell(0,6,utf8_decode("Observação:_____________________________________________________________________________________"
	. "_______________________________________________________________________________________________________________________________"
	. "______________________________________________________________________________________________________________________________"),1);
        
	$pdf->Ln(2);//espaço         
            
	$pdf->Cell(45,9,utf8_decode("Data de Devolução : ___/___/___"),1,0,"C");
	$pdf->Cell(70,9,"Ass do Requisitante ________________________",1,0,"C");
	$pdf->Cell(75,9,"Ass Unidade Cedente ________________________",1,1,"C");

	$pdf->Cell(63,8,utf8_decode("1ª Via - Remetente"),1,0,'c');
	$pdf->Cell(63,8,utf8_decode("2ª Via - Destinatario"),1,0,'c');
	$pdf->Cell(64,8,utf8_decode("3ª Via - Controle Patrimonial"),1,1,'c');

	
	$end_final   = "Transferencia_";
	$tipo_pdf	=  "I"; //D é para download
	$pdf->Output($end_final, $tipo_pdf);
?>