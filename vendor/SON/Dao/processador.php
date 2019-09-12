<?php
namespace processador;
	
abstract class  Processador {

	public static function action( $query , $conn){
		$retorno = array(
			'total'     => 0,
			'erro'      => false,
			'mensagem'  => false,
			'results'   => array()		
		);
		
		try {
			if (!$conn->inTransaction()) {
				$conn->beginTransaction();
			}	
			$data = $conn->query($query);  
			$data = $data->fetchAll();
			//$conn->commit();
		}
		catch(Exception $e) {
			$erro = reset($e);
			$retorno['mensagem'] = $erro;
			$retorno['erro'] = true;
			//$conn->rollback();
		}
		
		if($data){
			$retorno['total'] = count($data);
			$retorno['results']= $data;
		}
			
		return $retorno;	
	} 

	//metodo para deletar atualizar 
	public static function actionProvider( $query , $conn, $acao='Indefinido'){
		//$conn = getConnection();
		$retorno = array(
			'total'     => 0,
			'erro'      => false,
			'mensagem'  => false,
			'results'   =>array()		
		);
	
		try { 	
			if (!$conn->inTransaction()) {
				$conn->beginTransaction();
			}	    	
			$stmt = $conn->prepare($query);
			$stmt ->execute();
			$retorno ['mensagem'] = 'acão de '.$acao.' foi realizado com sucesso';
			$conn->commit();
		}
		//PDOException $e
		catch (\PDOException $e) {
		    $conn->rollback();
		    throw new \Exception($e->getMessage());
		}
		
		return $retorno;	
	}

	//metodo para realizar acoes nobanco
	//enviararray dosdados conexao e o nome da tabela 
	public static function providerAction( $data , $conn, $tabela, $acao='Indefinido' ){

		$retorno = array(
			'total'     => 0,
			'erro'      => false,
			'mensagem'  => false,
			'results'   => array()		
		);

		//montar query
		$query = 'INSERT INTO '.$tabela.'(';
		$cont = 0;
		foreach($data as $key=>$coluna){
			$cont++;
			$query .= $key ;

			if( $cont < count($data) ){
				$query .=', ';
			}
		}
		$query .=' ) VALUES( ';
		$cont = 0;
		foreach($data as $key=>$coluna){
			$cont++;

			if( $cont < count($data) ){
				$query .=':'.$key.' , ';
			}
			else{
				$query .= ':'.$key.' );';
			}
			
		}

		//executar a acao
		try {
			$stmt = $conn->prepare($query);
			$stmt->execute($data);
			$retorno['mensagem'] = $stmt;
			
		} 
		catch(\PDOException $e) {
			$retorno['erro'] = true;
			$retorno['mensagem'] = $e->getMessage();
			
		}

		return $retorno;
	}
}





