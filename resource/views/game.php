<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<style>
	#page-preloader {position: fixed;left: 0;top: 0;right: 0;bottom: 0;background: #000;z-index: 100500;}
	#page-preloader .spinner {width: 32px;height: 32px;position: absolute;left: 50%;top: 50%;background: url('/img/spinner.gif') no-repeat 50% 50%;margin: -16px 0 0 -16px;}
	</style>
	<link href="/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/game_v1.css" rel="stylesheet">

    <title>AloneIslands - [<?php echo $T['login']; ?>]</title>

</head>
<body>
	<!-- Заставка загрузчика -->
	<div id="page-preloader"><span class="spinner"></span></div>
  <!-- Fixed navbar -->
    <div class="navbar navbar-inverse _navbar-fixed-top" role="navigation" style="z-index:2;">
		<div class="container ">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a onClick="des.go_mypers();" style="cursor:pointer;">Персонаж</a></li>
				<li><a onClick="des.go_inventar();" style="cursor:pointer;">Инвентарь</a></li>
				<li><a onClick="des.go_talants();" style="cursor:pointer;">Таланты</a></li>
				<li><a onClick="des.___();" style="cursor:pointer;">Задания</a></li>
				
				<li><a href="/?exit">Выход</a></li>
			</ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- Begin page content -->
    <div class="container" id="MainDiv">
		<?php
				// Подгружаем компоненты маин блока
			if ( 1 ) 
			{
				include_once('userwin.php');
				include_once('userinv.php');
				include_once('talants.php');
				include_once('chat.php');
			}
		?>
		
		<!-- 3D мир -->
		<canvas id="renderCanvas" class="MAP"></canvas>
		
    </div>

    <div id="footer" style="bottom:0px;">
					<table border="0" width="100%" cellspacing="0" cellpadding="0" background="/img/desing/but/bg_bc.gif" height="32"><tr>
					<td width="19"><img border="0" src="/img/desing/but/left_bc.gif" width="19" height="32" style="margin-left: -0.98em;"/></td>
					<td class="chb_sett" onClick="chat.chCanal();">ВСЕМ:</td>
					<td>
						<form method="GET" action="javascript:chat.change();"><input title="Сообщение" style="width: 100%; height: 20; background:transparent;" size="25" id="ChatMessage"></form>
					</td>
					<td width="19"><img border="0" src="/img/desing/but/lb_bc.gif" width="19" height="32"></td>
					<td width="148">
						<table border="0" width="148" cellspacing="0" cellpadding="0" background="/img/desing/but/buttons_bc.gif" height="32">
							<tr>
								<td width="31" onclick="chat.change();" style="cursor:pointer">&nbsp;</td>
								<td width="39" onclick="top.cl_chat()" style="cursor:pointer">&nbsp;</td>
								<td width="36" onclick="chat.render();" style="cursor:pointer">&nbsp;</td>
								<td width="41" onclick="top.show_smiles();" style="cursor:pointer">&nbsp;</td>
							</tr>
						</table>
					</td>
					<td width="230"><img src="/img/desing/but/10_chat.gif" title="Скорость обновления (раз в 10 секунд)"><img src="/img/desing/but/chat_all.gif" title="Показывать все сообщения"><img src="/img/desing/but/translit_off.gif" title="Транслит выключен"><img src="/img/desing/but/q.gif" title="Возможности"><img border="0" src="/img/desing/but/rb_bc.gif" width="22" height="32"></td>
					<td style="text-align: center;" width="100" id="TIME" title="Часы показывают серверное время(Россия>Москва)">00:00:00</td>
				</tr></table>
    </div>

	<script language='JavaScript' src='/js/lib/jquery-2.1.4.min.js'></script>
	<script language='JavaScript' src='/js/lib/jquery-ui.min.js'></script>
	<script language='JavaScript' src='/js/lib/bootstrap.min.js'></script>
	<script language='JavaScript' src='/js/lib/bootstrap-notify.min.js'></script>
	<script language='JavaScript' src='/js/lib/hand-1.3.7.js'></script>
	<script language='JavaScript' src='/js/lib/babylon.js'></script>
	
	<script language='JavaScript' src='/js/lib/loader.mini.js'></script>
	<script language='JavaScript' src='/js/game_v1.js'></script>
	
	<script>
	// Модули
	var user_module = [<?php echo $T['user_modules']; ?>];
	var user_token = '<?php echo $T['token']; ?>';
	var _user = {'map': 'tmap'};
	for ( var i in user_module ) getMod(user_module[i]);
	// Размеры
	$(window).on('load', function(){ var preloader = $('#page-preloader'), spinner = preloader.find('.spinner'); spinner.fadeOut(); preloader.delay(350).fadeOut('slow');});
	// Init
	_main();
	</script>
	
</body>
</html>