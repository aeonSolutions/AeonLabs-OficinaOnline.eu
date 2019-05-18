/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

  var reader;
  var progress = document.querySelector('.percent');

  function abortRead() {
    reader.abort();
  }


  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; // noop
      default:
        alert('An error occurred reading this file.');
    };
  }


  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        progress.textContent = percentLoaded + '%';
      }
    }
  }


  function handleFileSelect(evt) {
    // Reset progress indicator on new file selection.
    progress.style.width = '0%';
    progress.textContent = '0%';

    reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
    reader.onabort = function(e) {
      alert('File read cancelled');
    };
    reader.onloadstart = function(e) {
      document.getElementById('progress_bar').className = 'loading';
    };
    reader.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
      progress.textContent = '100%';
      setTimeout("document.getElementById('progress_bar').className='';", 2000);
    }

    // Read in the image file as a binary string.
    reader.readAsBinaryString(evt.target.files[0]);
  }


if (window.File && window.FileList && window.FileReader) {
	handleFileSelect()
}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	// file drag hover
	function FileDragHover(e) {
		e = (e ===null )? window.event : e;
		e.stopPropagation();
		e.preventDefault();
		e.target.className = (e.type == "dragover") ? "hover" : "";
	}

/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	// file selection
	function FileSelectHandler(e) {
		e = (e ===null )? window.event : e;
		// cancel event and hover styling
		FileDragHover(e);

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {

			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('Dialogs').innerHTML="<p>Loading image <strong>" + f.name + ":</strong></p><pre>" + e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre>";
			}
			window.alert(f);
			reader.readAsDataURL(f);
			// create a form with a couple of values
			var data2send = new FormData();
			data2send.append("name", "Nicholas");
			data2send.append("FilePhoto", f);
			CommServer('PA9nJTKVRX1qRydGclYSvewvZPc6qA&uploadfile=true', data2send);
		}

	}



	// output file information
	function ParseFile(file) {

		// display an image
		if (file.type.indexOf("image") == 0) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('Dialogs').innerHTML="<p>Loading image <strong>" + file.name + ":</strong></p><pre>" + e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre>";
			}
			reader.readAsDataURL(file);
		}

		// display text
		if (file.type.indexOf("text") == 0) {
			var reader = new FileReader();
			reader.onload = function(e) {
				document.getElementById('Dialogs').innerHTML="<p>Loading image <strong>" + file.name + ":</strong></p><pre>" + e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") + "</pre>";
			}
			reader.readAsText(file);
		}

	}
/////////////////////////////////////////////////////////////////////////||\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	// initialize
	function Init() {

		var fileselect = $id("FilePhoto"),
			filedrag = $id("PhotoPlaceholderBox"),
			submitbutton = $id("FileSubmit");

		// file select
		fileselect.addEventListener("change", FileSelectHandler, false);

		// is XHR2 available?
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {

			// file drop
			filedrag.addEventListener("dragover", FileDragHover, false);
			filedrag.addEventListener("dragleave", FileDragHover, false);
			filedrag.addEventListener("drop", FileSelectHandler, false);
			filedrag.style.display = "block";

			// remove submit button
			submitbutton.style.display = "none";
		}

	}

	// call initialization file
	if (window.File && window.FileList && window.FileReader) {
		Init();
	}
