var start = 15;
var limit = 6;
if (window.location.pathname.includes("/cam.php") && window.location.pathname.includes("?") == false){
	window.onscroll = infini_scroll2;
}
else{
	window.onscroll = infini_scroll;
}
function infini_scroll()
{
	// var warp = document.getElementById('imgscontainer');
	var contentHeight = document.body.scrollHeight; // get page content height
	var yOffset = window.pageYOffset; // get the vertical scroll position
	var y = yOffset + window.innerHeight;
	if (y >= contentHeight)
	{
		getData();
	}
	// var status = contentHeight+" | "+y;
	// console.log(status);
}

function getData(){
	var ajax = new XMLHttpRequest();
	var user = document.getElementsByClassName("title")[0].id;
	ajax.open("GET",'../controller/data_user.php?start='+start+'&limit='+limit+'&user='+user, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		start += limit;
		document.getElementById("imgscontainer").innerHTML += ajax.response;
		
	}

}

function infini_scroll2()
{
	// var warp = document.getElementById('imgscontainer');
	var contentHeight = document.body.scrollHeight; // get page content height
	var yOffset = window.pageYOffset; // get the vertical scroll position
	var y = yOffset + window.innerHeight;
	if (y >= contentHeight)
	{
		getData2();
	}
	// var status = contentHeight+" | "+y;
	// console.log(status);
}

function getData2(){
	var ajax = new XMLHttpRequest();
	var user = document.getElementsByClassName("title")[0].id;
	ajax.open("GET",'../controller/data_user.php?start2='+start+'&limit2='+limit+'&user='+user, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		start += limit;
		document.getElementById("imgscontainer").innerHTML += ajax.response;
		
	}

}
function sup(element){
	confirm("sup this "+element);
}
