<?php

//App::uses('ClassRegistry', 'Utility');
//App::uses('Sanitize', 'Utility');

/**
 * Forum critical constants.
 */
define('FORUM_PLUGIN', dirname(__DIR__) . '/');

/**
 * Current version.
 */
Configure::write('Forum.version', file_get_contents(dirname(__DIR__) . '/version.md'));


/**
 * A map of external user management URLs.
 */
Configure::write('Forum.routes', array(
	'login' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'login'),
	'logout' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'logout'),
	'signup' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'signup'),
	'forgotPass' => array('plugin' => false, 'admin' => false, 'controller' => 'users', 'action' => 'forgot_password'),
	'profile' => array('plugin' => 'forum', 'admin' => false, 'controller' => 'users', 'action' => 'profile', 'id' => '{id}')
));

/**
 * Customizable view settings. This allows for layout and template overrides.
 */
Configure::write('Forum.viewLayout', 'forum');

/**
 * List of settings that alter the forum systems.
 */
Configure::write('Forum.settings', array(
	'name' => __d('forum', 'Forum'),
	'email' => 'forum@cakephp.org',
	'url' => 'https://omnistack.io/pages/forum',
	'securityQuestion' => __d('forum', 'What framework does this plugin run on?'),
	'securityAnswer' => 'cakephp',
	'titleSeparator' => ' - ',

	// Topics
	'topicsPerPage' => 20,
	'topicsPerHour' => 3,
	'topicFloodInterval' => 300,
	'topicPagesTillTruncate' => 10,
	'topicDaysTillAutolock' => 21,

	// Posts
	'postsPerPage' => 15,
	'postsPerHour' => 15,
	'postsTillHotTopic' => 35,
	'postFloodInterval' => 60,

	// Subscriptions
	'enableTopicSubscriptions' => true,
	'enableForumSubscriptions' => true,
	'autoSubscribeSelf' => true,

	// Misc
	'whosOnlineInterval' => '-15 minutes',
	'enableQuickReply' => true,
	'enableGravatar' => true,
	'censoredWords' => array(),
	'defaultLocale' => 'eng',
	'defaultTimezone' => '-8',
));

/**
 * List of all timezones.
 */
Configure::write('Forum.timezones', array(
	'-12'	=> '(GMT -12:00) International Date Line West',
	'-11'	=> '(GMT -11:00) Midway Island',
	'-10'	=> '(GMT -10:00) Hawaii',
	'-9'	=> '(GMT -9:00) Alaska',
	'-8'	=> '(GMT -8:00) Pacific Time',
	'-7'	=> '(GMT -7:00) Mountain Time',
	'-6'	=> '(GMT -6:00) Central Time',
	'-5'	=> '(GMT -5:00) Eastern Time',
	'-4'	=> '(GMT -4:00) Atlantic Time',
	'-3'	=> '(GMT -3:00) Greenland',
	'-2'	=> '(GMT -2:00) Brazil, Mid-Atlantic',
	'-1'	=> '(GMT -1:00) Portugal',
	'0'		=> '(GMT +0:00) Greenwich Mean Time',
	'+1'	=> '(GMT +1:00) Germany, Italy, Spain',
	'+2'	=> '(GMT +2:00) Greece, Israel, Turkey, Zambia',
	'+3'	=> '(GMT +3:00) Iraq, Kenya, Russia (Moscow)',
	'+4'	=> '(GMT +4:00) Azerbaijan, Afghanistan, Russia (Izhevsk)',
	'+5'	=> '(GMT +5:00) Pakistan, Uzbekistan',
	'+5.5'	=> '(GMT +5:30) India, Sri Lanka',
	'+6'	=> '(GMT +6:00) Bangladesh, Bhutan',
	'+6.5'	=> '(GMT +6:30) Burma, Cocos',
	'+7'	=> '(GMT +7:00) Thailand, Vietnam',
	'+8'	=> '(GMT +8:00) China, Malaysia, Taiwan, Australia',
	'+9'	=> '(GMT +9:00) Japan, Korea, Indonesia',
	'+9.5'	=> '(GMT +9:30) Australia',
	'+10'	=> '(GMT +10:00) Australia, Guam, Micronesia',
	'+11'	=> '(GMT +11:00) Solomon Islands, Vanuatu',
	'+12'	=> '(GMT +12:00) New Zealand, Fiji, Nauru',
	'+13'	=> '(GMT +13:00) Tonga'
));

