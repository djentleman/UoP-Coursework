
			
			
			<div class="leftDiv" id="itemForm">
				
				<!-- action="item_upload_complete.php" OLD HREF -->
				<form class="left">
			
					<h2>New Item</h2>
					
					<h2>Step 1: Item Attributes</h2>
					
				
					<p>Item Name*</p>
					<input class="invalidBox" onkeyup="return checkValid(false, 'itemName')" type="text" id="itemName" name="itemName" value="">
						
					<p>Quantity*</p>
					<input class="invalidBox" onkeyup="return checkValid(true, 'quan')" type="text" id="quan" name="itemQuantity" value="">
						
					<p>Price* (in &pound;)</p>
					<input class="invalidBox" onkeyup="return checkValidPrice()" type="text" id="price" name="price" value="">
						
					<p>Seller Name*</p>
					<input class="invalidBox" onkeyup="return checkValid(false, 'sellerName')" type="text" id="sellerName" name="sellerName" value="">
						
					<p>Is The Item New?
						<input type="checkBox" id="isNew" name="new">
					</p>
						
						
					<p>Tag(s) (seperate with commas)</p>
					<textarea cols="25" rows="5" id="tags" name="tags"></textarea>
						
					<p>Catagory*</p>
					
					<?php
					
						
						include "mysql.php";
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con);
						
						
						mysql_close($con);
					?>
						
					<p>Description (MAX 1000 characters)</p>
					<textarea cols="25" rows="5" id="desc" name="description"></textarea>
						
					

					<input type="button"  onClick="validateItem()"  name="submit" value="Submit"> 
					
						
				</form>
			</div>