

function uploadReply() {

	var xhr, target, changeListener;
	
	
	target = document.getElementById("dynamicText");

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				document.getElementById('poorComment').innerHTML = "<p> Reply Uploaded </p>";

			}
		}
	};
	
	
	
	
	var itemID = document.getElementById('itemID').value;
	var posterName = "Admin"
	var rating = -1;
	var OP = document.getElementById('OP').value;
	var OPID = document.getElementById('OPID').value;
	var comment = "@" + OP + "  " + document.getElementById('replyText').value;
	
	
	
	var stringToPass = "?itemID=" + itemID + "&posterName=" + posterName + "&comment=" + comment + "&rating=" + rating + "&isReply=0&OPID=" + OPID;
	
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "../scripts/comment_upload_complete.php" + stringToPass, true);
	xhr.send();
	
	
	
	return false;
	
};

