<?php
App::uses('AppController', 'Controller');

class ArchivesController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();

        // detect mobile
        if($this->request->is('mobile')){
            $this->set('is_mobile', true);
        }

    }

    public function index() {
        // all site categories linked to pages
        $query = 1;
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $query = $_REQUEST['page'];
        }
        //$response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/categories/page:{$query}.json", array('limit'=>10), $this->request_headers), true);
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "pages/categories.json", array('limit'=>10), $this->request_headers), true);
        $this->set('pages', $response['data']);
        //debug($response); exit;


    }

    public function view($slug) {
        // get pages by category $slug
        $responseSermons = json_decode($this->HTTPClient->get($this->apiUrl . "pages/category/{$slug}.json", array('limit'=>30), $this->request_headers), true);
        $this->set('sermons', $responseSermons['data']);


    }

}