<?php
namespace App\Pagos;

require_once 'Stripe/init.php';

// Las librerías que necesitamos de Stripe
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\ApiOperations\Create;
use Stripe\Charge;
use Stripe\HttpClient\CurlClient;
use Stripe\ApiRequestor;

// Las Librerías que necesitamos de Stripe
class StripeProcessor {
    var $objeto_stripe;

    // Este método se va a usar cada vez que instancie la clase
    function __construct() {
        // CURL_SSLVERSION_TLSv1 or CURL_SSLVERSION_TLSv1_2
        $curl = new CurlClient([CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2]);
        ApiRequestor::setHttpClient($curl);
        $this->objeto_stripe = new Stripe();
        $this->objeto_stripe->setVerifySslCerts(false);
        $this->objeto_stripe->setApiKey(''); // Aquí va la Llave/Clave Secreta de Stripe (Stripe Test API Secret Key)
    }

    function crear_customer($objeto) {
        $customer = new Customer();
        $datos_customer = array();
        $datos_customer['email'] = $objeto->email;
        $datos_customer['source'] = $objeto->token;
        $customerDetails = $customer->create($datos_customer);
        return $customerDetails;
    }

    function enviar_datos_pago($objeto) {
        // 1. Crear el cliente
        $customerResult = $this->crear_customer($objeto);
        
        // 2. Crear el cargo de pago
        $cargo = new Charge();
        $cardDetailsAry = array(
            'customer' => $customerResult->id,
            'amount' => $objeto->precio * 100,
            //'MXN'
            'currency' => $objeto->currency_code,
            // Nombre del arma 
            'description' => $objeto->producto,
            'metadata' => array( 
                'orden_id' => $objeto->idproducto 
            )
        );
        
        $result = $cargo->create($cardDetailsAry);
        $obj_result = $result->jsonSerialize();
        $resultado = new \StdClass();
        
        if (($obj_result['amount_refunded'] == 0)
            && (empty($obj_result['failure_code']))
            && ($obj_result['paid'])
            && ($obj_result['captured'])
            && ($obj_result['status'] == 'succeeded')
        ) {
            $resultado->status = 'OK';
            $resultado->transaccion = $obj_result;
        } else {
            $resultado->status = 'Error';
            $resultado->transaccion = null;
        }
        
        return $resultado;
    }
}
