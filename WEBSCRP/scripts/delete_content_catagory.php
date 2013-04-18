<div id="catForm">
<div class="rightDiv">
				<p class="left"> Select a Catagory</p>
				<!--  action="delete_complete.php" OLD -->
				<form class="left" method="post">
					<?php
										
						// uses the same css formatting as basket
						
						include "mysql.php";

						
					function executeResults($query, $con){
						if (!$con){
							die('Could not connect: ' . mysql_error());
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
									$catID = $row['catagoryID'];
									$name = $row['catagoryName'];
									
									
									echo "<div class='basketRow'>";
									

									echo "<div style='width:30%; height:19px; float:left;'>";
									echo $name;
									echo "</div>";
									
									echo "<div class='addStock' onclick='return del(true, $catID)'>"; // remove item & refresh
									echo " x ";
									echo "</div>";
									
									

									
									
									echo "</div>";
								
							}						
						}
						else{
							echo mysql_error();
						}
					}
						
						
						
						$con = mysql_connect("localhost","root"); // will be querying item IDs
						$query = "USE `tbuyer`";
						executeQuery($query, $con); // use tbuyer
						
							echo "<div id='stockTable'>";

							echo "<div class='basketTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div style='width:30%; float:left; height:19px;'>";
							echo "Category Name";
							echo "</div>";
							
							echo "<div class='basketPriceWrap'>";
							echo "Remove";
							echo "</div>";
							
							echo "</div>";

							
							
							
						$query = "SELECT * FROM `catagories`";
						executeResults($query, $con);
						
							echo "</div>";
							echo "</div>";
						
						
						mysql_close($con);

						// have to use innerHTML as value wasn't working
					
					
					?>
					
				</form>
			</div>
		</div>