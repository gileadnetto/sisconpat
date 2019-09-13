                   
<?php
	$itens = (array) $this->view->itens;
	

	if(!isset($itens['total']) || $itens['total']<=0){
		echo"<center><h3>Nenhum Item Cadastrado ou Encontrado</h3> </center>";
		exit;
	}

	$html ='';
     
	foreach ($itens['results'] as $res) {  
		$res = (array) $res;
			    
   		$html.='<a href="javascript:void(0)" class="produto-item tabela">';
				$html.='<div class="">';
					$html.='<center><img src="imagens/produtos/'.$res['FOTO'].'" class="img-responsive" alt="Produto-IMG" width="120" ></center>';
				$html.='</div>';

				$html.='<div class="item-descricao">';
					$html  .='<h4 class="">'.$res['PATRIMONIO'].' - <small style="color:#ff6666;" >    Tombamento : '.$res['TOMBAMENTO'].'</small></h4>';
					$html  .='<p class="">'.$res['DESCRICAO'].'</p>';
					$html  .='<p class=""> Local : '.$res['LOCAL'].'';
				$html .='</div>';

				$html .='<div style="text-align: -webkit-center;">';
						$html .='<button type="button"  id="'.$res['TOMBAMENTO'].'" class="btn-edicao danger btn_deletar" data-tombamento="'.$res['TOMBAMENTO'].'"><span class ="glyphicon glyphicon-trash"></span>Remover</button>';
						$html .='<button type="button"  id="btn_atualizar_'.$res['TOMBAMENTO'].'" class="btn-edicao btn_atualizar" data-tombamento="'.$res['TOMBAMENTO'].'" data-toggle="modal"';
						$html .='data-target="#modal_atualizacao"  ';
						$html .='data-tombamento="'.$res['TOMBAMENTO'].'" ';
						$html .='data-patrimonio="'.$res['PATRIMONIO'].'" '; 
						$html .='data-descricao="'.$res['DESCRICAO'].'"';
						$html .='data-local="'.$res['ID_LOCALIDADE'].'" ';
						$html .='data-foto="'.$res['FOTO'].'" ';
						$html .='><span class="glyphicon glyphicon-pencil"></span>Editar</button>';
						$html .='</div>'; 
				$html .='</div>'; 
		$html .='</a>';
          
	}
	echo $html;	
	$html = '';
?>


            

