<div id="itemForm" class="leftDiv">
				<p class="left">Select Item To Delete</p>
				<form class="left" action="update_item.php" method="post" enctype="multipart/form-data">
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						include "executeQuery.php";
						include "renderListBox.php";
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con);
						
						
						mysql_close($con);
					?>
					
					
					
				
					<p>Item Name*</p>
					<input type="text" name="itemName" value="">
						
					<p>Quantity*</p>
					<input type="text" name="itemQuantity" value="">
						
					<p>Price* (in £)</p>
					<input type="text" name="itemPrice" value="">
						
					<p>Seller Name*</p>
					<input type="text" name="sellerName" value="">
						
					<p>Is The Item New?*
						<input type="checkBox" name="new" value="">
					</p>
						
						
					<p>Tag(s) (seperate with commas)</p>
					<textarea cols="25" rows="5" name="tags"></textarea>
						
					<p>Catagory*</p>
					
					<?php
					
						
					
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con);
						
						
						mysql_close($con);
					?>
						
					<p>Description (MAX 1000 characters)</p>
					<textarea cols="25" rows="5" name="description"></textarea>
						
					
					<p> Add Image*
						<!-- Add Image Path* -->
					
						<!-- <input type="text" name="image" value=""> -->
						
						<input name="MAX_FILE_SIZE" value="10002400" type="hidden">
						<input name="image" accept="image/jpeg" type="file">
					</p>
						
					<input type="submit" name="submit" value="Submit">
						
				</form>
			</div>