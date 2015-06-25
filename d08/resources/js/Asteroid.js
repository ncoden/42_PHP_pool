
var DIR_ASTEROID = "/resources/map_test/Spinning-asteroid-";


function Asteroid( id, width, height, startmapx, startmapy)
{
	this.id = id;
	this.width = width;
	this.height = height;
  	this.mapX = startmapx;
    this.mapY = startmapy;
  	var img = new Image();
    img.src = DIR_ASTEROID + (Math.floor(Math.random() * 7) + 1) +".gif";
    this.ship = new createjs.Bitmap(img);
    this.shipContainer = new createjs.Container();
	var mship = this.ship;
	var mid = this.id;
	var mshipcontainer = this.shipContainer;
 	this.ship.image.onload = function()
    {
        mship.regX = img.width / 2;
        mship.regY = img.height / 2;
        mship.x =  img.width / 2;
        mship.y = img.height / 2;
        mship.scaleX = (_map_tile_width * width ) / img.width;
        mship.scaleY = (_map_tile_height * height) / img.height;
        mshipcontainer.addChild(mship);
        var x = _map_tile_width * startmapx + _mapoffset_X;
        var y = _map_tile_height * startmapy + _mapoffset_Y;
        mshipcontainer.x = x - mship.regX + (mship.scaleX * mship.regX);
        mshipcontainer.y = y - mship.regY + (mship.scaleY * mship.regY);
    }
    this.rendership = function(mystage)
	{
	    mystage.addChildAt(this.shipContainer, mystage.getNumChildren());
	}

	this.destroyship= function(mystage)
	{
	    mystage.removeChild(this.shipContainer);
	}
}

