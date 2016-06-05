<?php


class Player extends Person
{
	private $pers = Array();
	public $err = 'null';
	
	
	public function __construct( $uid = false, $tok = false )
	{
		parent::__construct();
		
		if ( $uid ) $this->init($uid); 
		elseif ( $tok ) $this->authToken($tok);
		elseif ( isset($_POST['auth_login']) and isset($_POST['auth_passwd']) ) $this->postAuth();
		elseif ( isset($_COOKIE['AuthKey']) ) $this->authToken();
		else $this->pers = false;
		return $this->pers;
	}
	
	// Авторизация с метода _POST // + лог входа + создание токена
	private function postAuth()
	{
		$login = (string)$_POST['auth_login'];
		$passd = $this->passwdCript($_POST['auth_passwd']);
		$user = $this->getBasePayer(1, $login);
		if ( !$user['uid'] ) { $this->err = 'nousr'; return false; }
		elseif ( $user['passwd'] != $passd )
		{
			### log попытка входа...
			$this->err = 'login';
			$this->authLog($user['uid'], 2);
			return false;
		}
		elseif ( $user['banned'] == 1) { $this->err = 'block'; return false; }
		
		// Закрепляем инфу
		$token = $this->genToken();
		$user['token'] = $token;
		$this->pers = $user;
		db()->exec('UPDATE `player_main` SET `token` = "'.$token.'", `last_action` = '.time().', `last_chat_id` = (SELECT MAX(msg_id) FROM chat), `online` = 1 WHERE `uid` = '.$user['uid'].';');
		setcookie('AuthKey', $token, time()+3600*24, '/');
		# Пишем отчет в БД
		$this->authLog($user['uid'], 1);
	}
	
	// Авторизация по UID
	private function init($id)
	{
		$user = $this->getBasePayer(0, $id);
		if ( !$user['uid'] ){ $this->err = 'login'; return false; }
		$this->pers = $user;
	}
	
	// Авторизация по Token
	private function authToken($token = false)
	{
		$tk = $token ? $token : trim($_COOKIE['AuthKey']);
		if ( empty($tk) ) { $this->err = 'login'; return false; }
		$user =  $this->getBasePayer(2, $tk);
		if ( !$user['uid'] ) { $this->err = 'login'; return false; }
		elseif ( $user['banned'] == 1) { $this->err = 'block'; return false; }
		db()->exec('UPDATE `player_main` SET `last_action` = '.time().', `online` = 1 WHERE `uid` = '.$user['uid'].';');
		$this->pers = $user;
	}
	

	
	// Получить переменную юзера
	public function get($k)
	{
		$p = $this->pers[$k] ? $this->pers[$k] : false;
		return $p;
	}
	
	public function check()
	{
		return ($this->pers['uid'] > 0) ? true : false;
	}
	
	public function check_aura($id)
	{
		
		
	}
	
	public function get_modules()
	{
		// des, consol, pers, chat, chlist
		return "'design', 'console', 'player', 'chat', 'ch_list'";
	}
	

	

	
	public function __destruct()
	{
		
	}
}



?>