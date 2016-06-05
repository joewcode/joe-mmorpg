// 18.01.2016
// Методы управления чатом


var jChat = function()
{
	var ch_timeout = 1000;
	var ch_min_length = 1;
	var ch_max_length = 250;
	var ch_canal_list = [ ['ВСЕМ:','FFFFFF'],['ЛИЧНО:','FFCC99'],['КЛАН:','99FFCC'],['GM:','FA58AC'],['Админ:','2ECCFA'] ];
	var ch_color_canal = ['6970A3','C83659', '1DDA39', 'FF00BF', '0040FF'];
	var ch_canal_flag = 0;
	this.ch_block = false;
	
	
	// @@@ Public
	
	// Перехват отправки сообщения
	this.change = function()
	{
		var chstr = $('#ChatMessage').val();
		if ( chstr.length > ch_min_length && chstr.length < ch_max_length && !this.ch_block )
		{
			this.ch_block = true; // блокируем флуд
			$.post('/ajax/chat_send.php', {'message':chstr, 'canal':ch_canal_flag, 'key':user_token}, function(d){
			//	alert(d);
				chat.send( $.parseJSON(d) );
			});
			$('#ChatMessage').val(''); // Чистим строку ввода
			tOut(); // Процесс оттаивание чата
		} else $.notify({message:'Слишком часто либо текст короткий/длинный.'},{type:'danger'});
		return false;
	}
	
	// Отправка сообщения в чат лист
	this.send = function(arr)
	{
		// Дата - Кто - цвет - кому - как - сообщение
	//	arr = [ ['00:00:00', 'Joe', '220000', '', 0, 'Текст сообщения'] ];
		var chb = $('.chatBox');
		
		for ( var i in arr )
		{
			col = ch_color_canal[arr[i][4]];
			s = '<span class="chat_time" style="background-color: #'+col+';" title="'+arr[i][4]+'">'+arr[i][0]+'</span> ';
			s+= '<b style="cursor:pointer;" onClick="chat.setPrivatSrt(\''+arr[i][1]+'\');">'+arr[i][1]+'</b>';
			s+= ( arr[i][3] ) ? (' для <b>'+arr[i][3].split('|').join(', ')+'</b>') : '';
			chb.append(s+': '+arr[i][5]+'<br/>');
		//	chb.append(arr[i][0]+' <b style="cursor:pointer;" onClick="chat.setPrivatSrt(\''+arr[i][1]+'\');">'+arr[i][1]+'</b>: '+arr[i][5]+'<br/>');
		}
		// прокрутим в низ
		chb.animate({"scrollTop":chb.height()+99999},1); 
	}
	
	// Изменение канала чата
	this.chCanal = function(set)
	{
		if (set) ch_canal_flag = set;
		else ch_canal_flag = ((ch_canal_flag+1) >= ch_canal_list.length) ? 0 : ch_canal_flag+1;
		$('.chb_sett').html(ch_canal_list[ch_canal_flag][0]).css('color', '#'+ch_canal_list[ch_canal_flag][1]);
	}
	
	this.render = function()
	{
		$.post('/ajax/chat_server.php', {'key':user_token}, function(d){
			chat.send($.parseJSON(d));
		});
	}
	
	this.setPrivatSrt = function (n)
	{
		var ms = $('#ChatMessage').val();
		$('#ChatMessage').val(n+'|'+ms).focus();
	}
	
	// @@@ Private
	function tOut() { setTimeout('chat.ch_block = false;', ch_timeout); }
	
}



