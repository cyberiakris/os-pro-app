<?php

App::uses('CakeEmail', 'Network/Email');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('login', 'logout', 'signup', 'forgot', 'resetpassword', 'verify', 'opauth_complete', 'authlogin');
    }

    public function isAuthorized($user) {
        //parent::isAuthorized($user);
        /* if (in_array($this->action, array('edit'))) {
          if ($user['id'] != $this->request->params['pass'][0]) {
          return false;
          }
          } */
        return true;
    }

    public function index() {
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "users/{$this->Auth->user('id')}.json", array(), $this->request_headers), true);
        //debug($response); exit;
        $user = $response['data']['User'];
        $this->set('user', $user);
    }

    public function login() {
        $response = null;
        if ($this->Auth->user())
        { // redirect logged in user
            $this->redirect('/users/index');
        }
        $this->layout = 'enter';
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                // set future auth params for this session
                $user = $this->Auth->user();
                $authparams = $this->request->data;
                $user['authpwd'] = $authparams['password'];
                $this->Session->write('Auth.User', $user);

                if (!$this->request->is('ajax')) {
                    $auth_redir = $this->Auth->redirect();
                    if($this->Session->read('login_referer')){
                        $auth_redir = $this->Session->read('login_referer'); // overwrite
                        $this->Session->delete('login_referer');
                    }
                    $this->redirect($auth_redir);
                } else {
                    echo json_encode(array('status' => true, 'data' => $this->Auth->redirect()));
                    exit;
                }
            } else {
                //echo '2'; debug($this->request); exit;
                //$response = array('status' => false, 'data' => 'Either your login details are incorrect or your account has not been verified. Please follow the link sent in the welcome mail to verify your account.');
                $response = array('status' => false, 'data' => isset($_SESSION['ErrorMsg']) ? $_SESSION['ErrorMsg'] : $this->Auth->authError); //$this->Auth->authError);
                unset($_SESSION["ErrorMsg"]);
                if ($this->request->is('ajax')) {
                    echo json_encode($response);
                    exit;
                }
                $this->set('error', $response);
            }
        }
        // set login_referer option2 --- option1 in AppController
        if(isset($_REQUEST['login_referer'])){
            $lasturl = $_REQUEST['login_referer'];
            if (!preg_match('/undefined|login|logout|auth/i', $lasturl)){
                $this->Session->write('login_referer', $lasturl);
            }
        }
	}

    public function logout() {
		$this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    protected function _validEmail($email){
            // check for valid email addy
            $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
            $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
            $atom = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c'.
            '\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
            $quoted_pair = '\\x5c[\\x00-\\x7f]';
            $domain_literal = "\\x5b($dtext|$quoted_pair)*\\x5d";
            $quoted_string = "\\x22($qtext|$quoted_pair)*\\x22";
            $domain_ref = $atom;
            $sub_domain = "($domain_ref|$domain_literal)";
            $word = "($atom|$quoted_string)";
            $domain = "$sub_domain(\\x2e$sub_domain)*";
            $local_part = "$word(\\x2e$word)*";
            $addr_spec = "$local_part\\x40$domain";
            return preg_match("!^$addr_spec$!", $email) ? true : false;
    }

    public function signup() {
		if ($this->Auth->user())
		{ // redirect logged in user
			$this->redirect('/users/index');
		}
        $this->layout = 'enter';
        $response = null;
        $submitted = $this->request->data;
        $param = $this->request->data;
        if ($this->request->is('post')) {
            // some validation here before sending to api
            $error = array();
            if ($this->request->data('first_name') == "") {
                $error[] = "Please provide a first name";
            }
            if ($this->request->data('last_name') == "") {
                $error[] = "Please provide a last name";
            }
            if ($this->request->data('email') == "") {
                $error[] = "Please provide an email address";
            }
            if (!$this->_validEmail($this->request->data('email'))) {
              $error[] = "Please provide a valid email address";
            }
            /*
            if ($this->request->data('phone') == "" || !is_numeric($this->request->data('phone'))) {
                $error[] = "Please provide a valid phone number";
            }
            */
            if ($this->request->data('password') == "") {
                $error[] = "Please provide a password";
            }
            if ($this->request->data('password_confirm') != $this->request->data('password')) {
                $error[] = "Sorry, the passwords provided do not match.";
            }
            if(isset($this->request->data['honeyPot'])){
                if ($this->request->data('honeyPot') != "") {
                    $error[] = "Oops. Sorry but you dont appear to be human";
                } else {
                    unset($param['honeyPot']); // remove honeypot spam checker
                }

            }
            if(isset($this->request->data['g-recaptcha-response'])){
                $captcha_params = array(
					'secret' => RECAPTCHA_SECRET,
					'response' => $this->request->data['g-recaptcha-response'],
				);
				$captcha_confirm = json_decode($this->HTTPClient->post("https://www.google.com/recaptcha/api/siteverify", $captcha_params), true);
				//debug($captcha_confirm); exit;
                if($captcha_confirm['success'] == true){
                    // remove captcha field
                    unset($param['g-recaptcha-response']);
                } else {
                    $error[] = 'Captcha Verification failed!';
                }
            }


            if (!count($error)) {

                // add referrer if it exists
                if($this->Session->read('refered_by')){
                    $refered_by = $this->Session->read('refered_by');
                    $param['refered_by'] = $refered_by;
                    $this->Session->delete('refered_by');
                }
                //debug($param); exit;
                $response = json_decode($this->HTTPClient->post($this->apiUrl . "users.json", $param, $this->request_headers), true);
            } else {
                $response = array(
                    'status' => false,
                    'data' => $error,
                );
                $this->set("submitted", $submitted); // data to repopulate some form fields
            }

            // send email if successful
            //debug($response); exit;
            if ($response['status']) {
                $pwd_hash = $response['data']['User']['pwd_hash'];
                $destination_email = $response['data']['User']['email'];
                $subject_of_email = $response['data']['User']['first_name'] . " Welcome to ".DOMAIN."!";
				$viewvars = array('username' => $destination_email, 'verifycode'=>$pwd_hash);
                $this->_send_email($destination_email, $subject_of_email, $viewvars, "newuserverify");

            } else {
                $response = array(
                    'status' => false,
                    'data' => isset($response['data']) ? $response['data'] : '',
                );
                $this->set("submitted", $submitted); // data to repopulate some form fields
			}

            if ($this->request->is('ajax') || isset($this->request->data['ajax'])) {
                echo json_encode($response);
                exit;
            }

            $this->set("info", $this->request->data);
            //debug($response); debug($this->request->data); exit;
        }
        //debug($response);exit;
        $this->set("response", $response);
    }

    public function view($id = null) {
        if ($this->request->is('post')) {
            $errors = array();
            $status = null;
            $params = $this->request->data;

            if (isset($params['edit'])) {
                if ($params['first_name'] == "") {
                    $errors[] = "Please provide your first name.";
                }

                if ($params['last_name'] == "") {
                    $errors[] = "Please provide your last name.";
                }

                if ($params['phone'] == "") {
                    $errors[] = "Please provide your phone number.";
                }

                if (!count($errors)) {
                    unset($params['edit']);
                    $params['id'] = $this->Auth->user('id');
                    $response_update = json_decode($this->HTTPClient->put($this->apiUrl . "users/{$this->Auth->user('id')}.json", $params, $this->request_headers), true);
                    //debug($response_update);exit;
                    if ($response_update['status']) {
                        $status = array(
                            'status' => true,
                            'data' => 'Your profile has been updated.'
                        );
                    } else {
                        $status = array(
                            'status' => false,
                            'data' => array("Unable to complete update.")
                        );
                    }
                    $this->Session->write('status',$status);
                    return $this->redirect('/users/view');
                }
            } else {
                if (!isset($params['oldpwd']) || empty($params['oldpwd'])) {
                    $errors[] = "Please provide your current password.";
                }
                if ( isset($params['newpwd1']) && !empty($params['newpwd1']) && isset($params['newpwd2']) && !empty($params['newpwd2']) ) {
                    if ($params['newpwd1'] != $params['newpwd2']) {
                        $errors[] = "New passwords provided do not match.";
                    }
                } else {
                    $errors[] = "Please provide new password.";
                }
                if (!count($errors)) {
                    $response = json_decode($this->HTTPClient->get($this->apiUrl . "users.json", array('email' => $this->Auth->user('email'), 'password' => $params['oldpwd']), $this->request_headers), true);
                    if ($response['status']) {
                        $response_update = json_decode($this->HTTPClient->put($this->apiUrl . "users/{$this->Auth->user('id')}.json", array('id' => $this->Auth->user('id'), 'password' => $params['newpwd1']), $this->request_headers), true);
                        if ($response_update['status']) {
                            $status = array(
                                'status' => true,
                                'data' => 'Your password has been changed.'
                            );
                        } else {
                            $status = array(
                                'status' => false,
                                'data' => array("Failed to update password. Please try again.")
                            );
                        }
                    } else {
                        $status = array(
                            'status' => false,
                            'data' => array("The password provided is not correct.")
                        );
                    }
                } else {
                    $status = array(
                        'status' => false,
                        'data' => $errors
                    );
                }
                $this->Session->write('status',$status);
                return $this->redirect('/users/view');
            }
            $this->set("status", $status);
        }
        if($this->Session->read('status')){
            $status = $this->Session->read('status');
            $this->Session->delete('status');
            $this->set('status', $status);
        }
    }

    public function forgot() {
        if ($this->Auth->user())
        { // redirect logged in user
            $this->redirect('/users/index');
        }
        $this->layout = 'enter';
        if ($this->request->is('post')) {
			$response = array();
            if ($this->request->data && $this->request->data['email']) {
                $params = array('email' => $this->request->data['email']);
				//debug($params); //exit;
                $response = json_decode($this->HTTPClient->get($this->apiUrl . "users.json", $params, $this->request_headers), true);
				//debug($response); exit;
                if($response['status'] == false){ return false; }
				$code = md5($params['email'] . time());
				$user_id = $response['data']['User']['id'];
                $param2 = array(
                    'id' => $user_id,
                    'pwd_hash' => $code,
                    'pwd_hash_expires' => date('Y-m-d g:i:s', strtotime("+1 day")),
                );
                $response_yeah = json_decode($this->HTTPClient->put($this->apiUrl . "users/{$user_id}.json", $param2, $this->request_headers), true);
				//debug($response_yeah); exit;
                if ($response_yeah['status']) {
					$data = $response_yeah['data'];
					$destination_email = $data['User']['email'];
					$subject_of_email = "Nerveflo Activity: Forgot Password Request.";
					$viewvars = array('name' => $data['User']['first_name'], 'code' => $code);
					$this->_send_email($destination_email, $subject_of_email, $viewvars, "resetpassword");
					$response = array(
                        'status' => true,
                        'data' => "Success! an email has been sent to you."
                    );
                } else {
                    $response = array(
                        'status' => false,
                        'data' => "Oh snap! some black magic occurred, our developers are cooking up a spell to counter. Stay tuned for the prestige."
                    );
                }
             } else {
                $response = array(
                    'status' => false,
                    'data' => "Please provide us your email address."
                );
            }
			if ($this->request->is('ajax')) {
				echo json_encode($response);
				exit;
			}
			$this->set('response', $response);
		}
    }

    public function resetpassword($email = null) {
        if ($this->Auth->user())
        { // redirect logged in user
            $this->redirect('/users/index');
        }
        if ($this->request->is('post')) {
            if ($this->request->data) {
                $set_params = $this->request->data;
                $params = array();
                if( isset($set_params['user_id']) && isset($set_params['set_password']) &&
                    isset($set_params['confirm_password']) && ($set_params['set_password'] == $set_params['confirm_password']) ){
                    $user_id = $set_params['user_id'];
                    $params['id'] = $set_params['user_id'];
                    $params['password'] = $set_params['set_password'];
                    $params['pwd_hash_expires'] = time();
                }
                $response = json_decode($this->HTTPClient->put($this->apiUrl . "users/{$user_id}.json", $params, $this->request_headers), true);
                //debug($params); debug($response); exit;
                if($response['status']){
                    $the_msg = 'Hello '. $response['data']['User']['first_name'] .' your password has been reset. Login to continue';
                    $the_alert = 'success';
                } else {
                    $the_msg = 'The reset process failed. Unknown account supplied.';
                    $the_alert = 'danger';
                }

                $the_flash_msg = array('msg'=>$the_msg,'alert'=>$the_alert);
                $this->Session->write('flash_msg',$the_flash_msg);
                $this->redirect('/login');

            }

        } else {
            if ($this->request->is('get') && isset($this->request->query['code']) ) {
                $param = array('pwd_hash' => $this->request->query['code']);
                $response = json_decode($this->HTTPClient->get($this->apiUrl . "users.json", $param, $this->request_headers), true);
                if ($response['status']) {
                    $expires = strtotime($response['data']['User']['pwd_hash_expires']);
                    if (time() <= $expires) {
                        $this->set('status',
							array(
								'status' => true,
								'data' => $response['data']
							)
						);
                    } else {
                        $this->set('status',
							array(
								'status'=>false,
								'data'=>"Your Password Reset Request has expired. Please try again."
							)
						);
                    }
                }
            }

        }
    }

    public function verify() {
        $response = false;
        if ($this->request->is('get')) {
            $params = $this->request->query;
            if (isset($params['code'])) {
                $param = array('hash' => $params['code']);
                $response1 = json_decode($this->HTTPClient->get($this->apiUrl . "users/lookup.json", $param, $this->request_headers), true);
                $param2 = array(
                    'id' => $response1['data']['id'],
                    'pwd_hash' => $params['code'],
                    'verified' => 1,
                    'verified_on' => date('Y-m-d g:i:s'),
                );
                $response = json_decode($this->HTTPClient->put($this->apiUrl . "users/activate/{$response1['data']['id']}.json", $param2, $this->request_headers), true);
                //debug($response); exit;
            } else {
                $response = array('status' => false);
            }
        }
        $this->set('status', $response);
    }

	public function opauth_complete() {
		if ($this->Auth->user())
		{ // redirect logged in user
			$this->redirect('/users/index');
		}
		$this->layout = 'enter';

		//debug($this->data); debug($this->request); exit;
		$data = $this->data;
		$social_params = array();
		// prep data
		if(isset($data['auth']) && $data['auth']['provider']=='Facebook'){
			$get_image = explode('?',$data['auth']['info']['image']);
			$data['auth']['image'] = $get_image[0].'?width=140&height=140';
			$validated = ($data['validated'] == true) ? 1 : 0 ;
			$social_params = array(
				'social_network_name' => $data['auth']['provider'],
				'social_network_id' => $data['auth']['uid'],
				'email' => $data['auth']['raw']['email'],
				'display_name' => $data['auth']['raw']['name'],
				'first_name' => $data['auth']['raw']['first_name'],
				'last_name' => $data['auth']['raw']['last_name'],
				'link' => $data['auth']['raw']['link'],
				'picture' => $data['auth']['info']['image'],
				'status' => $validated,
				'facebook_token' => $data['auth']['credentials']['token'],
			);

		}
		// create/update social profile
		// debug($social_params); debug($data); exit;
        if(count($social_params)>0){
			$response = json_decode($this->HTTPClient->post($this->apiUrl . "social_profiles.json", $social_params, $this->request_headers), true);
			if(isset($response['status']) && $response['status']){
				$this->set('opauth_response', $data);
			}
		}
	}

    public function authlogin() {
        $this->layout = 'enter';
		//debug($this->request->data); exit;
        if ($this->request->is('post')) {
			if ($this->Auth->login()) {
                // set future auth params for this session
                $user = $this->Auth->user();
                $authparams = $this->request->data;
                $user['viaFb'] = 1;
                $this->Session->write('Auth.User', $user);
				//$this->redirect($this->Auth->redirect());
                $auth_redir = $this->Auth->redirect();
                if($this->Session->read('login_referer')){
                    $auth_redir = $this->Session->read('login_referer'); // overwrite
                    $this->Session->delete('login_referer');
                }
                $this->redirect($auth_redir);
			} else {
				$the_msg = $this->Auth->authError;
				$the_alert = 'danger';
				$the_flash_msg = array('msg'=>$the_msg,'alert'=>$the_alert);
				$this->Session->write('flash_msg',$the_flash_msg);
			}
        }
        $this->redirect("/login");
    }

}
?>
