

function uploadReply() {

	var xhr, changeListener;
	
	

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				document.getElementById('poorComment').innerHTML = "<p> Reply Uploaded </p>";
				nextPoor();

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


function ignore() {

	var xhr, changeListener;
	
	

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				document.getElementById('poorComment').innerHTML = "<p> Review Ignored </p>";
				nextPoor();

			}
		}
	};
	
	var OPID = document.getElementById('OPID').value;
	var stringToPass = "?OPID=" + OPID;
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "../scripts/ignore_comment.php" + stringToPass, true);
	xhr.send();
	
	
	
	return false;
	
};


function nextPoor() {

	var xhr, changeListener;
	
	

	xhr = new XMLHttpRequest();
	changeListener = function () {
		if (xhr.readyState === 4) {
			if (xhr.status === 200) {
				document.getElementById('poorComment').innerHTML = document.getElementById('poorComment').innerHTML + xhr.responseText;

			}
		}
	};
	
	xhr.onreadystatechange = changeListener;
	xhr.open("GET", "../scripts/get_poor_reviews.php", true);
	xhr.send();
	
	
	
	return false;
	
};