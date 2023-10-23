<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('JWT', 'Lib');

/**
 * Description of HomesController
 *
 * 
 */
class HomesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();

        // detect mobile
        if($this->request->is('mobile')){
            $this->set('is_mobile', true);
        }

        /*
        if(!in_array($this->action, array('index','locale','init_jwt'))){
            if(!isset($_SERVER['HTTP_JWT'])){
                $err = json_encode(array('error'=>'token not found'));
                print_r($err); exit;
            }
            $key = sha1(APP_KEY . APP_SECRET);
            $jwt = $_SERVER['HTTP_JWT'];
            $decoded = JWT::decode($jwt, $key, array('HS256'));

            if(!isset($decoded->name) || ($decoded->name !== $this->action)){
                $err = json_encode(array('error'=>'token does not match'));
                print_r($err); exit;
            }
            //debug($decoded->name); debug($decoded); exit;
        }
        */
    }

    public function index() {

        // homepage posts
        $response0 = json_decode($this->HTTPClient->get($this->apiUrl . "posts/index.json", array('special'=>1), $this->request_headers), true);
        //debug($response0); exit;
        if(isset($response0['status']) && ($response0['status'])){
            $data = $response0['data'];

            $specials = [];
            //usort($data, 'date_compare');
            //debug($data); exit;
            if(count($data)){
                foreach($data as $d){
                    $tagline = $d['tagline'];
                    $specials[ $tagline ] = $d;
                }
            }
            $this->set('specials', $specials);
            //$this->set('page', $params);
        }

        /*
        $query = 1;
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $query = $_REQUEST['page'];
        }
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/index/page:{$query}.json", array('limit'=>4), $this->request_headers), true);
        //debug($response); exit;
        if(isset($response['status']) && ($response['status'])){
            $data = $response['data'];
            $this->set('contents', $data);
        }
        */
        
        // sliders
        $get_homepage_slider = json_decode($this->HTTPClient->get($this->apiUrl . "sliders.json", array('content_type'=>'default','limit'=>5), $this->request_headers), true);
        //debug($get_homepage_slider); exit;
        if(isset($get_homepage_slider['status']) && $get_homepage_slider['status'] == 'true'){
            $this->set('sliders',$get_homepage_slider['data']);
        }

    }

    public function locale($name=null) {
        $req = $this->request->query;
        $locale = ($req['countrycode']) ? $req['countrycode'] : 'US';
        $set_locale = ($name) ? $name : $locale;

        if($set_locale){
            $this->Session->write('locale',$set_locale);
        }

        $this->redirect($this->referer());
    }

    public function ostheme(){
        $path = APP . 'View' . DS . 'Themed' . DS . $this->theme . DS . 'Layouts';
        $files = array();
        //$dir = new Folder('/zzz/abc', true, 0755);
        if (file_exists($path) && is_dir($path)) {
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if (($file == '.') || ($file == '..')) continue;
                    $filename = pathinfo($file, PATHINFO_FILENAME );
                    $files[] = array('optionValue'=>$file,'optionName'=>$filename);
                }
                closedir($dh);
            }
        }
        //debug($path); debug($files); exit;
        $this->autoRender = false;
        return json_encode($files);
    }

    public function init_jwt(){
        // base64 encodes the header json
        $encoded_header = base64_encode('{"alg": "HS256","typ": "JWT"}');

        // base64 encodes the payload json
        $encoded_payload = base64_encode('{"country": "us","name": "ostheme","domain": "'.DOMAIN.'"}');

        // base64 strings are concatenated to one that looks like this
        $header_payload = $encoded_header . '.' . $encoded_payload;

        //Setting the secret key
        $secret_key = sha1(APP_KEY . APP_SECRET);

        // Creating the signature, a hash with the s256 algorithm and the secret key. The signature is also base64 encoded.
        $signature = base64_encode(hash_hmac('sha256', $header_payload, $secret_key, true));

        // Creating the JWT token by concatenating the signature with the header and payload, that looks like this:
        $jwt_token = $header_payload . '.' . $signature;

        //listing the resulted  JWT
        echo $jwt_token;
        exit;
    }
}

?>
