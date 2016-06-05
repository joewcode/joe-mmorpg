// Глобальные переменные всего и вся
var des, consol, pers, chat, chlist;

// Функция входа
function _main()
{
	// Объявляем классы и запускаем обработку
	des = new jDesign; des.init();
	consol = new jConsole; consol.init();
	pers = new jPers;
	chat = new jChat; chat.render();
	chlist = new jChlist; chlist.render();
	
	
	// ######## Таймеры
	setInterval('chat.render();', 8000);
	setInterval('clockGame();', 1000);
	
	// ########------ Установки..-------------------------------------------------------------------------------------------------------------

	
	
	// ##### Создаем 3D пространство
	getMap( _user['map'] );
	canvas = document.getElementById("renderCanvas");
	engine = new BABYLON.Engine(canvas, true);
	var scene = createScene();
	
	engine.runRenderLoop(function(){ scene.render(); });
	window.addEventListener("resize", function(){ engine.resize(); });
	
	// End
	chat.send([ ['', 'Система', '220000', '', 0, 'Все запущено успешно.'] ]);
}
// Загрузчик
function getMod(name) { Loader.includeOnce('/js/mod/'+name+'.js'); }
function getMap(name) { Loader.includeOnce('/js/map/'+name+'.js'); }

function clockGame()
{
	var date = new Date();
	var timezone = date.getTimezoneOffset()/60 + 3;
    var hours = date.getHours() + timezone;
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    if (hours < 10) hours = '0' + hours;
    if (minutes < 10) minutes = '0' + minutes;
    if (seconds < 10) seconds = '0' + seconds;
	$('#TIME').html(hours + ':' + minutes + ':' + seconds);
}



// @####### Тест функции.. после продакшена удалить все что ниже
