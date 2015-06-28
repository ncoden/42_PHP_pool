var x = document.createElement('script');
x.src = '//code.jquery.com/jquery-1.11.2.min.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = '/resource/js/Events.js';
document.getElementsByTagName("head")[0].appendChild(x);

function AJAX_game_create(name)
{
		/*
<- gameId
<- shipModels (not to be used on the client side)
<- elements
<- weaponModels (not to be used on the client side) 
	This is not a ajax call, just a url
	*/
	 
}

function AJAX_game_id(gameid)
{

	var returnstring = 
"{\"players\":[{\"id\":0,\"name\":\"Brian\"},{\"id\":1,\"name\":\"Bastien\"}],\"shipModels\":[{\"id\":1,\"name\":\"assault\/space_marine\",\"width\":3,\"height\":1,\"sprite\":\"a\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5},{\"id\":2,\"name\":\"chaplain\/sorcerer\",\"width\":3,\"height\":1,\"sprite\":\"b\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5},{\"id\":3,\"name\":\"d\/raptor\",\"width\":3,\"height\":1,\"sprite\":\"c\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5},{\"id\":4,\"name\":\"force_commander\/aspiring\",\"width\":3,\"height\":1,\"sprite\":\"d\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5},{\"id\":5,\"name\":\"greyknights\/tanks\",\"width\":3,\"height\":1,\"sprite\":\"e\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5},{\"id\":6,\"name\":\"t\/chaos_lord\",\"width\":3,\"height\":1,\"sprite\":\"f\",\"defaultPP\":5,\"defaultHull\":10,\"defaultShield\":5,\"inerty\":2,\"speed\":5}],\"ships\":[{\"id\":1,\"model\":1,\"player\":1,\"posX\":134,\"posY\":62,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":2,\"model\":2,\"player\":1,\"posX\":134,\"posY\":71,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":3,\"model\":3,\"player\":1,\"posX\":134,\"posY\":85,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":4,\"model\":4,\"player\":1,\"posX\":135,\"posY\":92,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":5,\"model\":5,\"player\":1,\"posX\":116,\"posY\":82,\"width\":2,\"height\":6,\"active\":1,\"state\":1,\"weapons\":[70,71]},{\"id\":6,\"model\":6,\"player\":1,\"posX\":116,\"posY\":72,\"width\":2,\"height\":6,\"active\":1,\"state\":1,\"weapons\":[70,71]},{\"id\":1,\"model\":1,\"player\":0,\"posX\":1,\"posY\":1,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":2,\"model\":2,\"player\":0,\"posX\":23,\"posY\":1,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":3,\"model\":3,\"player\":0,\"posX\":42,\"posY\":1,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":4,\"model\":4,\"player\":0,\"posX\":1,\"posY\":13,\"active\":1,\"state\":1,\"weapons\":[54,56,60,64]},{\"id\":5,\"model\":5,\"player\":0,\"posX\":23,\"posY\":13,\"width\":2,\"height\":6,\"active\":1,\"state\":1,\"weapons\":[70,71]},{\"id\":6,\"model\":6,\"player\":0,\"posX\":1,\"posY\":22,\"width\":2,\"height\":6,\"active\":1,\"state\":1,\"weapons\":[70,71]}],\"elements\":[{\"type\":\"asteroid\",\"posX\":700,\"posY\":25,\"width\":10,\"height\":10},{\"type\":\"asteroid\",\"posX\":800,\"posY\":500,\"width\":10,\"height\":10},{\"type\":\"asteroid\",\"posX\":500,\"posY\":900,\"width\":10,\"height\":10}],\"weaponModels\":[{\"id\":100,\"name\":\"weapon1\",\"shortRange\":10,\"MediumRange\":20,\"LongRange\":30,\"dispersion\":0,\"width\":1},{\"id\":100,\"name\":\"weapon2\",\"shortRange\":10,\"MediumRange\":20,\"LongRange\":30,\"dispersion\":0,\"width\":1}]}";
	console.log("AJAX_game_id " +  gameid);
	var datas= {
		"gameId": gameid
	};
	$.ajax(
	{
		url : '/api/game/load',
		type: 'POST',
		error: function(response)
		{
			PROCESS_game_id(returnstring);
		},
		data : datas,
		success: function(response) 
		{
		   	PROCESS_game_id(returnstring);
		}
	}
);
//ajax call will be asynchronous.... so i must stock and store an event for ajax calls 
	/*
<- players
 <- shipModels
 <- ships ?
 <- elements
 <- weaponModels
 <- weapons ?
	*/

}

function debug(response)
{
	console.log(response);
}

function AJAX_game_refresh()
{
	var datas = {
		'gameId': gameId
	};

	$.ajax({
		url : '/api/game/refresh',
		type: 'POST',
		data : datas,
		error: function(response) {
			console.log("FAILURE " + gameid);
		},
		success: function(response) {
			debug(response);}
	});
}

function AJAX_ship_move(gameid, shipid, pp, rotation, movement)
{
	var datas = {
		'gameId' : gameid,
		'shipId' : shipid,
		'pp' : pp,
		'rotation' : rotation,
		'movement' : movement
	};

	$.ajax(
	{
	  url : '/api/ship/move',
	  type: 'POST',
	  error: function(response) {
	      console.log("FAILURE " + gameid);
	   },
	  data : datas,
	  success: function(response) {
	       moveresponse(response);}
	}
	);
}

function	moveresponse(response)
{
	var obj = JSON.parse(response);


	console.log(obj);

	for (var key in obj)
	{
  		if (obj.hasOwnProperty(key)) 
  		{
  			if (key == 'events')
  			{
  				for (i = 0; i < obj[key].length; i++)
  				{
  					console.log("esanrjiesahriuesa " +obj[key][i]);
  				}
  			}
  		}
  	}
}

function AJAX_ship_fire(gameid, shipid, pp, rotation, movement)
{
	var returnstring = 
	"";
	/*
	<- events
*/
}

function PROCESS_game_create(response)
{
	console.log("PROCESS_game_create: " + response +"\n END_PROCESS_game_create");
}
function PROCESS_game_id(response)
{
	console.log("PROCESS_game_id: " + response +"\n END_PROCESS_game_id");

	var obj = JSON.parse(response);


	console.log(obj);

	for (var key in obj)
	{
  		if (obj.hasOwnProperty(key)) 
  		{
  			if (key == "players")
  			{
  				console.log(key + " -> " + obj[key]);
  				for (var i =0; i< obj[key].length; i++)
  				{
  					//console.log(obj[key][i]['name']);
  				}
  				
  			}
  		}
	}
	Events_Setup_Ships(obj['shipModels'], obj['ships']);
    
}
