function startcam(e){
	if (navigator.mediaDevices.getUserMedia) {
		var video = document.querySelector("#videoElement");
		  navigator.mediaDevices.getUserMedia({ video: true })
			.then(function (stream) {
			  video.srcObject = stream;
			})
			.catch(function (err)
			 {
			  console.log("Something went wrong!");
			});
		}
	}
function stop(e) {
	var video = document.querySelector("#videoElement");
	var stream = video.srcObject;
	var tracks = stream.getTracks();
	for (var i = 0; i < tracks.length; i++) {
		var track = tracks[i];
		track.stop();
	}
  
	video.srcObject = null;
	}
