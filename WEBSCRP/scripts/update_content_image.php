<div id="catForm" class="leftDiv"> <!-- sift right -->
				<p class="left"> Select an Item</p>
				<!-- action="update_catagory.php" -->

				
				<form class="left" enctype="multipart/form-data" method="post">
				
					
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						include "executeQuery.php";
						include "renderListBox.php";
						
						// renders list box
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con);
						
						mysql_close($con);
					?>
					
					
						<p> Add Image
						
							<input name="MAX_FILE_SIZE" value="10002400" type="hidden">
							<input type="file" name="image" id="img" accept="image/jpeg">
						</p>
						
						
						<button onclick="">Submit</button> <!-- add oinclick-->
					</form>
					
				</form>
			</div>