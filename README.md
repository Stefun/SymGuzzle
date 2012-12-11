

Work in progress.............


This project is done in Symfony 2.1 framework and with the help of Guzzle framework. SymGuzzle can used as HTTP RESTful web service clients.


STEP 1 .just download the folder in your www folder.

STEP 2. Modify contain in file src/Client/RequestBundle/Controller/RequestController.php as per your requirement as follows.

Note: Modify only content between the comments

//dynamic setting depend on requirements

       		$username="abc.com";
   			$password="xyz";
   			$nonce = substr(md5(uniqid('nonce_', true)),0,16);
   			$time = time();
   			$digest= base64_encode(openssl_digest( $nonce.$time.$password, 'sha512'));
   

   			$token="UsernameToken Username=\"".$username."\", PasswordDigest=\"".$password."\", Nonce=\"".$nonce."\", Created=\"".$time."\"";
   			$client->setDefaultHeaders(array('Accept'=>'application/json','x-wsse'=>$token));
   			$responses=$client->get('http://example.api.com/, null, array ())->send()->getBody();

//-----------------------------------------


To modify this content Please refer ...


STEP 3 .Run in browser something like this http://localhost/SymGuzzle/web/app_dev.php/request.That's it!

You are Done!
