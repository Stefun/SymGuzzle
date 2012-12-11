<?php

namespace Client\RequestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Guzzle\Http\Exception\BadResponseException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class RequestController extends Controller
{
    /**
     * @Route("/request", name="_request")
     * @Template()
     */
    public function requestAction()
    {
		try {
   			$client = $this->get('guzzle.client');
   			

//dynamic setting depend on requirements

   			$username="ppp@ppp.com";
   			$password="625eab862ccd5b820dc83db2e1c6b20ab65d0ba1";
   			$nonce = substr(md5(uniqid('nonce_', true)),0,16);
   			$time = time();
   			$digest= base64_encode(openssl_digest( $nonce.$time.$password, 'sha512'));
   

   			$token="UsernameToken Username=\"".$username."\", PasswordDigest=\"".$password."\", Nonce=\"".$nonce."\", Created=\"".$time."\"";
   			$client->setDefaultHeaders(array('Accept'=>'application/json','x-wsse'=>$token));
   			$responses=$client->get('http://chowzter.techjini.org/api/v1/cities', null, array (
             'user_name' => 'ppp@ppp.com',  
             'password' => 'pppppp',
             'city'=>1,
        	))->send()->getBody();

//-----------------------------------------	
    		$response = new Response();
    		return $response->setContent($responses);
		} catch (Guzzle\Common\Exception\ExceptionCollection $e) {
    		echo "The following requests encountered an exception: \n";
    		foreach ($e as $exception) {
        		echo $exception->getRequest() . "\n" . $exception->getMessage() . "\n";
   			}
		}
		catch (ClientErrorResponseException $e) {
    		echo "Exception: \n";
    		$response = new Response();
    		return $response->setContent($e->getMessage());
		}
		catch (BadResponseException $e) {
			echo "Exception: \n";
   			$response = new Response();
    		return $response->setContent($e->getMessage());
		 }
		catch(\Exception $e){
			print_r($e);
		}
	}
}
