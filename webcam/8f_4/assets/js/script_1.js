document.addEventListener('DOMContentLoaded', function () {

    // References to all the element we will need.
    var video2 = document.querySelector('#camera-stream2'),
        image2 = document.querySelector('#snap2'),
        start_camera2 = document.querySelector('#start-camera2'),
        controls2 = document.querySelector('.controls2'),
        take_photo_btn2 = document.querySelector('#take-photo2'),
        delete_photo_btn2 = document.querySelector('#delete-photo2'),
        download_photo_btn2 = document.querySelector('#download-photo2'),
        error_message = document.querySelector('#error-message2');


     var getUserMedia = c => {
            var face = c.video && c.video.facingMode;
            face = face && ((typeof face === 'object') ? face : {ideal: face});

            if (!(face && (face.exact == "environment" || face.ideal == "environment")) ||
                (navigator.mediaDevices.getSupportedConstraints &&
                 navigator.mediaDevices.getSupportedConstraints().facingMode)) {
              return navigator.mediaDevices.getUserMedia(c);
            }
            // Polyfill "environment" facingMode. Look for "back" in label, or last cam (usually back).
            delete c.video.facingMode;
            return navigator.mediaDevices.enumerateDevices()
            .then(devices => {
              devices = devices.filter(d => d.kind == "videoinput");
              var back = devices.find(d => d.label.toLowerCase().indexOf("back") != -1) ||
                         (devices.length && devices[devices.length-1]);
              if (back) {
                c.video.deviceId = face.exact? { exact: back.deviceId } : { ideal: back.deviceId };
              }
              return navigator.mediaDevices.getUserMedia(c);
            });
          };

          



    // Mobile browsers cannot play video without user input,
    // so here we're using a button to start it manually.
    start_camera2.addEventListener("click", function(e){
		getUserMedia({ video: { facingMode: "environment" } })
            .then( stream => video2.srcObject = stream )
			.then(video2.play())
            .catch(e => displayErrorMessage(e.name + ": "+ e.message)
			//e => console.log("Manual error : "+e.name + ": "+ e.message)
			);
        e.preventDefault();
		// document.getElementById('start_camera').classList.add("disabled");
		//document.getElementById( 'start_camera' ).style.display = 'none';
		// start_camera.classList.remove("visible");
        // Start video playback manually.
        video2.play();
        showVideo2();
	
    });


    take_photo_btn2.addEventListener("click", function(e){

        e.preventDefault();

        var snap = takeSnapshot2();

        // Show image. 
        image2.setAttribute('src', snap);
        image2.classList.add("visible");

        // Enable delete and save buttons
        delete_photo_btn2.classList.remove("disabled");
        download_photo_btn2.classList.remove("disabled");

        // Set the href attribute of the download button to the snap url.
        download_photo_btn2.href = snap;

        // Pause video playback of stream.
        video2.pause();

    });


    delete_photo_btn2.addEventListener("click", function(e){

        e.preventDefault();

        // Hide image.
        image2.setAttribute('src', "");
        image2.classList.remove("visible");

        // Disable delete and save buttons
        delete_photo_btn2.classList.add("disabled");
        download_photo_btn2.classList.add("disabled");

        // Resume playback of stream.
        video2.play();

    });


  
    function showVideo2(){
        // Display the video stream and the controls.

        hideUI();
        video2.classList.add("visible");
        controls2.classList.add("visible");
		start_camera2.classList.add("invisible");
    }


    function takeSnapshot2(){
        // Here we're using a trick that involves a hidden canvas element.  

        var hidden_canvas = document.querySelector('#canvas2'),
            context = hidden_canvas.getContext('2d');

        var width = video2.videoWidth,
            height = video2.videoHeight;

        if (width && height) {

            // Setup a canvas with the same dimensions as the video.
            hidden_canvas.width = width;
            hidden_canvas.height = height;

            // Make a copy of the current frame in the video on the canvas.
            context.drawImage(video2, 0, 0, width, height);

            // Turn the canvas image into a dataURL that can be used as a src for our photo.
            return hidden_canvas.toDataURL('image/png');
        }
    }


    function displayErrorMessage(error_msg, error){
        error = error || "";
        if(error){
            console.error(error);
        }

        error_message.innerText = error_msg;

        hideUI();
        error_message.classList.add("visible");
    }

   
    function hideUI(){
        // Helper function for clearing the app UI.

        controls2.classList.remove("visible");
        start_camera2.classList.remove("visible");
        video2.classList.remove("visible");
        snap2.classList.remove("visible");
        error_message.classList.remove("visible");
    }

});
