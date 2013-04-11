	<?php 
		include "header.php" 
	?>
	
		<script src="js/form_choice_delete.js"></script> <!-- JS for form choice -->
		<script src="ajax/form_delete_chooser.js"></script> <!-- AJAX for form rendering -->
		<script src="ajax/del.js"></script> <!-- AJAX for handling deletions -->
		
	
	
		
	
		<div class="mainContent">
			<h1>Remove Content</h1>
			<div class="choiceObject" onclick="return run(false);">
				<p style="padding-top: 3px;">Delete an Item</p>
			</div>
			<div class="choiceObject" onclick="return run(true);">
				<p style="padding-top: 3px;">Delete a Catagory</p>
			</div>
			
			<div id="dynamic"></div>
			
			
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>