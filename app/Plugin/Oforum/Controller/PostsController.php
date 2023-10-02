<?php
/**
 * Static content controller.
 *
 *
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Forum PostsController
 *
 * @author Chris Okorie
 */

App::uses('OforumAppController', 'Oforum.Controller');

class PostsController extends OforumAppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $query = 1;
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $query = $_REQUEST['page'];
        }
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "forum_posts/index/page:{$query}.json", array(), $this->request_headers), true);
        if(isset($response['status']) && $response['status']){
            $pagination = $response['pagination'];
            $data = $response['data'];
            $this->set('contents', $data);
            $this->set('page', $pagination);
        }

    }

    public function view($id) {
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "forum_posts/view/{$id}.json", array('id' => $id), $this->request_headers), true);
        $data = array();
        if(isset($response['status']) && $response['status']){
            $data = $response['data'];
        }
        $this->set('content', $data);

    }

    public function add(){
        if($this->request->is('post')){
            $post_params = $this->request->data;
            debug($post_params); exit;
        }
    }
}
