var x = document.createElement('script');
x.src = '//code.jquery.com/jquery-1.11.2.min.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = '/resources/js/Ajax.js';
document.getElementsByTagName("head")[0].appendChild(x);

$(document).ready(function(){
	$('#A').click(function(e) {
        console.log(e.pageX+ ' , ' + e.pageY);
        if (selectedship != 0)
		{
			console.log(selectedship);
			$("#carrerouge").css("display", "inline");
			$('#carrerouge').css('left', e.pageX);
        	$('#carrerouge').css('top', e.pageY);
		}
		else
			$("#carrerouge").css("display", "none");
    });
    $('#move').click(function() {
        var engine = $('#moteur').val();
        var weapon = $('#arme').val();
        var bouclier = $('#bouclier').val();
		var rotation = $("#rotation").val();
		var move = $("#move").val();
		var number = $("#number").val();
        console.log(engine);
		console.log(weapon);
		console.log(bouclier);
		console.log(rotation);
		var pp = new Array(engine, weapon, bouclier);
		if (selectedshipid != 0)
		{
			AJAX_ship_move(gameId, selectedshipid, pp, rotation, number);
		}
		$('#moteur').val('');
		$('#arme').val('');
		$('#bouclier').val('');
		$("#rotation").val('');
		$('#move').val('');
		$("#number").val('');
    });
});
