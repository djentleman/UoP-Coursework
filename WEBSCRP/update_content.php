	<?php 
		include "header.php" 
	?>
		<script src="ajax/edit_cat.js"></script>
		<script src="ajax/edit_item.js"></script>
		<script src="ajax/form_update_chooser.js"></script>
		<script src="js/form_choice_update.js"></script>
		<script src="js/dragupdate.js"></script> <!-- drag and drop uploader listeners -->
		<!-- drag and drop may need moving -->
		
		
		
		<div class="mainContent">
			<h1>Update Content</h1>
			<form>
				<p>Update an Item:
					<input type="radio" name="updateType" value="item">
				</p>
				
				<p>Update An Image:
					<input type="radio" name="updateType" value="image">
				</p>
				
				<p>Update a Catagory
					<input type="radio" name="updateType" value="catagory">
				</p>
				
				<button onClick="return run()">Go!</button>
			</form>
			
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