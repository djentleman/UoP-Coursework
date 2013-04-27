// modified from: http://github.com/portsoc/dragupload

var registerDragListeners = function (target) {
	// this makes a drop possible - remove it and drop events cannot occur.
	target.addEventListener("dragover",
		function(e) { e.preventDefault(); }
	);

	target.addEventListener("drop",
		function(e) {
			e.preventDefault();
			upload(e.dataTransfer.files);
			
			document.getElementById('response').innerHTML = "Image Uploading...";
		}
	);
};

var upload = function (files) {

	var
		fd,
		callback = {},
		file = files[0];

	callback.load = function() {
		//console.log("Loaded", JSON.parse(this.responseText) );
		document.getElementById('response').innerHTML = "Image Successfully Uploaded";
		//document.getElementById('dynamicText').innerHTML = "Item Image Successfully Updated";
	};


	callback.error = function uploadError(e) {
		document.getElementById("response").innerHTML = "Previous upload failed.  No upload in progress." ;
	};

	uploadform = document.forms.uploadform;

	fd = new FormData();
	fd.append("file", file);
	fd.append("ua", navigator.userAgent);
	// choose itemID from listBox
	fd.append("itemID", document.getElementById('itemList').value); // itemID variable

	console.log("Aiming to upload file: ", file);

	var xhr = new XMLHttpRequest();
	xhr.open("POST", "../scripts/update_image_complete.php", true);

	xhr.setRequestHeader("Accept", "application/json");

	if (!fd) {
		// no payload? don't use the form's multipart mime type.
		xhr.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
	}

	for (var evt in callback) {
		xhr.addEventListener(evt, callback[evt].bind(xhr));
	}
	
	xhr.send(fd);

	return false;

};

// the page is loaded with php response text; dragtarget doesn't exist at the beggining, so this code fails
// the drag listeners are never set
window.addEventListener("load", function() { registerDragListeners(document.getElementById("dragtarget")); });





