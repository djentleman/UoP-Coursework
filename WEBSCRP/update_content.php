	<?php 
		include "header.php" 
	?>
		<script src="ajax/edit_cat.js"></script>
		<script src="ajax/form_update_chooser.js"></script>
		<script src="js/form_choice_update.js"></script>
		
		
		
		
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
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>