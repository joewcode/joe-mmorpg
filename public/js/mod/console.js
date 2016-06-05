
// Обработка нажатия клавиш, консоль


var jConsole = function()
{
	
	this.init = function()
	{
		window.captureEvents(Event.KEYPRESS);
		window.onkeydown = pressed;
		
	}
	
	function pressed(e)
	{
		switch ( e.which )
		{
			case 192: des.consol(); break; // открыть консоль
			case 66:  break; // B - Инвентарь
			case 67:  break; // C - персонаж
			
			default:  break;
		}
    }
	
}







