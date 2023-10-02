<?php

/**
 * Enable RSS feeds.
 */
Router::parseExtensions('rss');

/**
 * Custom Forum routes.
 */
Router::connect('/forum', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'index'));
Router::promote();
Router::connect('/forum.rss', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'index', 'ext' => 'rss'));
Router::promote();
Router::connect('/forum/help/*', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'help'));
Router::promote();
Router::connect('/forum/rules/*', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'rules'));
Router::promote();
Router::connect('/forum/user/:id/*', array('plugin' => 'Oforum', 'controller' => 'Users', 'action' => 'profile'), array('pass' => array('id')));
Router::promote();
Router::connect('/forum/categories', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'categories'));
Router::promote();
Router::connect('/forum/c/*', array('plugin' => 'Oforum', 'controller' => 'Category', 'action' => 'index'));
Router::promote();
Router::connect('/forum/p/*', array('plugin' => 'Oforum', 'controller' => 'Post', 'action' => 'index'));
Router::promote();
Router::connect('/forum/posts', array('plugin' => 'Oforum', 'controller' => 'Posts', 'action' => 'index'));
Router::promote();
Router::connect('/forum/posts/:action', array('plugin' => 'Oforum', 'controller' => 'Posts', 'action' => 'action'));
Router::promote();
Router::connect('/forum/t/*', array('plugin' => 'Oforum', 'controller' => 'Topic', 'action' => 'index'));
Router::promote();
Router::connect('/forum/topics', array('plugin' => 'Oforum', 'controller' => 'Topics', 'action' => 'index'));
Router::promote();
Router::connect('/forum/topics/:action', array('plugin' => 'Oforum', 'controller' => 'Topics', 'action' => 'action'));
Router::promote();
Router::connect('/forum/:action', array('plugin' => 'Oforum', 'controller' => 'Oforum', 'action' => 'action'));
Router::promote();
