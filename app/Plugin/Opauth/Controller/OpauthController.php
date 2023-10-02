<?php
class OpauthController extends OpauthAppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
}