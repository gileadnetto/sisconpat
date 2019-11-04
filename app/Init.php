<?php

namespace App; 
use \SON\Init\Bootstrap;

Class Init extends Bootstrap{       
    public static $instance;       
    protected function initRoutes(){
            $ar["index"] =            array(   "route" =>'/' ,             "controller" =>"index" ,           "action" =>"index");
            $ar["localidade"] =       array(   "route" =>'/localidade' ,   "controller" =>"index" ,           "action" =>"LocalidadeIndex");
            $ar["home"] =             array(   "route" =>'/home' ,         "controller" =>"index" ,           "action" =>"homeIndex");
            $ar["erro"] =             array(   "route" =>'/erro' ,         "controller" =>"index" ,           "action" =>"erro");
            $ar["patrimonio"] =       array(   "route" =>'/patrimonio' ,   "controller" =>"index" ,           "action" =>"patrimonioIndex");
            $ar["transferencia"] =    array(   "route" =>'/transferencia' ,"controller" =>"index" ,           "action" =>"transferenciaIndex");
            $ar["relatorio"] =        array(   "route" =>'/relatorio'     ,"controller" =>"index" ,           "action" =>"relatorioIndex");
            $ar["sair"] =             array(   "route" =>'/sair'           ,"controller" =>"index" ,          "action" =>"sair");
            $ar["administrador"] =    array(   "route" =>'/administrador'  ,"controller" =>"index" ,          "action" =>"administradorIndex");
            $ar["autenticar"] =       array(   "route" =>'/autenticar'  ,   "controller" =>"index" ,          "action" =>"autenticar");
			$ar["minhastransferenciasIndex"] =       array(   "route" =>'/minhas_transferencias'  ,   "controller" =>"index" ,          "action" =>"minhastransferenciasIndex");

            //rotas de Localidade
            $ar["getLocalidade"]        =array( "route" =>'/getLocalidade' ,    "controller" =>"LocalidadeCtrl" ,   "action" =>"getLocalidade");
            $ar["getAutoCompleteLocalidadeList"]        =array( "route" =>'/getAutoCompleteLocalidadeList' ,     "controller" =>"LocalidadeCtrl" ,   "action" =>"getAutoCompleteLocalidadeList");
            $ar["DeletarLocalidade"]    =array( "route" =>'/deleteLocal' ,       "controller" =>"LocalidadeCtrl" ,   "action" =>"deleteLocal");
            $ar["AdicionarLocalidade"]  =array( "route" =>'/cadastrarLocal' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"cadastrarLocal");
            $ar["OptionLocalidade"]     =array( "route" =>'/getOptionLocal' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionLocal");
            $ar["OptionTransferencia"]  =array( "route" =>'/getOptionTransferencia' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionTransferencia");
            $ar["OptionDestino"]        =array( "route" =>'/getOptionDestino' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionDestino");
			$ar["atualizarLocal"]     	=array( "route" =>'/updateLocal' ,    "controller" =>"LocalidadeCtrl" ,   "action" =>"atualizarLocal");
            
            //rotas de Patrimonio
            $ar["getPatrimonio"]             =array( "route" =>'/getPatrimonio' ,         "controller" =>"PatrimonioCtrl" ,   "action" =>"getPatrimonio");
            $ar["getAutoCompletePatrimonioList"]        =array( "route" =>'/getAutoCompletePatrimonioList' ,     "controller" =>"PatrimonioCtrl" ,   "action" =>"getAutoCompletePatrimonioList");
            $ar["cadastrarPatrimonio"]       =array( "route" =>'/cadastrarPatrimonio' , "controller" =>"PatrimonioCtrl" ,   "action" =>"cadastrarPatrimonio");
            $ar["Deletarpatrimonio"]         =array( "route" =>'/deletPatrimonio' ,     "controller" =>"PatrimonioCtrl" ,   "action" =>"deletPatrimonio");
            $ar["atualizarPatrimonio"]     =array( "route" =>'/updatePatrimonio' ,    "controller" =>"PatrimonioCtrl" ,   "action" =>"atualizarPatrimonio");
     
            
            //rotas de home
            $ar["estatisticaHome"]       =array("route" =>'/estatisticaHome' ,     "controller" =>"HomeCtrl" ,   "action" =>"estatisticaHome");
           
            //rotas transferencia
            $ar["getTransferencia"]         =array("route" =>'/getTransferencia' , "controller" =>"TransferenciaCtrl" ,   "action" =>"getTransferencia");
            $ar["getItensTransferencia"]   =array("route" =>'/getProdutoTransferencia' , "controller" =>"TransferenciaCtrl" ,   "action" =>"getItensTransferencia");
            $ar["gerarPDF"]                =array("route" =>'/gerarPDF'                , "controller" =>"TransferenciaCtrl" ,   "action" =>"gerarPDF");
            $ar["transferir"]              =array("route" =>'/transferir'  , "controller" =>"TransferenciaCtrl" ,   "action" =>"transferir");
            $ar[" gerarPDFTransferencia"]  =array("route" =>'/gerarPDFTransferencia'  , "controller" =>"TransferenciaCtrl" ,   "action" =>"gerarPDFTransferencia");
            $ar[" gerarPDFEmprestimo"]  =array("route" =>'/gerarPDFEmprestimo'  , "controller" =>"TransferenciaCtrl" ,   "action" =>"gerarPDFEmprestimo");
            
			$ar["login"] =               array("route" =>'/login' ,                "controller" =>"autenticar",         "action" =>"validar");
				
				//rota relatorio
			$ar["relatorioGrafico"]     =array("route" =>'/relatorio_grafico' ,    "controller" =>"HomeCtrl" ,   "action" =>"relatorio_grafico");
				
			//rota Administrador             
			$ar["getUsuario"]           =array("route" =>'/getUsuario' ,        "controller" =>"UsuarioCtrl" ,   "action" =>"getUsuario");
			$ar["deletUsuario"]         =array("route" =>'/deletUsuario' ,      "controller" =>"UsuarioCtrl" ,   "action" =>"deletUsuario");
			$ar["cadastrarUsuario"]     =array("route" =>'/cadastrarUsuario' ,  "controller" =>"UsuarioCtrl" ,   "action" =>"cadastrarUsuario");
			$ar["updateUsuario"]        =array("route" =>'/updateUsuario' ,     "controller" =>"UsuarioCtrl" ,   "action" =>"updateUsuario");

			$this->setRoutes($ar);   
        }
             
        
    public function getDB(){
        if (!isset(self::$instance)) {
    		try {
    			$db_nome = "root";
    			$db_senha = "";
    			self::$instance = new \PDO('mysql:host=localhost;dbname=patrimonio', $db_nome, $db_senha, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    			self::$instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION ); 
    		} catch (\PDOException $e) {
    			echo "Erro :" . $e->getMessage();
    			
    		}
        }
        return self::$instance;

    }
}
