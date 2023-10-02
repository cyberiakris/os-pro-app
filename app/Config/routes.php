<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'homes', 'action' => 'index'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
Router::connect('/homes/*', array('controller' => 'homes', 'action' => 'index'));
Router::connect('/locale/*', array('controller' => 'homes', 'action' => 'locale'));
Router::connect('/ostheme', array('controller' => 'homes', 'action' => 'ostheme')); // deprecated
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/social_login/*', array( 'controller' => 'users', 'action' => 'social_login'));
Router::connect('/social_endpoint/*', array( 'controller' => 'users', 'action' => 'social_endpoint'));
Router::connect('/signup', array('controller' => 'users', 'action' => 'signup'));
Router::connect('/register', array('controller' => 'users', 'action' => 'signup'));
Router::connect('/forgot', array('controller' => 'users', 'action' => 'forgot'));
Router::connect('/resetpassword/*', array('controller' => 'users', 'action' => 'resetpassword'));
Router::connect('/my-account', array('controller' => 'users', 'action' => 'index'));
Router::connect('/pages/view/*', array('controller' => 'pages', 'action' => 'view'));
Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
Router::connect('/page/*', array('controller' => 'pages', 'action' => 'page'));
Router::connect('/blog', array('controller' => 'blogs', 'action' => 'index'));
Router::connect('/b/*', array('controller' => 'blogs', 'action' => 'view'));
Router::connect('/processform', array('controller' => 'pages', 'action' => 'processform'));

/* server pings */
Router::connect('/_pagetrack', array('controller' => 'pages', 'action' => 'pagetrack'));
Router::connect('/_ostheme', array('controller' => 'homes', 'action' => 'ostheme'));
//Router::connect('/_jwt', array('controller' => 'homes', 'action' => 'init_jwt'));

/**
 * Opauth callback
 */
Router::connect('/opauth-complete/*', array('controller' => 'users', 'action' => 'opauth_complete'));
Router::connect('/auth/callback', array('plugin' => 'Opauth', 'controller' => 'Opauth', 'action' => 'callback'));
Router::connect('/auth/*', array('plugin' => 'Opauth', 'controller' => 'Opauth', 'action' => 'index'));

// Generate a regex-like controller name pattern (e.g. "posts|comments|users")
$controllerList = App::objects('controller');
$controllerList = array_map(function($c) {
    return Inflector::underscore(substr($c, 0, strlen($c)-10));
}, $controllerList);
$controllerList = array_filter($controllerList, function ($c) {
    return $c !== 'app';
});
$xControllers = implode('|', $controllerList);

// define catchall
Router::connect('/:controller/:action/*', array());
Router::connect('/:controller/*', array(), array('controller' => '('.$xControllers.')') );
Router::connect('/:slug', array('controller' => 'pages', 'action' => 'page'), array('pass' => array('slug')));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
