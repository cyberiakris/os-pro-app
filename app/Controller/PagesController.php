<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

    //public $uses = array('page'); // test datasource v2

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $query = 1;
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $query = $_REQUEST['page'];
        }
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/index/page:{$query}.json", array(), $this->request_headers), true);
        $params = $response['params'];
        $data = $response['data'];
        //debug($response); exit;
        $this->set('contents', $data);
        $this->set('page', $params);

    }

    public function view($id) {
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/{$id}.json", array('id' => $id), $this->request_headers), true);
        $data = $response['data'];
        //debug($data); debug($this->request); exit;

        //$response = $this->Page->read(null, $id); // https://github.com/nodesagency/CakePHP-Rest-Datasource
        //debug($response); exit;
        $this->set('content', $data);

    }

    public function page($slug) {
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/view/{$slug}.json", array('publish'=>'1'), $this->request_headers), true);

        if(isset($response['status']) && ($response['status']==true) && !empty($response['data'])) {
            $data = $response['data'];
            //debug($data); debug($this->request); exit;
            $this->set('content', $data);

            // update layout if present
            if(!empty($data['post_template'])){
                $layout_file = $data['post_template'];
                $path = APP . 'View' . DS . 'Themed' . DS . $this->theme . DS . 'Layouts';
                $layout_path = $path . DS . $layout_file;
                //$dir = new Folder('/zzz/abc', true, 0755);
                if (file_exists($layout_path) && is_file($layout_path)) {
                    $get_layout = explode('.',$layout_file);
                    $this->layout = $get_layout[0];
                }
            }
            // eof update layout

        } else  {
            $path = func_get_args();

            $count = count($path);
            if (!$count) {
                return $this->redirect('/');
            }
            $page = $subpage = $title_for_layout = null;

            if (!empty($path[0])) {
                $page = $path[0];
            }
            if (!empty($path[1])) {
                $subpage = $path[1];
            }
            if (!empty($path[$count - 1])) {
                $title_for_layout = Inflector::humanize($path[$count - 1]);
            }
            $this->set(compact('page', 'subpage', 'title_for_layout'));

            try {
                $this->render(implode('/', $path));
            } catch (MissingViewException $e) {
                if (Configure::read('debug')) {
                    throw $e;
                }
                throw new NotFoundException();
            }
        }
    }

    public function processform(){

        if($this->request->is('post')){
            $postdata = $this->request->data;

            if(!isset($postdata['_form_id']) || !is_numeric($postdata['_form_id'])){
                $the_alert = 'danger';
                $the_flash_msg = array('msg'=>'Missing Form ID','alert'=>$the_alert);
                $this->Session->write('flash_msg',$the_flash_msg);
                $this->redirect($this->referer());
            }
            $form_id = $postdata['_form_id'];
            unset($postdata['_form_id']);

            $response = json_decode($this->HTTPClient->post($this->apiUrl . "forms/submit/{$form_id}.json", $postdata, $this->request_headers), true);
            //debug($postdata); debug($response); exit;
            if(isset($response['status'])){
                $this->set('response', $response);
            }
        }
    }

    public function pagetrack(){

        $res = false;
        if($this->request->is('post')){
            $postdata = $this->request->data;

            $response1 = json_decode($this->HTTPClient->post($this->apiUrl . "activity_feeds/stats_add.json", $postdata, $this->request_headers), true);
            //debug($postdata); debug($response1); exit;
            if(isset($response1['status'])){
                $res = true;
            }
        }
        echo $res; exit;
    }

}
