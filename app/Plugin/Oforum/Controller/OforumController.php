<?php
/**
 * @copyright	Copyright 2006-2013, Miles Johnson - http://milesj.me
 * @license		http://opensource.org/licenses/mit-license.php - Licensed under the MIT License
 * @link		http://milesj.me/code/cakephp/forum
 */

App::uses('OforumAppController', 'Oforum.Controller');

/**
 * @property Topic $Topic
 * @property Profile $Profile
 * @property Report $Report
 * @property Moderator $Moderator
 */
class OforumController extends OforumAppController {

	/**
	 * Models.
	 *
	 * @var array
	 */
	public $uses = array('Forum.Topic', 'Forum.Profile');

	/**
	 * Components.
	 *
	 * @var array
	 */
	public $components = array('RequestHandler');

	/**
	 * Helpers.
	 *
	 * @var array
	 */
	public $helpers = array('Rss');

	/**
	 * Forum index.
	 */
	public function index() {

        $response = json_decode($this->HTTPClient->get($this->apiUrl . "forums.json", array(), $this->request_headers), true);
        //debug($response); exit;
        if(isset($response['status']) && $response['status']){
            $this->set('forum', $response['data']);
        }

    }

    public function forums(){

    }

	/**
	 * Help.
	 */
	public function help() {
		$this->set('menuTab', 'help');
	}

	/**
	 * Jump to a specific topic and post.
	 *
	 * @param int $topic_id
	 * @param int $post_id
	 */
	public function jump($topic_id, $post_id = null) {
		$this->ForumToolbar->goToPage($topic_id, $post_id);
	}

	/**
	 * Rules.
	 */
	public function rules() {
		$this->set('menuTab', 'rules');
	}

	/**
	 * Administration home, list statistics.
	 */
	public function admin_index() {
		$this->loadModel('Forum.Report');
		$this->loadModel('Forum.Moderator');
		$this->loadModel('Forum.Profile');

		$this->set('menuTab', 'home');
		$this->set('totalPosts', 	$this->Topic->Post->getTotal());
		$this->set('totalTopics', 	$this->Topic->getTotal());
		$this->set('totalUsers', 	$this->Profile->User->find('count'));
		$this->set('totalProfiles', $this->Profile->getTotal());
		$this->set('totalPolls', 	$this->Topic->Poll->getTotal());
		$this->set('totalReports', 	$this->Report->getTotal());
		$this->set('totalMods', 	$this->Moderator->getTotal());
		$this->set('newestUser', 	$this->Profile->getNewestUser());
		$this->set('latestUsers', 	$this->Profile->getLatest());
		$this->set('latestReports', $this->Report->getLatest());
	}

	/**
	 * Before filter.
	 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->Auth->allow('index', 'feed', 'help', 'rules', 'jump', 'forums');
	}

}
