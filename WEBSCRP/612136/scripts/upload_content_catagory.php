
			<div class="rightDiv" id="catForm">
				
				<form method="post" class="left">
				
					<h2>New Catagory</h2>
						
					<p>Catagory Name*</p>
					<input type="text" class="invalidBox" onkeyup="return checkValid(false, 'catName')" id="catName" name="catagoryName" value="">
						
					<input type="button" onMouseDown="return validateCat()" name="submit" value="Submit">
						
					<p style="margin-right: 40%;border-radius: 5px; text-align: center;" id="dynamicText"></p>
					
				</form>
				
						
						
			</div>