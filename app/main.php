<?php

class Main
{
	private $tpl_list = Array();
	
	public function tpl_set($arr)
	{
		$this->tpl_list = $arr;
	}
	
	public function tpl_view($name)
	{
		$T = $this->tpl_list;
		$F = '../resource/views/'.$this->filter($name).'.php';
		if ( is_readable($F) ) include_once $F;
		else return false;
	}
	
	
	public function filter($str, $nano = false)
	{
		if ( $nano )
		{
			if ( $nano == 1 )
			{
				$filter_list = Array("'", '"', '/','+');
				$str = preg_replace('/'.$filter_list.'/', '', $str);
				return $str;
			}
			elseif ( $nano == 2 ) return (int)$str;
		}
		$str = trim($str);
		$str = strip_tags($str); // html теги
		$str = htmlspecialchars($str); // html сущности	
		return $str;
	}
}

?>