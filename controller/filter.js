var filter = "";

function capture() {
	var video = document.querySelector("#videoElement");
	canvas.width = 1000;
	canvas.height = 750;
	canvas.getContext('2d').drawImage(video, 0, 0, 1000, 750);
	var canvasData = canvas.toDataURL("image/png");
		var ajax = new XMLHttpRequest();
		alert(filter);
		ajax.open("POST",'controller/pic_save.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(canvasData);
		ajax.open("POST",'controller/add_filter.php',false);
		ajax.setRequestHeader('Content-Type', 'application/upload');
		ajax.send(filter);
}

function switch_filter(new_filter)
{
	filter = new_filter;
}
