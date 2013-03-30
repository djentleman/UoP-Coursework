	<?php 
		include "header.php" 
	?>
	
		<script src="js/form_choice_delete.js"></script> <!-- JS for form choice -->
		<script src="ajax/form_delete_chooser.js"></script> <!-- AJAX for form rendering -->
		<script src="ajax/del.js"></script> <!-- AJAX for handling deletions -->
		
	
	
		
	
		<div class="mainContent">
			<h1>Remove Content</h1>
			<form>
				<p>Delete an Item:
					<input type="radio" name="deleteType" value="item">
				</p>
				
				<p>Delete a Catagory
					<input type="radio" name="deleteType" value="catagory">
				</p>
				
				<button onClick="return run()">Go!</button>
			</form>
			
			<div id="dynamic"></div>
			
			
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>