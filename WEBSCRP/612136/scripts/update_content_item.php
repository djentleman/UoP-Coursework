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
						renderListBoxMessage($query, $con, "Please Select");
						
						
						mysql_close($con);
					?>
					
					
					
					
					
				
					<p>Item Name*</p>
					<input type="text" onkeyup="return genericValidate(false, 'itemName')" id="itemName" name="itemName" value="">
						
					<p>Quantity*</p>
					<input type="text" onkeyup="return genericValidate(true, 'quantity')" id="quantity" name="itemQuantity" value="">
						
					<p>Price* (in <?php session_start(); echo $_SESSION['currency']; ?>)</p>
					<input type="text" onkeyup="return genericValidate(true, 'price')" id="price" name="itemPrice" value="">
						
					<p>Seller Name*</p>
					<input type="text" onkeyup="return genericValidate(false, 'sellerName')" id="sellerName" name="sellerName" value="">
						
					<p>Is The Item New?*
                         <select id="isNew">
                            <option value="-1">Keep The Same</option>
                            <option value="0">New</option>
                            <option value="1">Used</option>
                        </select>
					</p>
						
						
					<p>Tag(s) (seperate with commas)</p>
					<textarea onkeyup="return tagsKeyDown()" id="tags" cols="32" rows="8" name="tags"></textarea>
					<p id="tagsRemaining" class="charRemaining">500 Characters Remaining</p>
						
					<p>Catagory*</p>
					
					<?php
					
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCatMessage($query, $con, "Keep The Same");
						
						
						mysql_close($con);
					?>
						
					<p>Description (MAX 1000 characters)</p>
					<textarea onkeyup="return descKeyDown()" id="desc" cols="32" rows="8" name="description"></textarea>
					<p id="descRemaining" class="charRemaining">1000 Characters Remaining</p>

					
					<button onclick="return validateItem()">Submit</button>		
					
					<p  style="margin-right: 40%;border-radius: 5px; text-align: center;" id="dynamicText"></p>

				
						
				</form>
			</div>