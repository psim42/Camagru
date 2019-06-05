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
	var name = element.src;
	var str = " <img class='imgWhiteBox' src='" + name + "'>";
	document.getElementById("bigview").innerHTML = str;
}
