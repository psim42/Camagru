function startcam(e){
	if (navigator.mediaDevices.getUserMedia) {
		var video = document.querySelector("#videoElement");
		  navigator.mediaDevices.getUserMedia({ video: true })
			.then(function (stream) {
			  video.srcObject = stream;
			})
			.catch(function (e)
			 {
			  console.log("Something went wrong!");
			});
		}
	}
function stop(e) {
	alert('stop');
	var video = document.querySelector("#videoElement");
	//protection ?
	var stream = video.srcObject;
	var tracks = stream.getTracks();
	for (var i = 0; i < tracks.length; i++) {
		var track = tracks[i];
		track.stop();
	}
  
	video.srcObject = null;
	}
