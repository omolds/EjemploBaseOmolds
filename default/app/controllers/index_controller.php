<?php

/**
 * Controller por defecto si no se usa el routes
 * 
 */
class IndexController extends AppController
{

    public function index($paso = 0)
    {
    	//printVar($paso); exit;
        /*aqui ya entramos con un omolds validando al usuario*/
	    $tokenUsu = obtenerToken();
	    $this->paso = $paso;
		if($tokenUsu == 'aqui token modulo omolds'){
			$this->mensaje = "Hola bienvenido a Omolds";
			$this->token = false;
		}else{
			$dataToken = json_decode(sendGetToken($tokenUsu));
			if($dataToken->idres == 0){
				$this->mensaje = "Hola <b>".$dataToken->data_usu_nivel_1->nombreUsu."</b> tu token en Omolds es correcto";
				$this->dataToken = $dataToken;

				switch ($paso) {
				    case 'token':
				        $this->token = true;
				        break;
				    case 'bootstrap':
				       	$this->mensaje = "<b>".$dataToken->data_usu_nivel_1->nombreUsu."</b> ahora aprenderemos de diseño";
				        break;
				    case 2:
				        $this->mensaje = "i es igual a 1";
				        break;
				}	
				
			}else{
				$this->mensaje = "Lo sentimos el <b>token</b> no es valido";
				$this->token = false;
			}
			
		}
		
    }



}

