// modified from: https://github.com/portsoc/dragupload

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


var xhrSend = function(method, uri, payload, callback) {

	var xhr = new XMLHttpRequest();
	xhr.open(method, uri, true);

	xhr.setRequestHeader("Accept", "application/json");

	if (!payload) {
		// no payload? don't use the form's multipart mime type.
		xhr.setRequestHeader("Content-Type", "text/plain;charset=UTF-8");
	}

	for (var evt in callback) {
		xhr.addEventListener(evt, callback[evt].bind(xhr));
	}
	
	
	xhr.send(payload);
};


var upload = function (files) {

	var
		fd,
		xhr,
		callback = {},
		file = files[0];

	callback.load = function() {
		console.log("Loaded", JSON.parse(this.responseText) );
		document.getElementById('response').innerHTML = "Image Successfully Uploaded";
		var target = document.getElementById('dynamicText');
		target.innerHTML = "Item Successfully Uploaded";
	};


	callback.error = function uploadError(e) {
		document.getElementById("response").innerHTML = "Previous upload failed.  No upload in progress." ;
	};

	uploadform = document.forms.uploadform;

	fd = new FormData();
	fd.append("file", file);
	fd.append("ua", navigator.userAgent);

	console.log("Aiming to upload file: ", file);

	xhrSend(
		"POST",
		"../scripts/item_image_upload.php",
		fd,
		callback
	);

	return false;

};

// the page is loaded with php response text; dragtarget doesn't exist at the beggining, so this code fails
// the drag listeners are never set
window.addEventListener("load", function() { registerDragListeners(document.getElementById("dragtarget")); });





