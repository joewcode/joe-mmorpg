// 18.01.2016
// Лист онлайна



var jChlist = function()
{
	var update_timeout = 10 * 1000;
	var divbox = $('#chlist_list');
	var list_online = [];
	
	
	this.render = function()
	{
		this.update();
	}
	
	this.update = function()
	{
		$.post('/ajax/chlist_server.php', {'key':user_token}, function(d){
			list_online = $.parseJSON(d);
			view();
		});
	}
	
	function view()
	{
		var r = '', arr = list_online;
		for ( var i in arr )
		{
			r+= '<img src="/img/desing/chlist/p.gif" onClick="chat.setPrivatSrt(\''+arr[i]['login']+'\');chat.chCanal(1);" class="chlistAlgn" > ';
			if ( arr[i]['clan_id'] != 'not' ) r+= '<img src="/img/desing/clan_icon/'+arr[i]['clan_id']+'.gif" title="'+arr[i]['clan_name']+'" onClick="alert(1);" class="chlistAlgn" > ';
			r+= '<b class="chlistAlgn">'+arr[i]['login']+'</b> <span class="chlistAlgn">['+arr[i]['level']+'] </span>';
			r+= '<img src="/img/desing/chlist/i.gif" onClick="" class="chlistAlgn" >';
			if ( arr[i]['access'] > 0 ) r+= ' <img src="/img/desing/admin_icon/0.png" data-toggle="tooltip" title="GM" class="chlistAlgn" > ';
			r+= '<br/>';
		}
           //     r+= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Подсказка">';
         //       r+='<div class="tooltip top" role="tooltip"> <div class="tooltip-arrow"></div><div class="tooltip-inner"> Some tooltip text!</div></div>';
		
		divbox.html(r);
	}
	
	
	
}
