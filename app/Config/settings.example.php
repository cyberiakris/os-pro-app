<?php
/*
 * configure with constants
 */
define('WEBSITE', 'https://fixotech.ltd');
define('WEBSITE_TITLE', 'Pro Website');
define('DOMAIN', 'fixotech.ltd');
define('NOTIFY_EMAIL', 'hello@fixotech.ltd');
define('NOTIFY_REPLYTO_EMAIL', 'hello@fixotech.ltd');
define('MAILER_ACTIVE', 0); // 1 - on | 0 - off
define('NOTIFY_NAME', 'fixotech.ltd');
define('THEME', ''); // use theme - eg Fixopress

define('API_URL', 'https://omnistack.io/api/');

define('APP_KEY', ''); // client app key
define('APP_SECRET', ''); // client app secret

define('PAYSTACK_TEST_PUBLICKEY', '');
define('PAYSTACK_TEST_SECRETKEY', '');
define('PAYSTACK_LIVE_PUBLICKEY', '');
define('PAYSTACK_LIVE_SECRETKEY', '');
define('PAYSTACK_TEST_FLAG', false); // true - test | false - live

define('FLUTTERWAVE_TEST_PUBLICKEY', '');
define('FLUTTERWAVE_TEST_SECRETKEY', '');
define('FLUTTERWAVE_LIVE_PUBLICKEY', '');
define('FLUTTERWAVE_LIVE_SECRETKEY', '');
define('FLUTTERWAVE_TEST_FLAG', false); // true - test | false - live

define('RECAPTCHA_SITEKEY', '');
define('RECAPTCHA_SECRET', '');
define('FACEBOOK_APP_ID', '');
define('FACEBOOK_APP_SECRET', '');
define('GOOGLE_ANALYTICS', '');

define('WP_HOST','localhost');
define('WP_DB','wordpress'); // live -
define('WP_USER','root');
define('WP_PASS',''); // live -

/*
 * configure with object
 */
$config = array(
    'Settings' => array(
        'WEBSITE' => WEBSITE,
        'WEBSITE_TITLE' => WEBSITE_TITLE,
        'ADMIN_EMAIL' => NOTIFY_EMAIL,
        'DOMAIN' => DOMAIN,
        'GOOGLE_ANALYTICS' => GOOGLE_ANALYTICS,
    )
);
