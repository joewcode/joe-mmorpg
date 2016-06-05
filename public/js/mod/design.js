
// Управление дизайном

var jDesign = function()
{
	this.init = function()
	{
		
		// Скрываем болоки
		this.hide('mypers');
		this.hide('myinventar');
		this.hide('mytalant');
		
		
		// Записываем перемещение
		$('#mypers').draggable({snap:'#MainDiv', containment:'window'});
		$('#myinventar').draggable({snap:'#MainDiv', containment:'window'});
		$('#mytalant').draggable({snap:'#MainDiv', containment:'window'});
		
		$('.chatBox').draggable({snap:'#MainDiv', containment:'window'});
		$('.chlistBox').draggable({snap:'#MainDiv', containment:'window'});

                // инициализировать все элементы на страницы, имеющих атрибут data-toggle="tooltip", как компоненты tooltip
                // $('[data-toggle="tooltip"]').tooltip();
		// Tooltip enable
            //    $('[data-toggle="tooltip"]').tooltip();
                 
                $("[data-toggle='tooltip']").tooltip(); 
                
		// Устанавливаем размеры элементов
		
	}
	
	// скрыть/закрыть, типо toogle
	this.hide = function(id) { $('#'+id).toggle();  }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	// #################### КНОПКИ ####################################
	this.go_mypers = function() { this.hide('mypers'); }
	this.go_inventar = function() { this.hide('myinventar'); }
	this.go_talants = function() { this.hide('mytalant'); }
	
	this.consol = function() { this.hide('myinventar'); }
	
	
}





