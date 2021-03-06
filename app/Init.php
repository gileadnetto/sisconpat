<?php

namespace App; 
use \SON\Init\Bootstrap;

Class Init extends Bootstrap{       
    protected function initRoutes(){
		$ar["index"] =            array(   "route" =>'/' ,             "controller" =>"index" ,           "action" =>"index");
		$ar["localidade"] =       array(   "route" =>'/localidade' ,   "controller" =>"index" ,           "action" =>"LocalidadeIndex");
		$ar["home"] =             array(   "route" =>'/home' ,         "controller" =>"index" ,           "action" =>"homeIndex");
		$ar["erro"] =             array(   "route" =>'/erro' ,         "controller" =>"index" ,           "action" =>"erro");
		$ar["itens"] =            array(   "route" =>'/item' ,         "controller" =>"index" ,           "action" =>"itemIndex");
		$ar["transferencia"] =    array(   "route" =>'/transferencia' ,"controller" =>"index" ,           "action" =>"transferenciaIndex");
		$ar["relatorio"] =        array(   "route" =>'/relatorio'     ,"controller" =>"index" ,           "action" =>"relatorioIndex");
		$ar["sair"] =             array(   "route" =>'/sair'           ,"controller" =>"index" ,          "action" =>"sair");
		$ar["administrador"] =    array(   "route" =>'/administrador'  ,"controller" =>"index" ,          "action" =>"administradorIndex");
		$ar["autenticar"] =       array(   "route" =>'/autenticar'  ,   "controller" =>"index" ,          "action" =>"autenticar");
		$ar["minhastransferenciasIndex"] =       array(   "route" =>'/minhas_transferencias'  ,   "controller" =>"index" ,          "action" =>"minhastransferenciasIndex");

		//rotas de Localidade
		$ar["getLocalidade"]        =array( "route" =>'/getLocalidade' ,    "controller" =>"LocalidadeCtrl" ,   "action" =>"getLocalidade");
		$ar["DeletarLocalidade"]    =array( "route" =>'/deletLocal' ,       "controller" =>"LocalidadeCtrl" ,   "action" =>"deletLocal");
		$ar["AdicionarLocalidade"]  =array( "route" =>'/cadastrarLocal' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"cadastrarLocal");
		$ar["OptionLocalidade"]     =array( "route" =>'/getOptionLocal' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionLocal");
		$ar["OptionTransferencia"]  =array( "route" =>'/getOptionTransferencia' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionTransferencia");
		$ar["OptionDestino"]        =array( "route" =>'/getOptionDestino' ,   "controller" =>"LocalidadeCtrl" ,   "action" =>"getOptionDestino");
		$ar["atualizarLocal"]     	=array( "route" =>'/updateLocal' ,    "controller" =>"LocalidadeCtrl" ,   "action" =>"atualizarLocal");
		
		//rotas de Itens
		$ar["getitens"]             =array( "route" =>'/getItens' ,         "controller" =>"ItensCtrl" ,   "action" =>"getItens");
		$ar["Buscaritens"]          =array( "route" =>'/buscaProduto' ,     "controller" =>"ItensCtrl" ,   "action" =>"buscar");
		$ar["Cadastraritens"]       =array( "route" =>'/cadastrarProduto' , "controller" =>"ItensCtrl" ,   "action" =>"cadastrar");
		$ar["Deletaritens"]         =array( "route" =>'/deletProduto' ,     "controller" =>"ItensCtrl" ,   "action" =>"deletProduto");
		$ar["atualizarProduto"]     =array( "route" =>'/updateProduto' ,    "controller" =>"ItensCtrl" ,   "action" =>"atualizarProduto");
	
		//rotas de home
		$ar["estatisticaHome"]       =array("route" =>'/estatisticaHome' ,     "controller" =>"HomeCtrl" ,   "action" =>"estatisticaHome");
		
		//rotas transferencia
		$ar["getItensTransferencia"]   =array("route" =>'/getProdutoTransferencia' , "controller" =>"TransferenciaCtrl" ,   "action" =>"getItensTransferencia");
		$ar["getMinhasTransferencias"] =array("route" =>'/getMinhasTransferencias' , "controller" =>"TransferenciaCtrl" ,   "action" =>"getMinhasTransferencias");
		$ar["gerarPDF"]                =array("route" =>'/gerarPDF'                , "controller" =>"TransferenciaCtrl" ,   "action" =>"gerarPDF");
		$ar["transferir"]              =array("route" =>'/cadastrarTransferencia'  , "controller" =>"TransferenciaCtrl" ,   "action" =>"transferir");
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
		try {
			$db_nome = "root";
			$db_senha = "";
			$db = new \PDO('mysql:host=localhost;dbname=patrimonio', $db_nome, $db_senha, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION ); 
			
			return $db;
			
		} catch (PDOException $e) {
			echo "Erro :" . $e->getMessage();
		}
    }
}
