<?php
if ( !defined('AJAX') ) exit();

### 
define('DEBUG_MODE', (bool)(strpos($_SERVER["REMOTE_ADDR"], "127.0.0.") === 0 || strpos($_SERVER["REMOTE_ADDR"], "192.168.0.") === 0));
define ('START_TIMER', microtime(true));
define ('START_MEMORY', memory_get_usage());
define('BASEPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

###
date_default_timezone_set("Europe/Moscow");
ini_set('display_errors', DEBUG_MODE);

require '../../config/sql.php';
require '../../app/main.php';
require '../../app/Modules/Person.php';
require '../../app/Modules/Player.php';


$token = isset($_POST['key']) ? Main::filter($_POST['key']) : false;
if ( $token ) $user = new Player(false, $token);

?>