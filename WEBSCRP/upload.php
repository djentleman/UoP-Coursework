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

		
		<div class="mainContent" style="padding-bottom: 20px;">
		
			<h1>Upload Content</h1>
			<p> * indicates mandatory field </p>
			
			<form>
				<p>Upload New Item:
					<input type="radio" name="uploadType" value="item">
				</p>
				
				<p>Upload New Catagory
					<input type="radio" name="uploadType" value="catagory">
				</p>
				
				<button onClick="return run()">Go!</button>
			</form>
			
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