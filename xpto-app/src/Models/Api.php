<?php

namespace App\Models;

Class Api {

    public function envia($url, $type){
        $array = array();
          
            $ch = curl_init($url);                                                            
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);                                                                     
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        
        $array = curl_exec($ch);
        
        curl_close($ch);

        return $array;
    }
 
public function update($data, $url){
    $array = array();
        
        $ch = curl_init($url);                                                            
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");                                                                     
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));                                                                    
    
    $array = curl_exec($ch);

    curl_close($ch);

    return $array;
}
/**
 * Função para cadastro de usuários
 *
 * @param array $dados
 * @param string $token
 * @param string $url
 * @return string
 */
    public function send($dados, $url) {
        $array = array();

        $ch = curl_init();                                                            
        
            curl_setopt($ch, CURLOPT_URL, $url);                                                                      
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data')                                                                       
            );

        $array = curl_exec($ch);

        curl_close($ch);

        return $array;

    }
}
