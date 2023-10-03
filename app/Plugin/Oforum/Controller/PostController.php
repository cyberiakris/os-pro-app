<?php
/**
 * Static content controller.
 *
 *
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of Forum PostController
 *
 * @author Chris Okorie
 */

App::uses('OforumAppController', 'Oforum.Controller');

class PostController extends OforumAppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index($id=null) {
        if(!isset($id) || empty($id)){
            $this->Session->setFlash('invalid post','error');
            return $this->redirect($this->referer());
        }
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "forum_posts/view/{$id}.json", array('id' => $id), $this->request_headers), true);
        $data = array();
        if(isset($response['status']) && $response['status']){
            $data = $response['data'];
        }
        $this->set('content', $data);

    }

}
