<?php

namespace App\Http\Controllers;

use SoapClient;

class CepController extends Controller
{
    public function consulta($cep)
    {
        // Remove o que não é número
        $cep_consulta = preg_replace("/\D/", '', $cep);

        if (!is_string($cep_consulta) || strlen($cep_consulta) != 8)
            return response()->json(['error' => 'O CEP informado é inválido'], 400);
        
        if (!class_exists('SoapClient'))
            return response()->json(['error' => 'Ops, alguma coisa de errado aconteceu! :('], 500);
        
        try {
            // Endereço do webservice dos Correios
            $wsdl = 'https://apphom.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl';
            
            // Acrescenta parâmetros para acesso SSL, uma vez que o webservice usa https
            $opts = array(
                'ssl' => array(
                    'ciphers' => 'RC4-SHA', 
                    'verify_peer' => false, 
                    'verify_peer_name' => false
                )
            );

            // Acrescenta parâmetros para o acesso ao webservice (SOAP)
            $params = array (
                'encoding' => 'UTF-8', 
                'verifypeer' => false, 
                'verifyhost' => false, 
                'trace' => 1, 
                'exceptions' => 1, 
                'connection_timeout' => 180,
                'stream_context' => stream_context_create($opts) 
            );

            // Instancia a classe de conexão SOAP
            $soap = new SoapClient($wsdl, $params);

            // Seta os dados do que serão enviados para o método
            $data = array('cep' => $cep_consulta);

            $consulta = false;

            // Chama o método passando os parâmetros
            $consulta = $soap->consultaCEP($data);
            
            if (!$consulta) 
                return response()->json(['error' => 'Falha na consulta do CEP.'], 500);

            return response()->json($consulta->return);

        } catch (\Exception $e) {

            return response()->json(['error' => $e->getMessage()], 404);

        }
    }
}
