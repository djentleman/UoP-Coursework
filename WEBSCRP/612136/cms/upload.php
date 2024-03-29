	<?php 
		include "cmsheader.php"; 
		if ($_SESSION['currency'] == "&yen;"){
			echo "<input type='hidden' id='isYen' value='1'>";
		} else {
			echo "<input type='hidden' id='isYen' value='0'>";
		}
	?>
		
		<script src="../ajax/upload_cat.js"></script> <!--AJAX script for catagory upload-->
		<script src="../ajax/upload_item.js"></script> <!--AJAX script for item upload -->
		<script src="../ajax/form_upload_chooser.js"></script>
		<script src="../js/form_choice_upload.js"></script> <!--JS script for menu -->
		<script src="../js/uploadInfo.js"></script> <!-- JS for step transition -->
		<script src="../ajax/render_step2.js"></script> <!-- AJAX for step transition -->
		<script src="../js/dragupload.js"></script> <!-- JS drag upload script -->
		
				
		<script>
			function validateItem(){
				var valid = true;
				var callback = "";
				
				if (document.getElementById('itemName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Item Name";
				}
				
				if (document.getElementById('quan').className == "invalidBox"){
					valid = false;
					callback = "Invalid Quantity";
                }
				
				if (document.getElementById('price').className == "invalidBox"){
					valid = false;
					callback = "Invalid Price";
				}
				
				if (document.getElementById('tags').className == "invalidBox"){
					valid = false;
					callback = "Invalid Tags";
				}
				
				if (document.getElementById('desc').className == "invalidBox"){
					valid = false;
					callback = "Invalid Description";
				}
				
				
				if (document.getElementById('catagoryList').value == "-1"){
					valid = false;
					callback = "Please Select A Category";
				}
                
				if (document.getElementById('isNew').value == "-1"){
					valid = false;
					callback = "Please Select A Condition";
				}
				
				if (document.getElementById('sellerName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Seller Name";
				}
				
				if (valid){
					document.getElementById('validationCallback').innerHTML = "";
					document.getElementById('validationCallback').style.backgroundColor = "white";
					uploadInfo();
				} else {
					document.getElementById('validationCallback').innerHTML = callback;
					document.getElementById('validationCallback').style.backgroundColor = "#FF4D4D";
				}
			}
			
			function checkValidPrice(){
				
				var target = document.getElementById('price');
				var price = target.value;
				if (document.getElementById('isYen').value == "0"){
					var regex = new RegExp("^[0-9]+([.][0-9]{2})?$");
				} else {
					var regex = new RegExp("^[0-9]+$");
				}
				var valid = regex.test(price);
                var hasInjection = checkForInjection('price');
                
                if (hasInjection){
                    valid = false;
                }
				
				if (valid){
					target.className = "validBox";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			function checkValidDesc(){
				var target = document.getElementById('desc');
				var desc = target.value;
				
				var valid = true;
                
                
                var hasInjection = checkForInjection('desc');
                
                if (hasInjection){
                    valid = false;
                }
				
				if (valid){
					target.className = "";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			function checkValidTags(){
				var target = document.getElementById('tags');
				var tags = target.value;
				
				var regex = new RegExp("^(.{0,499})?$");
				var valid = regex.test(tags);
                var hasInjection = checkForInjection('tags');
                
                if (hasInjection){
                    valid = false;
                }
				
				if (valid){
					target.className = "";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			
			function validateCat(){
				var valid = true;
				var callback = "";
				
				if (document.getElementById('catName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Category Name";
				}
				
				if (valid){
					document.getElementById("dynamicText").innerHTML = "";
					return uploadCat();
				} else {
					document.getElementById("dynamicText").innerHTML = callback;
					document.getElementById("dynamicText").style.backgroundColor = "#FF4D4D";
				}
				
			}
			
			function checkValid(isNumeric, id){
				// if isNumeric, then contents must be numeric, else just validate for ""
				// id is for getElement
				
				var input = document.getElementById(id).value;
                
				
				if (isNumeric){
					if (isNaN(input) || (input == "")){
						document.getElementById(id).className = "invalidBox";
					} else {
						if (input < 0){
							document.getElementById(id).className = "invalidBox";
						} else {
							document.getElementById(id).className = "validBox";
						}
					}
				} else {
					if (input == ""){
						document.getElementById(id).className = "invalidBox";
					} else {
						document.getElementById(id).className = "validBox";
					}
				}
                
                
                var hasInjection = checkForInjection(id);
                if (hasInjection){
                    document.getElementById(id).className = "invalidBox";
                }
				return false;
			}
            
            function checkForInjection(id){
				var target = document.getElementById(id);
				var str = target.value;
				
				var regex = new RegExp("(([/]?(.+)[>])|([<][/]?(.+))|')");
				var hasInjection = regex.test(str);
                
                // if true, str has HTML tags or SQL injection in it
                
                // (true BAD false GOOD)
				
				return hasInjection;
            }
			
			function updateTagsRemaining(){
				// get number of characters
				var currentText = document.getElementById('tags').value;
				var len = currentText.length;
				var remaining = 500 - len;
				
				var message = remaining + " Characters Remaining";
				console.log(message);
				document.getElementById('tagsRemaining').innerHTML = message;
				return false;
			}
			
			function tagsKeyDown(){
				updateTagsRemaining();
				checkValidTags()
				return false;
			}
			
			
			function descKeyDown(){
				checkValidDesc()
				return false;
			}
			
			
		</script>

		
		<div class="mainContent" style="padding-bottom: 20px;">
		
			<h1>Upload Content</h1>
			<p> * indicates mandatory field </p>
			<div class="choiceObject" onclick="return run(false);">
				<p style="padding-top: 3px;">New Item</p>
			</div>
			<div class="choiceObject" onclick="return run(true);">
				<p style="padding-top: 3px;">New Catagory</p>
			</div>
			
			<div id="dynamic"></div>
			
			
			<form enctype="multipart/form-data" name="dragtarget" method="POST" onsubmit="return false;">
			</form>

			<!-- hidden (for now) so listeners init -->
			<!-- doesn't render with ajax, uses regular JS to unhide -->
			<div class="dragBox" id="dragtarget" style="visibility:hidden"> <!--   -->
				<p style="white-space: normal;">Drop The Image You Want To Upload Here</p>
				<p id="response">No Image Uploaded Yet</p>
			</div>
			

			
		</div>
	</body>
</html>