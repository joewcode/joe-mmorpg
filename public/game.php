<?php
### Init file is game

### 
define('DEBUG_MODE', (bool)(strpos($_SERVER["REMOTE_ADDR"], "127.0.0.") === 0 || strpos($_SERVER["REMOTE_ADDR"], "192.168.0.") === 0));
define ('START_TIMER', microtime(true));
define ('START_MEMORY', memory_get_usage());
define('BASEPATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

###
date_default_timezone_set("Europe/Moscow");
ini_set('display_errors', DEBUG_MODE);

require '../config/sql.php';
require '../app/main.php';
require '../app/Modules/Person.php';
require '../app/Modules/Player.php';

$user = new Player();
if ( !$user or !$user->check() )
{
	header('Location: /?error='.$user->err);
	exit;
}

$app = new Main;

// $user->createPlayer('Test9', '123456', 'test9@joe.jo');


$T = Array(
		'login' => $user->get('login'),
		'level' => $user->get('level'),
		'HP' => $user->get('hp'),
		'MP' => $user->get('mp'),
		'AHP' => $user->get('ahp'),
		'AMP' => $user->get('amp'),
		'SOUL' => $user->get('soul'),
		'user_modules' =>$user->get_modules(),
		'token' => $user->get('token')
	);
$app->tpl_set($T);
$app->tpl_view('game');
?>