                   
<?php
	$itens = (array) $this->view->itens;
	

	if(!isset($itens['total']) || $itens['total']<=0){
		echo"<center><h3>Nenhum Item Cadastrado ou Encontrado</h3> </center>";
		exit;
	}

	$html ='';
     
	foreach ($itens['results'] as $res) {  
		$res = (array) $res;
			    
   		$html.='<a href="javascript:void(0)" class="list-group-item tabela">';
        	$html.='<div class="row">';
				$html.='<div class="col-md-2">';
					$html.='<center><img src="imagens/produtos/'.$res['FOTO'].'" class="img-responsive" alt="Produto-IMG" width="120" ></center>';
				$html.='</div>';

				$html.='<div class="col-md-8">';
					$html  .='<h4 class="list-group-item-heading">'.$res['PRODUTO'].' - <small style="color:#ff6666;" >    Tombamento : '.$res['TOMBAMENTO'].'</small> <small style="float: right;">'.$res['DT_CAD'].'</small> </h4>';
					$html  .='<p class="list-group-item-text">'.$res['DESCRICAO'].'</p>';
					$html  .='<p class="list-group-item-text"> Local : '.$res['LOCAL'].'';
				$html .='</div>';

				$html .='<div class="col-md-2">';
					$html .='<div class="btn-group" data-toggle="buttons" style="float: right;">';
						$html .='<button type="button"  id="'.$res['TOMBAMENTO'].'" class="btn btn-danger btn-xs  btn_deletar" data-tombamento="'.$res['TOMBAMENTO'].'" style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-trash"></spam></button>';
						$html .='<button type="button"  id="btn_atualizar_'.$res['TOMBAMENTO'].'" class="btn btn-primary btn-xs btn_atualizar" data-tombamento="'.$res['TOMBAMENTO'].'" data-toggle="modal"';
						$html .='data-target="#modal_atualizacao"  ';
						$html .='data-tombamento="'.$res['TOMBAMENTO'].'" ';
						$html .='data-produto="'.$res['PRODUTO'].'" '; 
						$html .='data-descricao="'.$res['DESCRICAO'].'"';
						$html .='data-local="'.$res['ID_LOCALIDADE'].'" ';
						$html .='data-foto="'.$res['FOTO'].'" ';
						$html .='style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-pencil"></spam></button>';
						$html .='</div>'; 
					$html .='</div>'; 
				$html .='</div>'; 
			$html .='</div>';
		$html .='</a>';
          
	}
	echo $html;	
	$html = '';
?>


            

