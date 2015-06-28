var x = document.createElement('script');
x.src = '/resources/js/Events.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = '/resources/js/Map.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = '/resources/js/Asteroid.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = 'https://code.createjs.com/tweenjs-0.6.0.min.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = 'https://code.createjs.com/easeljs-0.6.0.min.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = 'https://code.createjs.com/soundjs-0.6.0.min.js';
document.getElementsByTagName("head")[0].appendChild(x);
x.src = 'client/Utils.js';


var stage;
var DIR_SHIP = "/resources/ships/";
var DIR_ICON = "/resources/icons/";
var ship_rotation = {
    RIGHT : 0,
    DOWN : 1,
    LEFT : 2,
    UP : 3
}
var array_ships = [];



function Ship (player, id, model, name, width, height, thesprite, defaultpp, defaulthull, defaultshield, inerty, speed, startmapx, startmapy)
{
    this.tilex = 0;
    this.tiley = 0;
    this.model = model;
    this.name = name;
    if(name.indexOf('/') !== -1)
    {
        this.name = name.split('/')[player - 1];
    }
    this.id = id;
    this.width = width;
    this.height = height;
    this.defaultpp = defaultpp;
    this.defaulthull = defaulthull;
    this.defaultshield = defaultshield;
    this.inerty = inerty;
    this.speed = speed; 
    this.player = player;
    var img = new Image();
    img.src = DIR_SHIP + thesprite +this.player+ ".png";
    console.log(img.src);
    this.ship = new createjs.Bitmap(img);
    this.shipContainer = new createjs.Container();
    
    var mship = this.ship;
    var mid = this.id;
    var mmodel = this.model;
    var mplayer = this.player;
    var mshipcontainer = this.shipContainer;
    this.currotation = ship_rotation.RIGHT;
    this.mapX = startmapx;
    this.mapY = startmapy;

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
        if (player == 2)
        {
            mship.rotation = 180;
        }
    }
    
    this.setPos_Map = function(gridX, gridY)
    {
        var x = _map_tile_width * gridX + _mapoffset_X;
        var y = _map_tile_height * gridY + _mapoffset_Y;
        this.mapX = gridX;
        this.mapY = gridY;
        this.shipContainer.x = x - this.ship.regX + (mship.scaleX * mship.regX);
        this.shipContainer.y = y - this.ship.regY + (mship.scaleY * mship.regY);
    }
    this.setRotation = function(therotation) 
    {
        if (therotation == ship_rotation.RIGHT)
        {
            this.ship.rotation = 0;
        }
        else if (therotation == ship_rotation.DOWN)
        {
            this.ship.rotation = 90;
        }
        else if (therotation == ship_rotation.LEFT)
        {
            this.ship.rotation = 180;
        }
        else if (therotation == ship_rotation.UP)
        {
            this.ship.rotation = -90;
        }
    }
    this.rendership = function(mystage)
    {
        mystage.addChildAt(this.shipContainer, mystage.getNumChildren());
    }

    this.Makeclickable = function(mystage)
    {

        var tmp = this;
        this.shipContainer.addEventListener("click", function (event)
        {
            if (selectedship == mship)
                return;
            if (selectedship != 0)
            {
                selectedshipid = -1;
                selectedship.shadow = 0;
                selectedship = 0;
                img_display_picture.removeAllChildren();
            }
            selectedshipid = mid;
            selectedship = mship;
            text1.text = "NAME:  " + tmp.name;
            text2.text = "ENERGY";
            text3.text = "PP:  " + tmp.defaultpp;
            text4.text = "HULL:  " + tmp.defaulthull;
            text5.text = "SHIELD:  " + tmp.defaultshield;
            text6.text = "MOVEMENT";
            text7.text = "INERTY:  " + tmp.inerty;
            text8.text = "SPEED:  " + tmp.speed;
            text9.text = "POSITION:";
            text10.text = "X:  " + tmp.mapX;
            text11.text = "Y:  " + tmp.mapY;
            if (tmp.player == 1)
            {
                selectedship.shadow = shadow1;
            }
            else 
            {
                selectedship.shadow = shadow2;
            }
            img_display_picture.addChild(new createjs.Bitmap(DIR_ICON + mplayer + "-" + mmodel + ".png"));
            createjs.Sound.play(SHIP_ID_DATA[mmodel].split("/")[mplayer - 1]+ (Math.floor(Math.random() * 10) + 1));
        });
    }

    this.setPos = function(posX, posY)
    {
        this.shipContainer.x = posX - this.ship.regX + (mship.scaleX * mship.regX);
        this.shipContainer.y = posY - this.ship.regY + (mship.scaleY * mship.regY);
    }

    this.tweenPos_Map = function(gridX, gridY)
    {
        var x = _map_tile_width * gridX + _mapoffset_X;
        var y = _map_tile_height * gridY + _mapoffset_Y;
        this.mapX = gridX;
        this.mapY = gridY;
        var newx = x - this.ship.regX + (mship.scaleX * mship.regX);
        var newy = y - this.ship.regY + (mship.scaleY * mship.regY);
        createjs.Tween.get(this.shipContainer, { loop: false })
        .to({ x: newx, y:newy }, 200 * this.speed, createjs.Ease.getPowInOut(4));
    }
    this.destroyship= function(mystage)
    {
        mystage.removeChild(this.shipContainer);
    }
}

