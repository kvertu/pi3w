<?php

define('db_name','bd_pi3w');
define('db_user','root');
define('db_password','');
define('db_host','127.0.0.1:3356');

if (!defined('abspath')) {
    define('abspath', dirname(__FILE__) . '/');
}
if (!defined('baseurl')) {
    define('baseurl', '/pi3w/');
}
if (!defined('dbapi')) {
    define('dbapi', abspath . 'inc/Database.php');
}

?>