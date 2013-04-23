	<?php 
		include "cmsheader.php" 
	?>
		<script src="../ajax/edit_cat.js"></script>
		<script src="../ajax/edit_item.js"></script>
		<script src="../ajax/form_update_chooser.js"></script>
		<script src="../js/form_choice_update.js"></script>
		<script src="../js/dragupdate.js"></script> <!-- drag and drop uploader listeners -->
		<!-- drag and drop may need moving -->
		<script>
			function validateItem(){
				var valid = true;
				var quan = document.getElementById('quantity').value;
				var price = document.getElementById('price').value;
				
				var regex = new RegExp("^[0-9]+([.][0-9]{2})?$");
				var priceValid = regex.test(price);
				
				if (quan != "" && isNaN(quan)){
					// quan is not empty, and not a number
					valid = false;
				}
				
				if (price != "" && priceValid == false){
					valid = false;
				}
				
				if (valid){
					return editItem();
				} else {
					alert("Input was invalid, make sure price and quantity are numbers.");
					return false;
				}
			}
		</script>
		
		
		
		<div class="mainContent">
			<h1>Update Content</h1>
			<div class="choiceObject" onclick="return run(0);">
				<p style="padding-top: 3px;">Update an Item</p>
			</div>
			<div class="choiceObject" onclick="return run(2);">
				<p style="padding-top: 3px;">Update An Image</p>
			</div>
			<div class="choiceObject" onclick="return run(1);">
				<p style="padding-top: 3px;">Update a Catagory</p>
			</div>

			
			<br>
			
			<div id="dynamic"></div>
			
			<!-- hidden (for now) so listeners init -->
			<!-- doesn't render with ajax, uses regular JS to unhide -->
			<div class="dragBox" id="dragtarget" style="visibility:hidden"> <!--   -->
				<p>Drop The Image You Want To Upload Here</p>
				<p id="response">No Image Uploaded Yet</p>
			</div>
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>