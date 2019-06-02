<?php
    namespace requisicao;

    abstract class Requisicao {   
        
       //Funcao que ira receber o caminho da url para fazer a requiciao do webservice
        public static function request($acao , $data=null) {  
            
            $handle= curl_init();

            //Configurar array de opçoes
            $options = array(
                CURLOPT_URL=>$acao,
                CURLOPT_RETURNTRANSFER =>true,
                //autenticacao
                CURLOPT_HTTPAUTH =>true,
                CURLAUTH_BASIC=>true,
                CURLOPT_USERPWD =>TOKEN
            );

            if($data){
                $options[CURLOPT_HTTPHEADER] = array("Content-Type: application/json");
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $data;
                         
            }
                    
            curl_setopt_array($handle,$options);

            $response = curl_exec($handle);
            curl_close($handle);
            
            return $response;            
        
        }       
    }

?>