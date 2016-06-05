<?php
// Класс персонажа, расширяет Player класс

class Person
{
	const SECRET = 'byJoe'; // Секретный ключик
	
	protected function __construct()
	{
		
		
	}
	
	
	// ### Создает пользователя в БД, вернет Boolean
	protected function createPlayer($login, $pass, $email)
	{
		db()->exec('INSERT INTO `player_main` (login, email, passwd) VALUES ("'.$login.'", "'.$email.'","'.$this->passwdCript($pass).'");');
		$id = db()->lastInsertId();
		if ( $id )
		{
			db()->exec('INSERT INTO `player_stats` (uid) VALUES ('.$id.');');
			db()->exec('INSERT INTO `player_info` (uid, reg_date) VALUES ('.$id.', '.time().');');
			return true;
		} else return false;
	}
	
	
	// ### Кодирование пароля \ токена, вернет string
	protected function passwdCript($str) { return md5($str.$this->SECRET); }
	protected function genToken(){ return md5('t:'.time().$this->SECRET); }
	
	
	// ### Получаем объект пользователя из БД из нескольких таблиц, возвращает Array
	protected function getBasePayer($type, $key)
	{
		$arr = Array('uid = :key', 'login = :key', 'token = :key');
		$sql = "SELECT * FROM player_main 
			LEFT JOIN  player_stats ON player_main.uid = player_stats.uid
			LEFT JOIN  player_info ON player_main.uid = player_info.uid
			WHERE player_main.".$arr[$type];
		$stmt = db()->prepare($sql);
		$stmt->bindValue(':key', $key);
		$stmt->execute();
		$user = $stmt->fetch();
		return $user;
	}
	
	
	// ### Функция пишет в БД информацию об авторизации юзера, void
	protected function authLog($id, $s)
	{
		db()->exec('INSERT INTO `player_auth_log` (uid, date, status, user_ip) VALUES ('.$id.', '.time().', '.$s.', "'.Main::filter($_SERVER['REMOTE_ADDR']).'");');
	}
}




?>