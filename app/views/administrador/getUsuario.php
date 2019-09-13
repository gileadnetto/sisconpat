<?php 
	$usuario = (array) $this->view->resultado;
 if($usuario['total']<=0){
      echo"<center><h3>Nenhum Usuario Cadastrado ou Encontrado</h3> </center>";
      die();
  }
 
  	$html ='';
	$html .='<table class="table table-striped table-bordered table-hover ">';

		$html .= '<thead>';
			$html .= ' <tr>';
				$html .= '<th>Login</th>';
				$html .= '<th>Senha</th>';
				$html .= '<th>Perfil</th>';
				$html .= '<th>Email</th>';
			$html .= '</tr>';
		$html .= '</thead>';

		$html .= '<tbody>';

			foreach ($usuario['results'] as $res) {
				$res= (array) $res;
									
				$html .= '<tr>';
					$html .= '<td>'.$res['login'].'</td>';
					$html .= '<td>'.$res['senha'].'</td>';
					$html .= '<td>'.$res['perfil'].'</td>';
					$html .= ' <td>'.$res['email'].'</td>';
					$html .= '<td>';
						$html .= '<div class="btn-group" data-toggle="buttons">';
							$html .= '<button type="button"  id="btn_deletar_'.$res['id'].'" class="btn btn-danger  btn_deletar" data-id="'.$res['id'].'" style="color: white; font-size: 15px;"><span class ="glyphicon glyphicon-trash"></span></button>';
							$html .= '<button type="button"  id="btn_atualizar_'.$res['id'].'" class="btn btn-primary  btn_atualizar" data-id="'.$res['id'].'"data-target="#modal_atualizacao"  data-toggle="modal"';
							$html .= 'data-login="'.$res['login'].'"  ';
							$html .= 'data-perfil="'.$res['perfil'].'"';
							$html .= 'data-email="'.$res['email'].'"';
							$html .= 'style="color: white; font-size: 15px;"><span class ="glyphicon glyphicon-pencil"></span></button>';
						$html .= '</div>';
					$html .= '</td>';                            
				$html .= ' </tr>';
			}
		$html .= '</tbody>';
	$html .= '</table>';

	echo $html;

?>