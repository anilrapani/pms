document.addEventListener('DOMContentLoaded', function () {

    // References to all the element we will need.
    var video = document.querySelector('#camera-stream'),
        video2 = document.querySelector('#camera-stream2'),
        image = document.querySelector('#snap'),
        start_camera = document.querySelector('#start-camera'),
        start_camera2 = document.querySelector('#start-camera2'),
        controls = document.querySelector('.controls'),
        
        take_photo_btn = document.querySelector('#take-photo'),
        take_photo_btn2 = document.querySelector('#take-photo2'),
        delete_photo_btn = document.querySelector('#delete-photo'),
        delete_photo_btn2 = document.querySelector('#delete-photo2'),
        download_photo_btn = document.querySelector('#download-photo'),
        error_message = document.querySelector('#error-message');


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
    start_camera.addEventListener("click", function(e){
		getUserMedia({ video: { facingMode: "environment" } })
            .then( stream => video.srcObject = stream )
            .catch(e => displayErrorMessage(e.name + ": "+ e.message)
			//e => console.log("Manual error : "+e.name + ": "+ e.message)
			);
        e.preventDefault();
		// document.getElementById('start_camera').classList.add("disabled");
		//document.getElementById( 'start_camera' ).style.display = 'none';
		// start_camera.classList.remove("visible");
        // Start video playback manually.
        video.play();
        showVideo();
	
    });
    
     start_camera2.addEventListener("click", function(e){
		getUserMedia({ video: { facingMode: "environment" } })
            .then( stream => video2.srcObject = stream )
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


    take_photo_btn.addEventListener("click", function(e){

        e.preventDefault();

        var snap = takeSnapshot();

        // Show image. 
        image.setAttribute('src', snap);
        image.classList.add("visible");

        // Enable delete and save buttons
        delete_photo_btn.classList.remove("disabled");
        download_photo_btn.classList.remove("disabled");

        // Set the href attribute of the download button to the snap url.
        download_photo_btn.href = snap;

        // Pause video playback of stream.
        video.pause();

    });
    
    take_photo_btn2.addEventListener("click", function(e){

        e.preventDefault();

        var snap = takeSnapshot();

        // Show image. 
        image.setAttribute('src', snap);
        image.classList.add("visible");

        // Enable delete and save buttons
        delete_photo_btn2.classList.remove("disabled");
       // download_photo_btn2.classList.remove("disabled");

        // Set the href attribute of the download button to the snap url.
        // download_photo_btn2.href = snap;

        // Pause video playback of stream.
        video2.pause();

    });





    delete_photo_btn.addEventListener("click", function(e){

        e.preventDefault();

        // Hide image.
        image.setAttribute('src', "");
        image.classList.remove("visible");

        // Disable delete and save buttons
        delete_photo_btn.classList.add("disabled");
        download_photo_btn.classList.add("disabled");

        // Resume playback of stream.
        video.play();

    });


  delete_photo_btn2.addEventListener("click", function(e){

        e.preventDefault();

        // Hide image.
        image.setAttribute('src', "");
        image.classList.remove("visible");

        // Disable delete and save buttons
        delete_photo_btn2.classList.add("disabled");
        download_photo_btn.classList.add("disabled");

        // Resume playback of stream.
        video2.play();

    });

  
    function showVideo(){
        // Display the video stream and the controls.

        hideUI();
        video.classList.add("visible");
        controls.classList.add("visible");
		start_camera.classList.add("invisible");
    }
    
       function showVideo2(){
        // Display the video stream and the controls.

        hideUI();
        video2.classList.add("visible");
        controls.classList.add("visible");
		start_camera2.classList.add("invisible");
    }


    function takeSnapshot(){
        // Here we're using a trick that involves a hidden canvas element.  

        var hidden_canvas = document.querySelector('canvas'),
            context = hidden_canvas.getContext('2d');

        var width = video.videoWidth,
            height = video.videoHeight;

        if (width && height) {

            // Setup a canvas with the same dimensions as the video.
            hidden_canvas.width = width;
            hidden_canvas.height = height;

            // Make a copy of the current frame in the video on the canvas.
            context.drawImage(video, 0, 0, width, height);

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

        controls.classList.remove("visible");
        start_camera.classList.remove("visible");
        video.classList.remove("visible");
        snap.classList.remove("visible");
        error_message.classList.remove("visible");
    }

});
