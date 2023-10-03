<?php
/**
 * Static content controller.
 *
 *
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 *
 * Description of BlogController
 *
 * @author Chris Okorie
 */

class BlogsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        $query = 1;
        $querystring = array();
        if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
            $query = $_REQUEST['page'];
        }

        // add category
        if(isset($_REQUEST['category'])){
            $querystring['category'] = $_REQUEST['category'];
            $this->set('category', $querystring['category']);
        }
        else if(
            isset($this->params['pass'][0]) && ($this->params['pass'][0]=='category') &&
            isset($this->params['pass'][1]) && !empty($this->params['pass'][1])
        ){
            $querystring['category'] = $this->params['pass'][1];
            $this->set('category', $querystring['category']);
        }

        $response = json_decode($this->HTTPClient->get($this->apiUrl . "blogs/index/page:{$query}.json", $querystring, $this->request_headers), true);
        if(isset($response['status']) && $response['status']){
            $pagination = $response['pagination'];
            $data = $response['data'];
            $this->set('contents', $data);
            $this->set('page', $pagination);
        }

    }

    public function view($id) {
        $response = json_decode($this->HTTPClient->get($this->apiUrl . "blogs/view/{$id}.json", array('id' => $id), $this->request_headers), true);
        $data = array();
        if(isset($response['status']) && $response['status']){
            $data = $response['data'];
        }
        $this->set('content', $data);

    }

}
