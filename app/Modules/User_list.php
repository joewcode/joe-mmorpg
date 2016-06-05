<?php



class jUserlist
{
	private $user = false;
	private $onlineList = Array();
	
	public function __construct($usr)
	{
		$this->user = $usr;
		$this->onlineList = $this->getOnline();
	}
	
	// вернет массив людей онлайн
	private function getOnline()
	{
		$a = Array();
		$stmt = db()->prepare("SELECT player_main.login, player_main.clan_id, player_main.access, player_stats.level,clan_main.clan_name FROM player_main 
			LEFT OUTER JOIN player_stats ON player_main.uid = player_stats.uid 
			LEFT OUTER JOIN clan_main ON player_main.clan_id = clan_main.clan_id 
			WHERE player_main.online = 1 ORDER BY player_stats.level DESC");	
		$stmt->execute();
		while ( $arr = $stmt->fetch(PDO::FETCH_ASSOC) ) $a[] = $arr;
		return $a;
	}
	
	public function getList()
	{
		// В будущем крон...
		if ( time() % 60 ==0 )
		{
			db()->exec('UPDATE `player_main` SET `online` = 0 WHERE `last_action` < '.(time()-60*5).';');
		}
		
		
		return $this->onlineList;
		
	}
	
	public function view()
	{
		$html = '';
		foreach ( $this->onlineList as $usr)
		{
			$html.= '<p> ';
			if ( $usr['clan_id'] != 'not') $html.= '<img src="/img/desing/clan_icon/'.$usr['clan_id'].'.gif" onClick="alert(1);" style="cursor:pointer;" >';
			$html.= '<b>'.$usr['login'].'</b> ['.$usr['level'].'] <img src="/img/desing/chlist/i.gif" onClick="alert(2);" style="cursor:pointer;" ></p>';
			
		}
		
		return $html;
	}
	
	
}




?>