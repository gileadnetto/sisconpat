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
        $home = Container::getClass("Home");
        $response = $home->listar($id_usuario);

        $this->view->estatistica=$response;
        $this->render('homeEstatistica',"home");

    }
     public function relatorio_grafico() {
        session_start();
        $relatorio= Container::getClass("Home");
        $response = $relatorio->relatorio();
        $this->view->resultado=$response;

        $this->render('relatorio_grafico',"relatorio");
    }
}
