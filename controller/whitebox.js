// Get the modal
var modal = document.getElementById('id01');
var com_start = 0;
var com_limit = 5;
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event)
{
	var modal = document.getElementById('id01');
	if (event.target == modal) 
	{
		modal.style.display = "none";
	}
}

var el = window;
var eventName = 'keypress';
if (el.addEventListener) {
	el.addEventListener('keydown', keyListener, false); 
}
else if (el.attachEvent){ //IE COMPATIBILITY
	el.attachEvent('on'+eventName, keyListener);
}

function keyListener(event){ 
	var modal = document.getElementById('id01');
	event = event || modal.event;
	var key = event.key || event.which || event.keyCode;
	var txtarea = document.getElementById("myTextarea");
	/* insert conditional here */
	if (modal.style.display == "block" && key === "Enter" && txtarea != document.activeElement){
		event.preventDefault();
		document.getElementById('myTextarea').focus();
	}
	if (key === "Escape" && modal.style.display == "block"){ // esc
		document.getElementById('id01').style.display='none';
	}
}

function enlarge(element)
{
	var modal = document.getElementById('id01');
	modal.style.display = "block";
	var id = element.id;
	var name = element.src;
	var str = " <img class='imgWhiteBox' id='"+id+"' src='" + name + "'>";
	document.getElementById("bigview").innerHTML = str;	
	getLike(id);
	getNbCom(id);
	textaera();
	document.getElementById("coms_container").innerHTML = ''; //vider les com charger d'avant
	com_start = 0;
	com_limit = 5;
	getComment(id); 
}
function getLike(id)
{
	var ajax = new XMLHttpRequest();
	ajax.open("GET", 'controller/data.php?like='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		// console.log(ajax.response);
		document.getElementById("containerlikeW").innerHTML = ajax.response; //whitebox
		document.getElementById("containerlike"+id).innerHTML = "<img class='coeur_com' src='resources/img/coeurP.png' alt='C'>"+ajax.response; //small preview
	}
	ajax.open("GET", 'controller/data.php?likepic='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		document.getElementById("coeurW").src = ajax.response; //whitebox
	}
}

function getNbCom(id)
{
	var ajax = new XMLHttpRequest();
	ajax.open("GET", 'controller/data.php?idnbcom='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		// console.log(ajax.response);
		document.getElementById("containercomW").innerHTML = ajax.response; //whitebox
		document.getElementById("containercom"+id).innerHTML = "<img class='coeur_com' src='resources/img/comment-icon.png' alt='C'>"+ajax.response; //small preview
	}
	
}
function getComment(id) // variable global remetre a valeur de base dans enlage ? ou ajouter un parametre de fonction ?
{
	var ajax = new XMLHttpRequest();
	ajax.open("POST",'controller/data.php', false);
	ajax.setRequestHeader("content-type", "application/x-www-form-urlencoded");
	ajax.send('com_start='+com_start+'&com_limit='+com_limit+'&pic_id='+id);
	if (ajax.status == 200)
	{
		var coms_container = document.getElementById("coms_container");
		var input_load = document.getElementById('input_load_com');
		//si ya le load boutton le sup pour pas en avoir 2
		if (input_load)
		{
			coms_container.removeChild(input_load);
		}
		coms_container.innerHTML += ajax.response;
		input_load = document.getElementById('input_load_com');
		com_start += com_limit;
		var nbcom = document.getElementById('containercomW').innerHTML;
		if(com_start >= nbcom || nbcom == 0)
		{
			coms_container.removeChild(input_load);
		}
	}
}

function addlike()
{
	var id = document.getElementsByClassName("imgWhiteBox")[0].id;
	var ajax = new XMLHttpRequest();
	ajax.open("GET", 'controller/data.php?addlike='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		if (ajax.response == "notlog")
		{
			alert("Vous ne pouvez pas like de photo pour le moment. Merci de vous inscrire");
			window.location='./view/user_creation.php';
		}	
		else{
			document.getElementById("containerlikeW").innerHTML = ajax.response; //whitebox
			document.getElementById("containerlike"+id).innerHTML = "<img class='coeur_com' src='resources/img/coeurP.png' alt='C'>"+ajax.response; //small preview
			getLike(id);
		}
	}
}

function addcom(){
	var comment = document.getElementById("myTextarea").value;
	var lastChar = comment[comment.length -1];
	if (lastChar == "\n")
	{
		var comment = comment.substring(0, comment.length-1);
	}
	if (comment.length == 0){
		alert("Votre commentaire est vide");
		return;
	}
	if (comment.length > 255){
		alert("Votre commentaire est trop grand ! \n255 caractère maximum !");
		return;
	}
	if ((comment.split("\n").length - 1 >= 5)){
		alert("Votre commentaire est trop grand ! \nTrop de retour a la ligne !");
		return;
	}
	var id = document.getElementsByClassName("imgWhiteBox")[0].id;
	var ajax = new XMLHttpRequest();
	ajax.open("POST", 'controller/data.php', false);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send('idPicCom='+id+'&comment='+comment);
	if (ajax.status == 200 && ajax.readyState === 4)
	{
		if (ajax.response == "notlog")
		{
			alert("Vous ne pouvez pas commenter de photo pour le moment. Merci de vous inscrire");
			window.location='./view/user_creation.php';
		}
		enlarge(document.getElementById(ajax.responseText)); // Ajouter chargement des comentaire dans enlarge
		// alert(ajax.responseText);
	}
}

function textaera()
{
	document.getElementById("myTextarea").value = '';
	var input = document.getElementById("myTextarea");
		var map = {}; // 
		input.onkeydown = input.onkeyup = function(e){
			e = e || event; // to deal with IE
			map[e.keyCode] = e.type == 'keydown';
			/* insert conditional here */
			if (map[13] && map[16]){ // SHIFT+ENTRER
				delete map[13];
			}
			else if (map[13])
			{
				event.preventDefault();
				document.getElementById("send").click();
				delete map[13];
			}
		};
		
}
