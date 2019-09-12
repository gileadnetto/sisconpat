<?php
    $localidades =  $this->view->localidades;
    if($localidades['total'] == 0){
        echo"<center><h3>Nenhuma Localidade Cadastrada ou encontrada</h3> </center>";
        exit;
    }
?>

<table id="dataTableLocalidade" class="table table-striped table-bordered table-hover ">
    <thead>
        <tr>
            <th>Local</th>
            <th>Endereco</th>
            <th>Data de Cadastro</th>
            <th></th>                      
        </tr>
    </thead>
    <tbody>
        <?php
            $html = '';
            if(isset($localidades['results']) && $localidades['results']){
                foreach ( $localidades['results'] as $res) {
                    $res = (array) $res;
                    $html .= '<tr>';
                        $html .= '<td>'.$res['DESCRICAO'].'</td>';
                        $html .= '<td>'.$res['ENDERECO'].'</td>';
                        $html .= '<td>'.$res['DT_CAD'].'</td>';
                        $html .= ' <td>';
                            $html .= '<div class="btn-group" data-toggle="buttons">';
                                $html .= '<button type="button"  id="btn_deletar" class="btn btn-danger  btn_deletar" data-id_local="'.$res['ID'].'" style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-trash"></spam></button>'; //data- vai guardar i ID do usuario para usar
                                $html .= '<button type="button"  id="btn_atualizar_'.$res['ID'].'" class="btn btn-primary  btn_atualizar" data-id="'.$res['ID'].' "data-target="#modal_atualizacao"  data-toggle="modal"';
                                $html .= 'data-endereco="'.$res['ENDERECO'].'"';
                                $html .= 'data-descricao="'.$res['DESCRICAO'].'"';
                                $html .= 'style="color: white; font-size: 15px;"><spam class ="glyphicon glyphicon-pencil"></spam></button>';
                            $html .= '</div>';
                            $html .= ' <div class="clearfix"></div> ';
                        $html .= '</td>';
                    $html .= '</tr>';
                }
            }
            echo $html;
        ?>
    </tbody>
</table>
