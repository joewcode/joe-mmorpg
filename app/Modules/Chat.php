<?php



class Chat
{
	private $user = false;
	private $addres = Array();
	private $ch_text = null;
	private $ch_canal = null;
	
	private $MIN_LENGHT = 2;
	private $MAX_LENGHT = 250;
	
	private $canal_list = Array(0, 1, 2, 3, 4);
	
	
	public function __construct($usr)
	{
		$this->user = $usr;
	}
	
	public function init_send()
	{
		$this->addres 	= explode('|', Main::filter($_POST['message']) );
		$this->ch_text	=  array_pop($this->addres) ;
		$this->ch_canal	= (int)$_POST['canal'];
		// Проверяем что получили
		if ( !$this->check_valid() ) return '3';
		$this->canal_check(); // Префильтр канала
		### Работаем
		
		$clan_id = ($this->ch_canal == 2) ? $this->user->get('clan_id') : '';
		
		db()->exec('INSERT INTO `chat` (`msg_date`, `msg_author`, `msg_color`, `msg_address`, `msg_canal`, `msg_clan_id`, `msg_text`) 
			VALUES ('.time().', "'.$this->user->get('login').'", "000000", "'.implode('|', $this->addres).'", '.$this->ch_canal.', "'.$clan_id.'", "'.$this->ch_text.'");');
		
	}
	
	// Проверка на валидность
	private function check_valid()
	{
		return ( (strlen($this->ch_text) >= $this->MIN_LENGHT and strlen($this->ch_text) <= $this->MAX_LENGHT) and ($this->ch_canal >= 0 and $this->ch_canal <= count($this->canal_list) ) and count($this->addres) < 10 ) ? true : false;
	}
	
	// Определяем на какой все же канал отправить сообщение
	private function canal_check()
	{
		switch ( $this->ch_canal )
		{
			case 0: break;
			case 1: $this->ch_canal = count($this->addres) ? 1 : 0; break; // Приватный чат
			case 2: $this->ch_canal = ($this->user->get('clan_id') != 'not' ) ? 2 : 0; break; // Клан чат
			case 3: break; // Чат помощи
			case 4: $this->ch_canal = ($this->user->get('access') > 0) ? 4 : 0; break; // Чат админов
			default: $this->ch_canal = 0; break;
		}
		
	}
	
	public function view_mess()
	{
		$lid = $this->user->get('last_chat_id');
		$stmt = db()->prepare("SELECT * FROM `chat` WHERE `msg_id` > :id");
		$stmt->bindValue(':id', $lid, PDO::PARAM_INT);
		$stmt->execute();
	//	$ch_list = $stmt->fetch();
		$ch_array = Array();
		while ( $arr = $stmt->fetch(PDO::FETCH_ASSOC) )
		{// ['00:00:00', 'Joe', '220000', '', 0, 'Текст сообщения']
			$lid = $arr['msg_id'];
			// Сообщение в приват, но юзер к сообщению не относится
			if ( $arr['msg_canal'] == 1 and ( $this->user->get('login') != $arr['msg_author'] and !preg_match('/'.$this->user->get('login').'/i', $arr['msg_address']) ) ) continue;
			// Если сообщение пишется в клан чат, но клан не наш
			if (  $arr['msg_canal'] == 2 and $this->user->get('clan_id') != $arr['msg_clan_id'] ) continue;
			// Если сообщение в чат помощи
			if (  $arr['msg_canal'] == 3 and ($this->user->get('login') != $arr['msg_author'] and $this->user->get('access')==0 ) ) continue;
			// Если сообщение в чат помощи
			if (  $arr['msg_canal'] == 4 and $this->user->get('access') == 0 ) continue;
		
			### Вносим в лист
			$ch_array[] = Array(date('H:i:s', $arr['msg_date']), $arr['msg_author'], $arr['msg_color'], $arr['msg_address'], $arr['msg_canal'], $arr['msg_text']);
		}
		// Обновляем показатель сообщений
		db()->exec('UPDATE `player_main` SET `last_action` = '.time().', `last_chat_id` = '.$lid.', `online` = 1 WHERE `uid` = '.$this->user->get('uid').';');
		echo json_encode($ch_array);
	}
	
	
	
}






?>