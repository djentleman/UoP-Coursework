	<?php 
		include "header.php" 
	?>
		
		<script src="ajax/upload_cat.js"></script> <!--AJAX script for catagory upload-->
		<script src="ajax/upload_item.js"></script> <!--AJAX script for item upload -->
		<script src="ajax/form_upload_chooser.js"></script>
		<script src="js/form_choice_upload.js"></script> <!--JS script for menu -->
		<script src="js/uploadInfo.js"></script> <!-- JS for step transition -->
		<script src="ajax/render_step2.js"></script> <!-- AJAX for step transition -->
		<script src="js/dragupload.js"></script> <!-- JS drag upload script -->
		
				
		<script>
			function validateItem(){
				var valid = true;
				
				if (document.getElementById('itemName').value == ""){
					valid = false;
				}
				
				if (isNaN(document.getElementById('quan').value)){
					valid = false;
				} else {
					// quan is numberic
					if (document.getElementById('quan').value < 0){
						valid = false
					}
				}
				
				if (isNaN(document.getElementById('price').value)){
					valid = false;
				} else {
					// price is numeric
					if (document.getElementById('price').value < 0){
						valid = false
					}
				}
				
				if (document.getElementById('sellerName').value == ""){
					valid = false;
				}
				
				if (valid){
					uploadInfo();
				} else {
					alert("Invalid Input, Please Make Sure All The Required Fields Are Filled");
				}
			}
			
			function validateCat(){
				var valid = true;
				
				if (document.getElementById('catName').value == ""){
					valid = false;
				}
				
				if (valid){
					return uploadCat();
				} else {
					alert("Invalid Input, Please Make Sure All The Required Fields Are Filled");
				}
				
			}
		</script>

		
		<div class="mainContent" style="padding-bottom: 20px;">
		
			<h1>Upload Content</h1>
			<p> * indicates mandatory field </p>
			<div class="choiceObject" onclick="return run(false);">
				<p style="padding-top: 3px;">Upload New Item</p>
			</div>
			<div class="choiceObject" onclick="return run(true);">
				<p style="padding-top: 3px;">Upload New Catagory</p>
			</div>
			
			<div id="dynamic"></div>
			
			
			<form enctype="multipart/form-data" name="dragtarget" method="POST" onsubmit="return false;">
			</form>

			<!-- hidden (for now) so listeners init -->
			<!-- doesn't render with ajax, uses regular JS to unhide -->
			<div class="dragBox" id="dragtarget" style="visibility:hidden"> <!--   -->
				<p>Drop The Image You Want To Upload Here</p>
				<p id="response">No Image Uploaded Yet</p>
			</div>
			

			
		</div>
	</body>
</html>