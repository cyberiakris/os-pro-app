<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

App::uses('IP2LocationCore', 'IP2Location.Model');
App::uses('HttpSocket', 'Network/Http');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		https://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $uses = array(); // no model involved for all controllers

    public $theme = THEME;

    public $Mailer;
    public $HTTPClient;
    public $apiUrl = API_URL;
    public $request_headers;
    public $loadedPlugins;
    public $ipRecord;
    public $helpers = array('Html', 'Form', 'Js', 'CustomFunctions');
    public $components = array(
        'Session',
        'RequestHandler',
        'Auth' => array(
            'authenticate' => array('ApiService'),
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'homes', 'action' => 'index'),
            'authError' => 'Access denied - Invalid Login details provided.',
            'authorize' => array('Controller')
        )
    );

    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);

        /* ** Datasource v1 **
         * rest client: httpsocket
         */
        require_once 'CustomIncludes/JsonHttpSocket.php';
        $set_app_hash = sha1(APP_KEY . APP_SECRET);
        // set api credentials in request headers
        $this->request_headers = array(
            'header' => array(
                'Content-Type' => 'application/json',
                'app'=>APP_KEY,
                'hash'=>$set_app_hash,
            ),
        );
        //$this->HTTPClient = new JsonHttpSocket(); // alt - JsonHttpSocket(array('timeout' => 240)) | default - HttpSocket()
        $this->HTTPClient = new JsonHttpSocket(array('ssl_verify_peer' => false)); // bug fix
        /* eof v1 */

        $this->loadedPlugins = CakePlugin::loaded();

    }

    public $CurrentUser;
    public $UpdatedUserInfo;
    public $UpdatedWalletInfo;
    public $Locale;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->disableCache();

        // define mapped routes
        $curtab = ($this->params['controller']) ? $this->params['controller'] : '' ;
        if(!defined("CURTAB")): define("CURTAB", $curtab); endif;
        $curpage = isset($this->params['pass'][0]) ? $this->params['pass'][0] : '' ;
        if(!defined("CURPAGE")): define("CURPAGE", $curpage); endif;
        $curtask = isset($this->params['action']) ? $this->params['action'] : '' ;
        if(!defined("CURTASK")): define("CURTASK", $curtask); endif;

        //Pass the logged in user to the view
        $user = null;
        $creator = null;

        if ($this->Auth->user()) {
            $user = $this->Auth->user();
            //debug($user); exit;
            $this->set('user', $user);
            $this->set('updated_user_info', $user);
            $this->UpdatedUserInfo = $user;

            if(isset($user['viaFb'])){
                $this->request_headers['header']['viaFb'] = 1;
                //$this->request_headers['header']['email'] = $user['email'];
                //$this->request_headers['header']['password'] = $user['facebook_token'];
                $this->HTTPClient->configAuth('Basic', $user['email'], $user['facebook_token']);
            }
            else {
                $this->HTTPClient->configAuth('Basic', $user['email'], $user['authpwd']);
            }

            // wallet info
            if(isset($user['Wallets']) && count($user['Wallets'])){
                $updated_wallet_info = $user['Wallets'][0];
                $this->set('updated_wallet_info', $updated_wallet_info);
                $this->UpdatedWalletInfo = $updated_wallet_info;
            }

        }
        $this->set('current_user', $user);
        $this->CurrentUser = $user;

        // flash msgs
        if($this->Session->read('flash_msg')){
            $flash_msg = $this->Session->read('flash_msg');
            $this->Session->delete('flash_msg');
            $this->set('flash_msg', $flash_msg);
        }

        /* DEPRECATED
        // get IP
        $IP2Location = new IP2LocationCore();
        $get_ipRecord = $IP2Location->get($this->request->clientIp());
        $this->ipRecord = array(
            'ipAddress' => $get_ipRecord->ipAddress,
            'ipNumber' => $get_ipRecord->ipNumber,
            'countryCode' => $get_ipRecord->countryCode,
            'countryName' => $get_ipRecord->countryName,
        );
        $this->set('ipRecord', $this->ipRecord);
        */
        // set locale
        $locale = false; // $get_ipRecord->countryCode;
        if($this->Session->read('locale')){
            $locale = $this->Session->read('locale');
        }
        $this->Locale = $locale;
        $this->set('locale', $locale);


        // path to webroot
        $this->set('webroot_dir', WWW_ROOT);
        $this->set('webroot_url', $this->webroot);

        // set requested url for login attempts
        $lasturl = Router::url(NULL, true); //complete url
        if (!preg_match('/login|logout|auth|.js|.css/i', $lasturl)){
            $this->Session->write('login_referer', $lasturl);
        }


    }

    var $custom_layouts = array(
        'Users'=>'member',
        'Opauth'=>'default',
        'OpauthApp'=>'default',
        'Pages'=>'default',
        'Blogs'=>'default',
        'Archives'=>'default',
        'Homes'=>'visitor'
    );

    protected function _send_email($dest=null, $subj=null, $viewVarsArray=null, $template="default", $layout="default", $sender=""){
        $sender = empty($sender) ? NOTIFY_EMAIL : $sender;
        if(MAILER_ACTIVE==1){
            $Email = new CakeEmail();
            $Email->config('default');
            $Email->template($template, $layout);
            $Email->emailFormat('both');
            // check for theme template
            $themed_tpl_path = APP . 'View' . DS . 'Themed' . DS . $this->theme . DS . 'Emails' . DS. 'text' . DS . $template.'.ctp';
            $themed_lyt_path = APP . 'View' . DS . 'Themed' . DS . $this->theme . DS . 'Layouts' . DS . 'Emails' . DS. 'text' . DS . $layout.'.ctp';
            if(
                file_exists($themed_tpl_path) && !is_dir($themed_tpl_path)
                //&& file_exists($themed_lyt_path) && !is_dir($themed_lyt_path)
            ){
                $Email->theme($this->theme);
                //var_dump('themed');
            }
            //var_dump($themed_tpl_path); var_dump($themed_lyt_path); exit; // debugger
            // oef check for theme template
            $Email->viewVars($viewVarsArray);
            $Email->to($dest);
            $Email->subject($subj);
            $Email->replyTo($sender);
            $Email->from ($sender, DOMAIN);
            $Email->send();
        }
        return false;
    }

    protected function _hasPluginEnabled($pluginName)
    {
        return in_array($pluginName, $this->loadedPlugins);
    }

    function beforeRender()
    {
        $this->set('loadedPlugins',$this->loadedPlugins);

        //debug($this->name); debug($this->theme); debug($this->layout); debug($this->plugin); exit;
        if (array_key_exists($this->name, $this->custom_layouts)){
            $this->layout = ($this->layout != 'default') ? $this->layout : $this->custom_layouts[$this->name];
        } else {
            $this->layout = '404';
        }
        // ajax
        if ($this->request->is('ajax') || isset($this->request->data['ajax'])) {
            $this->layout = 'ajax';
        }

        // old version flash msgs
        if($this->Session->read('flash_msg')){
            $flash_msg = $this->Session->read('flash_msg');
            $this->Session->delete('flash_msg');
            $this->set('flash_msg', $flash_msg);
        }

    }

}
