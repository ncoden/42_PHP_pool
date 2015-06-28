var x = document.createElement('script');
x.src = '/resources/js/Asteroid.js';

var		FLAG_Setup_Ships = false;
var		FLAG_Setup_Elements = false;
var		SHIP_ID_DATA =
{
	1 : "assault/space_marine",
	2 : "chaplain/sorcerer",
	3 : "d/raptor",
	4 : "force_commander/aspiring",
	5 : "greyknights/tanks",
	6 : "t/chaos_lord",
};
var		DIR_SOUND = "/resources/sounds/"

var		MAP_SHIPS = [];
var		MAP_ASTEROIDS = [];
var		stage;

function Events_init(thestage)
{
	stage = thestage;
}

function Event_Load_Sounds()
{
	for (var key in SHIP_ID_DATA)
	{
		var res = SHIP_ID_DATA[key].split("/");
		for (i = 1; i <= 10; i++)
		{
			createjs.Sound.registerSound(DIR_SOUND + res[0]+ i + ".mp3", res[0]+ i );
			createjs.Sound.registerSound(DIR_SOUND + res[1]+ i + ".mp3", res[1]+ i );
		}
		
	}
}

function Event_Clear_Map_Ships()
{
	if (MAP_SHIPS.length > 0)
	{
		for (i = 0; i < MAP_SHIPS.length ; i++)
		{
			MAP_SHIPS[i].destroyship(stage);
		}
	}
	MAP_SHIPS = [];
}

function Event_Render_Map_Ships()
{
	if (MAP_SHIPS.length > 0)
	{
		for (i = 0; i < MAP_SHIPS.length ; i++)
		{
			MAP_SHIPS[i].rendership(stage);
			MAP_SHIPS[i].Makeclickable(stage);
		}
	}
}

function Events_Setup_Ships(shipmodels, ships)
{
	FLAG_Setup_Ships = false;
	Event_Clear_Map_Ships();

	for (var skey in ships)
	{
		for (var smkey in shipmodels)
		{
			if (shipmodels[smkey]['id'] == ships[skey]['model'])
			{
				var mship = new Ship(
					ships[skey]['player'] + 1, 
					shipmodels[smkey]['id'],
					ships[skey]['id'],
					shipmodels[smkey]['name'],
					shipmodels[smkey]['width'] * 5,
					shipmodels[smkey]['height'] * 5,
					shipmodels[smkey]['sprite'],
					shipmodels[smkey]['defaultPP'],
					shipmodels[smkey]['defaultHull'],
					shipmodels[smkey]['defaultShield'],
					shipmodels[smkey]['inerty'],
					shipmodels[smkey]['speed'],
					ships[skey]['posX'],
					ships[skey]['posY']);
				MAP_SHIPS.push(mship);
			}
		}
  	}
  	FLAG_Setup_Ships = true;
}

function Event_Clear_Map_Elements()
{
	if (MAP_ASTEROIDS.length > 0)
	{
		for (i = 0; i < MAP_ASTEROIDS.length ; i++)
		{
			MAP_ASTEROIDS[i].destroyship(stage);
		}
	}
	MAP_ASTEROIDS = [];
}

function Event_Render_Map_Elements()
{
	if (MAP_ASTEROIDS.length > 0)
	{
		for (i = 0; i < MAP_ASTEROIDS.length ; i++)
		{
			MAP_ASTEROIDS[i].rendership(stage);
		}
	}
}

function Events_Setup_Elements(elements)
{
	FLAG_Setup_Elements = false;
	var asteroidid = 0;
	for (var key in elements)
	{
		console.log("elements" + key +  elements[key]['type']);
  		if (elements[key]['type'] == 'asteroid')
  		{
  			var masteroid = new Asteroid(
asteroidid,
elements[key]['width'],
elements[key]['height'],
elements[key]['posX'],
elements[key]['posY']
  				);
  			MAP_ASTEROIDS.push(masteroid);
  			asteroidid++;
  		}
  	}
  	FLAG_Setup_Elements = true;
}
