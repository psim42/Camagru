// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event)
{
	var modal = document.getElementById('id01');
	if (event.target == modal) 
	{
		modal.style.display = "none";
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
}

function getNbCom(id)
{
	var ajax = new XMLHttpRequest();
	ajax.open("GET", 'controller/data.php?nbcom='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		// console.log(ajax.response);
		document.getElementById("containercomW").innerHTML = ajax.response; //whitebox
		document.getElementById("containercom"+id).innerHTML = ajax.response; //small preview
	}
	
}
function getComment(id)
{
	
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
		document.getElementById("containerlike"+id).innerHTML = ajax.response; //small preview
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
			document.getElementById("containerlike"+id).innerHTML = ajax.response; //small preview
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
		alert("Votre commentaire est trop grand ! 255 caractère maximum !");
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
		alert(ajax.responseText);
	}
}

function textaera()
{
	document.getElementById("myTextarea").value = '';
	var input = document.getElementById("myTextarea");
		var map = {}; // 
		input.onkeydown = input.onkeyup = function(e){
			// e = e || event; // to deal with IE
			map[e.keyCode] = e.type == 'keydown';
			/* insert conditional here */
			if (map[13] && map[16]){ // SHIFT+ENTRER
				delete map[13];
				delete map[16];
			}
			else if (map[13])
			{
				event.preventDefault();
				document.getElementById("send").click();
				delete map[13];
			}
		};
		
}
