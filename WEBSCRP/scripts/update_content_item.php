<div id="itemForm" class="leftDiv">
			
				
				<h2>Update Item</h2>
				<h3>Leaving a field blank causes that field to not be updated</h3> 
			
				<p class="left">Select Item To Update</p>
				<!-- action="update_item.php"  -->
				<form class="left" method="post" enctype="multipart/form-data">
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						include "mysql.php";
						
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con);
						
						
						mysql_close($con);
					?>
					
					
					
					
					
				
					<p>Item Name*</p>
					<input type="text" id="itemName" name="itemName" value="">
						
					<p>Quantity*</p>
					<input type="text" id="quantity" name="itemQuantity" value="">
						
					<p>Price* (in &pound;)</p>
					<input type="text" id="price" name="itemPrice" value="">
						
					<p>Seller Name*</p>
					<input type="text" id="sellerName" name="sellerName" value="">
						
					<p>Is The Item New?*
						<input type="checkBox" id="isNew" name="new" value="">
					</p>
						
						
					<p>Tag(s) (seperate with commas)</p>
					<textarea id="tags" cols="25" rows="5" name="tags"></textarea>
						
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
					<textarea id="desc" cols="25" rows="5" name="description"></textarea>

					
					<button onclick="return validateItem()">Submit</button>		

				
						
				</form>
			</div>