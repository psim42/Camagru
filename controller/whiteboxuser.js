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
}
function getLike(id)
{
	var ajax = new XMLHttpRequest();
	ajax.open("GET", '../controller/data.php?like='+id, false);
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
	ajax.open("GET", '../controller/data.php?addlike='+id, false);
	ajax.setRequestHeader('Content-Type', 'text');
	ajax.send();
	if (ajax.status == 200)
	{
		if (ajax.response == "notlog")
		{
			alert("Vous ne pouvez pas like de photo pour le moment merci de vous inscrire");
			window.location='./view/user_creation.php';
		}	
		else{
			document.getElementById("containerlikeW").innerHTML = ajax.response; //whitebox
			document.getElementById("containerlike"+id).innerHTML = ajax.response; //small preview
		}
	}
}
