<?php


namespace App\Controllers;

/**
 * Description of HomeCtl
 *
 * @author Gilead Netto
 */

use SON\Controller\Action;
use SON\Di\Container;

class HomeCtrl extends Action {

     public function estatisticaHome() {
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $homeDao = Container::getDao("HomeDao");
        $response = $homeDao->listar($id_usuario);

        $this->view->estatistica=$response;

        $patrimonio = Container::getDao("PatrimonioDao");
        $response = $patrimonio->ultimosCadastros(5);
        $this->view->ultimosCadastros=$response;

        $this->render('homeEstatistica',"home");

    }
     public function relatorio_grafico() {
        session_start();
        $homeDao = Container::getDao("HomeDao");
        $response = $homeDao->relatorio();
        $this->view->resultado=$response;

        $this->render('relatorio_grafico',"relatorio");
    }
}
