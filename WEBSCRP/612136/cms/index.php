	<?php 
		include "cmsheader.php"; 
	?>
		<script src="../js/form_buy.js"></script>
		<!-- i would very much like to have self updating quantities here -->
		<!-- but due to the nature of xhrs, i couldn't manage it :( -->
		
		<div class="mainContent">

			<h2>Welcome To The <?php echo $_SESSION['storeName'] ?> CMS</h2>
			
			
			<h3>Items In Store</h3>
			
			
				<?php	
						// uses the same css formatting as basket
						
						include "../scripts/mysql.php";

						
					function executeResults($query, $con){
						if (!$con){
							die("Database Not Set Up");
						}
						if (mysql_query($query ,$con)){
							$output = (mysql_query($query ,$con));
							$count = 0;
							while($row = mysql_fetch_array($output)){
									$itemID = $row['itemID'];
									$itemName = $row['itemName'];
									$quantity = $row['itemQuantity'];
									$price = $row['itemPrice'];
									$sellerName = $row['sellerName'];
									$newInt = $row['isNew'];
									$isNew = "no";
									if ($newInt == 0){
										$isNew = "yes";
									}
									$catID = $row['catagoryID'];
									$catName = getCatName($catID, $con);
									
									
									$quanId = $itemID . ""; // stringify
									
									echo "<div class='basketRow'>";
									
									echo "<div class='basketIdWrap' onclick='goToBuy($itemID, true)'>";
									echo $itemName;
									echo "</div>";
									
									echo "<div class='buyerInfoWrap'>";
									echo $catName;
									echo "</div>";
									
									$quanId = "q" . $count;
									echo "<div id='$quanId' class='buyerInfoWrap'>";
									echo $quantity;
									echo "</div>";
									echo "<input type='hidden' id='$count' value='$itemID' >";
									
									echo "<div class='buyerInfoWrap'>";
									echo $_SESSION['currency'] . $price;
									echo "</div>";
									
									echo "<div class='buyerInfoWrap'>";
									echo $sellerName;
									echo "</div>";
									
									echo "<div class='buyerInfoWrap'>";
									echo $isNew;
									echo "</div>";
									
									echo "</div>";
									$count++;
							}						
						}
						else{
							echo "Database Not Set Up";
						}
					}
						
						
						
						$con = mysql_connect("localhost","root"); // will be querying item IDs
						$query = "USE `tbuyer`";
						executeQuery($query, $con); // use tbuyer
						
							echo "<div id='stockTable'>";

							echo "<div class='basketTable'>";
							
							echo "<div class='basketRow'>";
							
							echo "<div style='width:20%; float:left; height:19px;'>";
							echo "Item Name";
							echo "</div>";
							
							
							echo "<div class='buyerInfoWrap'>";
							echo "Category";
							echo "</div>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Stock";
							echo "</div>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Price";
							echo "</div>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Seller";
							echo "</div>";
							
							echo "<div class='buyerInfoWrap'>";
							echo "Is New";
							echo "</div>";
							
							echo "</div>";

							
							
							
						$query = "SELECT * FROM `items` ORDER BY `itemName`";
						executeResults($query, $con);
						
							echo "</div>";
							echo "</div>";
						
						
						mysql_close($con);

						// have to use innerHTML as value wasn't working
				?>

		</div>
	</body>
</html>