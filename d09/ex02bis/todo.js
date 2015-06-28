function setCookie(name,value,days)
{
	var date = new Date();

	date.setTime(date.getTime()+(days*24*60*60*1000));
	document.cookie = name + "=" + value + "; expires="+ date.toGMTString() + "; path=/";
	return ;
}

function deleteCookie(name)
{
	setCookie(name, 'deleted', -2);
	return ;
}

function padZero(num)
{
	var s = num + "";
	while (s.length < 2)
		s = "0" + s;
	return (s);
}

function DeleteTheShitOutOfThatTodoBitch(str)
{
	if (confirm('Do you really want to delete this todo ?'))
	{
		console.log(str);
		$("#"+str).remove();
		deleteCookie(str);
	}
}

var i = 0;

function addDiv(str)
{
	i++;
	$("#ft_list").append("<div "+"id="+"todo"+padZero(i)+" onclick=DeleteTheShitOutOfThatTodoBitch(\""+"todo"+padZero(i)+"\") "+"name="+"todo"+padZero(i)+">"+str+"</div>");
	setCookie("todo"+padZero(i), str.replace('=', '%3D').replace(';', '%3B'), 7);
}

function newTodo()
{
	var str = prompt("Enter the new todo");
	if (str.length > 0)
		addDiv(str);
}

function getCookies()
{
	var cookiesArray = document.cookie.split(';');
	var array = {};

	for (var x in cookiesArray)
	{
		var toto = cookiesArray[x].split("=");

		if (toto.length > 1 && /todo\d+/.test(toto[0]))
			array[toto[0].trim()] = toto[1].trim();
	}
	return (array);
}

var cookies = getCookies();
var sortedKeys = Object.keys(cookies).sort();

for (var x in sortedKeys)
{
	deleteCookie(sortedKeys[x]);
	addDiv(cookies[sortedKeys[x]]);
}
