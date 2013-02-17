	<?php 
		include "header.php" 
	?>
		<script src="ajax/edit_cat.js"></script>
		<script src="ajax/form_update_chooser.js"></script>
		<script src="js/form_choice_update.js"></script>
		
		
		
		
		<div class="mainContent">
			<br>
			<br>
			<h2>Update Content</h2>
			<br>
			<form>
				<p>Update an Item:
					<input type="radio" name="deleteType" value="item">
				</p>
				
				<p>Update a Catagory
					<input type="radio" name="deleteType" value="catagory">
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