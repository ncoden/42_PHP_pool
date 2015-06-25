var stage;
var colors = ["DimGray", "LightSlateGray", "Green"];
var selected = null;
var squares = [];
var _map_width = 150; 
var _map_height = 100; 
var _map_tile_height = 10;
var _map_tile_width = 10;
var map_prebake_map = true;
var _mapoffset_X = 0;
var _mapoffset_Y = 0;

var _map_text_x;
var _map_text_y;

var text1 = 0;
var text2 = 0;
var text3 = 0;
var text4 = 0;
var text5 = 0;
var text6 = 0;
var text7 = 0;
var text8 = 0;
var text8 = 0;
var text9 = 0;
var text10 = 0;
var text11 = 0;
var shadow1 = 0;
var shadow2 = 0;
var self = 0;
var selectedship = 0;
var selectedshipid = 0;

var img_display_picture = 0;
console.log("MAP LOADED\n");

function generateText_Info(thestage)
{
    text1 = new createjs.Text("", "13px Arial bold", "#fffafa");
    text2 = new createjs.Text("", "11px Arial bold", "#cdc0b0");
    text3 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text4 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text5 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text6 = new createjs.Text("", "11px Arial bold","#cdc0b0");
    text7 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text8 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text9 = new createjs.Text("", "13px Arial bold", "#fffafa");
    text10 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    text11 = new createjs.Text("", "11px Arial bold", "#BBBBBB");
    thestage.addChild(text1);
    thestage.addChild(text2);
    thestage.addChild(text3);
    thestage.addChild(text4);
    thestage.addChild(text5);
    thestage.addChild(text6);
    thestage.addChild(text7);
    thestage.addChild(text8);
    thestage.addChild(text9);
    thestage.addChild(text10);
    thestage.addChild(text11);
    text1.textAlign = "left";
    text1.x = 1525;
    text1.y = 400;
    text2.textAlign = "left";
    text2.x = 1525;
    text2.y = 415;
    text3.textAlign = "left";
    text3.x = 1525;
    text3.y = 435;
    text4.textAlign = "left";
    text4.x = 1525;
    text4.y = 450;
    text5.textAlign = "left";
    text5.x = 1525;
    text5.y = 465;
    text6.textAlign = "left";
    text6.x = 1525;
    text6.y = 485;
    text7.textAlign = "left";
    text7.x = 1525;
    text7.y = 500;
    text8.textAlign = "left";
    text8.x = 1525;
    text8.y = 515;
    text9.textAlign = "left";
    text9.x = 1525;
    text9.y = 535;
    text10.textAlign = "left";
    text10.x = 1525;
    text10.y = 560;
    text11.textAlign = "left";
    text11.x = 1525;
    text11.y = 575;
 img_display_picture.x = 1615;
    img_display_picture.y = 415;
    text1.textBaseline = "alphabetic";
    text1.textBaseline = "alphabetic";

    shadow1 = new createjs.Shadow("#0000FF", 0, 0, 10);
    shadow2 = new createjs.Shadow("#ff0000", 0, 0, 10);
}
 
function generateGrid(thestage)
{
    var bitmap = new createjs.Bitmap("/resources/bg/bg2.jpg");
    img_display_picture =  new createjs.Container();
    bitmap.image.onload = function()
    {
          var originalW = bitmap.image.width;
          var originalH = bitmap.image.height;
          var desiredW = _map_width * _map_tile_width;
          var desiredH = _map_height * _map_tile_height;
          bitmap.scaleX = desiredW / originalW;
          bitmap.scaleY = desiredH / originalH;
    }
    
    bitmap.addEventListener("click", function (event)
    {
        if (selectedship != 0)
        {
            selectedshipid = -1;
            selectedship.shadow = 0;
            selectedship = 0;
            img_display_picture.removeAllChildren();
        }
        text1.text = "";
            text2.text = "";
            text3.text = "";
            text4.text = "";
            text5.text = "";
            text6.text = "";
            text7.text = "";
            text8.text = "";
            text9.text = "";
            text10.text = "";
            text11.text = "";
    });

    thestage.addChild(bitmap);
    bitmap.x = _mapoffset_X;
    bitmap.y = _mapoffset_Y;

     bitmap2 = new createjs.Bitmap("/resources/bg/taskbar.png");
    bitmap2.image.onload = function()
    {
        var originalW = bitmap2.image.width;
        var originalH = bitmap2.image.height;
        var desiredW = 1000;
        var desiredH = 320;
        bitmap2.scaleX = desiredW / originalW;
        bitmap2.scaleY = desiredH / originalH;
        bitmap2.x = _map_tile_width* _map_width - 123;
        bitmap2.y = _map_tile_height * _map_height;
        bitmap2.rotation = -90;
        thestage.addChild(bitmap2);
        _map_text_x = new createjs.Text("X: 0.0", "15px Arial", "#ff7700");
        _map_text_x.x = _map_width * _map_tile_width + 30;
        _map_text_x.y = 670;
        _map_text_x.textBaseline = "alphabetic";
        stage.addChild(_map_text_x);
        _map_text_y = new createjs.Text("Y: 0.0", "15px Arial", "#ff7700");
        _map_text_y.x = _map_width * _map_tile_width + 30;
        _map_text_y.y = 690;
        _map_text_y.textBaseline = "alphabetic";
        stage.addChild(_map_text_y);
        generateText_Info(stage);
        thestage.addChild(img_display_picture);
    }    
    var square;
    var count = 0;
    stage = thestage;
    var square3 = new createjs.Shape();
    square3.graphics.beginFill(colors[2]);
    square3.graphics.drawRect(0, 0, _map_tile_width, _map_tile_height);
    square3.alpha = 0.1;

 
    
  

    stage.addChild(square3);

    stage.on("stagemousemove", function(evt) {
        var x = evt.stageX  -  (evt.stageX % _map_tile_width);
        var y = evt.stageY - ( evt.stageY % _map_tile_height);
        if (x < _map_width * _map_tile_width)
            if (y < _map_height * _map_tile_height)
            {
                square3.x = x;
                square3.y = y;
                square3.alpha = 1;
                if (typeof _map_text_x != 'undefined')
                {
                    _map_text_x.text = "X: " + (x/_map_tile_width);
                    _map_text_y.text = "Y: " + (y/_map_tile_height);
                }
    
                stage.update();
                return;
            }
            square3.alpha = 0;
    }
    );
}
 
 