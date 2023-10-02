<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiServiceAuthenticate
 *
 */
App::uses('BaseAuthenticate', 'Controller/Component/Auth');

class ApiServiceAuthenticate extends BaseAuthenticate {

    public function authenticate(CakeRequest $request, CakeResponse $response) {
        $res = json_decode($this->doAPIAuth($request['data']),true);
        //debug($res); exit;
		if(isset($res['status']) && $res['status']){
            return $res['data']['User'];
        }else{
            if($res['data'] == "User account needs to be activated"){
                $_SESSION["ErrorMsg"] = "Your account has not been activated. To activate your account, please follow the link sent to your email upon registration.";
            }
            return false;
        }
    }

    private function doAPIAuth($data){
        if(isset($data['g-recaptcha-response'])){ unset($data['g-recaptcha-response']); } // remove captcha field

        $client = new HttpSocket();
        $set_app_hash = sha1(APP_KEY . APP_SECRET);
        $request_headers = array(
            'header' => array(
                'Content-Type' => 'application/json',
                'app'=>APP_KEY,
                'hash'=>$set_app_hash,
            ),
        );
        if(isset($data['facebook_token'])){
            $request_headers['header']['viaFb'] = 1;
            $request_headers['header']['email'] = $data['email'];
            $request_headers['header']['password'] = $data['facebook_token'];
        } else {
            $client->configAuth('Basic', $data['email'], $data['password']);
        }
        $json_data = json_encode($data,true);
        $response = $client->post(API_URL."users/login.json", $json_data, $request_headers);
        //debug($data); debug($client->request); debug($client->response); debug(json_decode($response, true)); exit;

        return $response;
    }
    
}

?>
