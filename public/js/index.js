d = document;
s = screen;
d.title = 'Alone Islands - Вселенная в твоих руках!';
var user_cl = 0;
var pass_cl = 0;
var GLOB_ERROR = '';
var SoundsVol = 50;
var SoundsOn = 1;
var SL;
var _played=0;



function index(terror)
{
	var sw = s.width;
	if(sw<800) sw = 800;
	if(sw>1280) sw = 1280;
	if(sw!=800 && sw!=1024 && sw!=1152 && sw!=1280) sw = 1024;
	var error = 'Войти в игру:';
	if (terror=='nousr') error = 'Персонаж не существует.';
	if (terror=='login') error = 'Неверный логин или пароль.';
	if (terror=='block') error = 'Персонаж заблокирован.';
	
	var links = '<a class="boxed" href="reg.php" title="Регистрация на AloneIslands" rel="{handler:\'iframe\',size:{x:500,y:450}}" class=Main style="color: #000000">Регистрация</a> | <a class="boxed" href="forum/" title="Форум" rel="{handler:\'iframe\',size:{x:'+(sw-150)+',y:'+(s.height*0.6)+'}}" class=Main style="color: #000000">Форум</a> | <a class="boxed" href="remind.php" title="Форум" rel="{handler:\'iframe\',size:{x:'+(sw-150)+',y:200}}" class=Main style="color: #000000">Забыли пароль?</a>';

	d.write('<img border="0" src="/img/index/f.jpg" width=100% height=100%><div id=SoundLayer></div> <div style="z-index:1;position:absolute;width:100%;height:100%;top:0;left:0;background-image: url(\'/img/index/'+sw+'/m.png\'); background-position: left bottom; background-repeat: no-repeat;"></div> <div style="z-index:1;position:absolute;width:100%;height:100%;top:0;left:0;background-image: url(\'/img/index/'+sw+'/d.png\'); background-position: right bottom; background-repeat: no-repeat;"></div> <center style="z-index:3;position:absolute;width:100%;height:100%;top:0;left:0;"> <img border="0" src="/img/index/'+sw+'/logo2.png"> <div style="position:relative;top:-19%;left:-1%;"> <form action=game.php method=post name=auth><table border="0" width="20%" cellsplacing=0 cellspadding=0><tr><td class=indexFont align=center>'+error+'</td> 	</tr> 	<tr> 		<td class=indexFont align=center>Логин<br><input class=loginBox type=text name=auth_login></td> 	</tr> 	<tr> 		<td class=indexFont align=center>Пароль<br><input class=loginBox type=password name=auth_passwd></td> 	</tr> </table><input type=image src=/img/emp.gif></form> <center><img border="0" src="/img/index/'+sw+'/v.png" style="cursor:pointer;" onclick="document.auth.submit();"></center> </div> </center> <div style="z-index:4;position:absolute;width:100%;height:27px;top:90%;left:0;background-image: url(\'/img/index/r.png\'); background-position:center bottom;background-repeat:no-repeat;"> <table height=100% cellpadding=0 cellspacing=0 width=100%><tr><td valign=middle align=center>'+links+'</td></tr></table><center><i style="color:#999999">© Copyright 2006-2009, Alone Islands Ltd. Все права защищены.</i></center></div>');

//	soundManager.onload = PauseSound;
}