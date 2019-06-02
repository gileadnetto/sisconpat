<?php

//CONFIGURAÇOES
define ('ROOT',__DIR__);//reponsavel pra mostrar o diretorio

//define('SITEBASE','http://192.168.4.3:8088/Site%20de%20venda');

//mudar aqui o local HOST
//define('LOCALHOST' , 'http://tcchost.ddns.net:8084/');
//define('LOCALHOST' , '192.168.4.3:8084/');
//define('LOCALHOST2' , '192.168.4.3:8088/');
define('LOCALHOST' , 'localhost:8084/');
define('LOCALHOST2' , 'localhost/');

//TOKEN para as requisiçoes
define('TOKEN' , 'syscompat:syscompat');
//PARA MUDAR AUTENTICAÇÂO , FAVOR IR NA PAGINA VALIDAR _ACESSO

//endereços do web Service


//LOCAL DAO
define('INSERIR_LOCAL'		, 		LOCALHOST2.'api/localidade/adicionar');
define('EXCLUIR_LOCAL'		, 		LOCALHOST2.'api/localidade/deletar?id=');
define('REGISTRO_LOCAL'		, 		LOCALHOST2.'api/localidade/registro');//quantidade de produtos na localidede
define('PAGINACAO_LOCAL'	, 		LOCALHOST2.'api/localidade/pagina?pag=');//PAGINACAO
define('LISTAR_LOCAL'	    , 		LOCALHOST2.'api/localidade/listar');//Listar
define('ATUALIZAR_LOCAL'	, 		LOCALHOST2.'api/localidade/atualizar');//Listar
//define('LISTAR_LOCAL'		, 		LOCALHOST.'Api/aplicacao/localidade/listar');//Listar

//PRODUTO DAO
define('BUSCA_PRODUTO' 			      , 		LOCALHOST2.'api/produto/buscaAll?produto=');
define('LISTAR_PRODUTO' 			  , 		LOCALHOST2.'api/produto/listar');
define('BUSCA_LOCAL_PRODUTO'            , 		LOCALHOST2.'api/produto/buscarLocal?local=');
define('BUSCA_TOMB_PRODUTO'		        , 		LOCALHOST2.'api/produto/buscarTomb?tombamento=');
define('INSERIR_PRODUTO'		        , 		LOCALHOST2.'api/produto/adicionar');
define('EXCLUIR_ATIVO_PRODUTO'          ,		LOCALHOST2.'api/produto/deletarAtivo?tombamento=');
define('ATUALIZAR_PRODUTO' 		        ,		LOCALHOST2.'api/produto/atualizar');
define('ATUALIZAR_LOC_PRODUTO'          ,		LOCALHOST2.'api/produto/atualizarLocalidade');//conferir dps ele é usado na transferencia


//TRANSFERENCIA DAO  
define('INSERIR_TRANSFERENCIA' 			,	LOCALHOST2.'api/transferencia/inserir');
define('INSERIR_ITEM_TRANSFERENCIA'		, 	LOCALHOST2.'api/transferencia/inserirTransferenciaItem');

//TRANSFERENCIA PDF
define('ITENS_ID_TRANSFERENCIA'	    		,	LOCALHOST2.'api/transferencia/buscarItensTransdoUsuario?idTransferencia=');
define('ITENS_USUARIO_TRANSFERENCIA'   		,	LOCALHOST2.'api/transferencia/buscarUsuario?id=');
define('BUSCA_ITENS_USUARIO_TRANSFERENCIA'      ,	LOCALHOST2.'api/transferencia/buscarItensTransdoUsuario?idTransferencia=');
define('LISTAR_TRANSFERENCIA'                   ,	LOCALHOST.'Api/aplicacao/transferencia/listar');

//USUARIO DAO 
//define('INSERIR_USUARIO' 	, 	LOCALHOST.'Api/aplicacao/usuario/inserir'); 
define('INSERIR_USUARIO' 	, 	LOCALHOST2.'api/usuario/adicionar'); 
define('EXCLUIR_USUARIO' 	, 	LOCALHOST2.'api/usuario/deletar?id='); 
define('LISTAR_USUARIO' 	, 	LOCALHOST2.'api/usuario/listar'); 
define('AUTENTICAR_USUARIO' , 	LOCALHOST2.'api/usuario/autenticar?');
define('ATUALIZAR_USUARIO' 	, 	LOCALHOST2.'api/usuario/atualizar'); 


//RELATORIO

define('LISTAR_RELATORIO' 	, 	LOCALHOST2.'api/relatorio/listar'); 
