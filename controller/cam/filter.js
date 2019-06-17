var filter = "";
window.onscroll = infini_scroll2;
var start = 15;
var limit = 6;

function switch_filter(new_filter)
{
	filter = new_filter;
}
function capture() { 
	// if cam not allumed =D
	// varaible pour pas spam les photo;
	var video = document.querySelector("#videoElement");
	// canvas.width = 1000;
	// canvas.height = 750;
	canvas.getContext('2d').drawImage(video, 0, 0, 1000, 750);
	var canvasData = canvas.toDataURL("image/png"); // ici = blanc apres = noir
	var pix = canvas.getContext('2d').getImageData(500, 375, 1, 1).data
	alert(pix);
	// alert(document.getElementById('image-file').files[0].name);
	if ((video.srcObject == null && document.getElementById('inp').value == "" ) || pix == '0,0,0,0')
	{
		alert("Merci d'allumer la camera ! Ou d'ajouter une image");
		canvas.getContext('2d').clearRect(0, 0, 1000, 750);
		document.getElementById('inp').value = "";
		return;
	}
	if (filter == "")
	{
		alert("Merci de selectionner un filter (Restriction du Sujet)");
		canvas.getContext('2d').clearRect(0, 0, 1000, 750);
		return; //enlever l'input file name
	}
	
	var ajax = new XMLHttpRequest();
	ajax.open("POST",'../controller/cam/pic_save.php', false);
	ajax.setRequestHeader('Content-Type', 'application/upload');
	ajax.send(canvasData);
	if (filter != "no_filter"){
		ajax.open("POST",'../controller/cam/add_filter.php', false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(filter);
	}
	filter = "";
	reload_images();
}
function reload_images()
{
	var ajax = new XMLHttpRequest();
	start = 0;
	limit = 15;
	ajax.onload = () => {
		if (ajax.status == 200)
		{
			start += limit;
			document.getElementById("imgscontainer").innerHTML = '';
			document.getElementById("imgscontainer").innerHTML = ajax.response;
			var preview = document.getElementsByClassName('img_previw')[0];
			preview.getElementsByTagName('img')[3].click(); // open it
			// wait and change variabble for take picture again
		}
	}
	ajax.open("GET",'../controller/cam/data_cam.php?start='+start+'&limit='+limit, true);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
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
	ajax.onload = () => {
		if (ajax.status == 200)
		{
			start += limit;
			document.getElementById("imgscontainer").innerHTML += ajax.response;
			
		}
	}
	ajax.open("GET",'../controller/data_user.php?start2='+start+'&limit2='+limit+'&user='+user, true);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();

}
