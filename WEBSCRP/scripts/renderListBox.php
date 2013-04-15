<?php
// Render List Box function


						// 'used for items'
						function renderListBox($query, $con){
							if (!$con){
								die('Could not connect: ' . mysql_error());
							}
							if (mysql_query($query ,$con)){
								//render list box
								
								
								$output = (mysql_query($query ,$con));
								
								echo "<select id='itemList' name='itemID'>";
								// list box name is ID
								//list box JS ID is always 'list'
								
								while($row = mysql_fetch_array($output)){
									$val = $row['itemID'];
									$nam = $row['itemName'];
									echo "<option value=$val>$nam</option>";
								}
									
								
								
								echo "</select>";
								
							}
							else{
								echo mysql_error();
							}
						}
						
						
						
						
						
						
						
						
						
						
						

						// used for 'catagories'
						function renderListBoxCat($query, $con){
							if (!$con){
								die('Could not connect: ' . mysql_error());
							}
							if (mysql_query($query ,$con)){
								//render list box
								
								
								$output = (mysql_query($query ,$con));
								
								echo "<select id='catagoryList' name='catagoryID'>";
								
								while($row = mysql_fetch_array($output)){
									$val = $row['catagoryID'];
									$nam = $row['catagoryName'];
									echo "<option value=$val>$nam</option>";
								}
									
								
								
								echo "</select>";
								
							}
							else{
								echo mysql_error();
							}
						}

						

					
?>