			<div class="leftDiv" id="itemForm">
				
				<!-- action="item_upload_complete.php" OLD HREF -->
				<form class="left">
			
					<h2>New Item</h2>
					
					<h2>Step 1: Item Attributes</h2>
					
				
					<p>Item Name*</p>
					<input type="text" id="itemName" name="itemName" value="">
						
					<p>Quantity*</p>
					<input type="text" id="quan" name="itemQuantity" value="">
						
					<p>Price* (in £)</p>
					<input type="text" id="price" name="price" value="">
						
					<p>Seller Name*</p>
					<input type="text" id="sellerName" name="sellerName" value="">
						
					<p>Is The Item New?*
						<input type="radio" id="isNew" name="new" value="1">
					</p>
					<p>Is The Item Used*
						<input type="radio" id="isNew" name="new" value="0">
					</p>
						
						
					<p>Tag(s) (seperate with commas)</p>
					<textarea cols="25" rows="5" id="tags" name="tags"></textarea>
						
					<p>Catagory*</p>
					
					<?php
					
						
						include "executeQuery.php";
						include "renderListBox.php";
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con);
						
						
						mysql_close($con);
					?>
						
					<p>Description (MAX 1000 characters)</p>
					<textarea cols="25" rows="5" id="desc" name="description"></textarea>
						
					

					<input type="button"  onClick="uploadInfo()"  name="submit" value="Submit"> 
					
						
				</form>
			</div>