<?php 
	include "header.php";	
	$_SESSION['flag'] = false; // init, unlocked
		
?>
	
		<!-- Script For Comment Upload -->
		<script src="ajax/upload_com.js"></script>
		
		<div class="mainContent">
			<div class="itemPicture">
				<?php
					$GLOBALS = $GLOBALS+$_REQUEST;
					include "scripts/getItemInfo.php"; // comes with a free scripts/executeQuery.php
					
					if ($image != "none" && $image != ""){
						echo "<img src='$image' class='itemImage'></img>";
					}
					else {
						echo "<img src='img/no_img.png' class='itemImage'></img>"; // 'no image defined'
					}
				?>
			</div>
			<div class="itemInfo">
				<?php
					echo "<h2>$itemName</h2>";
					echo "<p>";
					echo "Price &pound;$itemPrice   ,";
					echo "Quantity: $itemQuantity";
					echo "</p>";
					echo "<p> Seller Name; $sellerName</p>";
					
					if ($isNew != 0){
						echo "Item Is New";
					} else {
						echo "Item Is Used";
					}
					
				?>
				<br>
				<br>
				<form method="post" action="basket.php">
					<p>Quantity To Buy:
						<input style="width:20px" type="text" name="quanToBuy">
					</p>
					<?php
						echo "<input type='hidden' name='itemID' value='$itemID'>" // item, ID to carry forward
					?>
					<input type="submit" name="submit" value="Add To Basket">
				</form>
			</div>
			<div class="itemDescription">
				<?php
					
					echo "<p> <strong>Description:</strong>   $itemDescription</p>";
					echo "<br>";
					echo "<br>";
					echo "<p><strong>Item Tags:</strong> $tags </p>";
				?>
			</div>
			
			<div class="itemComments">
				<h3> COMMENTS </h3>
				
				
				<div id="comments">
					<?php
						include "scripts/fetch_comments.php";
					?>
				</div>
				
				<p id="dynamicText"></p>
				
				
			
				
				
				
				
				
				<!--  action="comment_upload_complete.php" OLD ACTION -->
				<form class="commentForm" method="get">
					<h4>Add A Comment</h4>
					
					
					<?php
						// for mysql reference
						echo "<input type='hidden' id='itemID' name='itemID' value='$itemID'>";
						
					
						
					?>
					
					<p>
						Poster Name (leave blank for 'Anon')
						<input type="text" id="posterName" name="posterName" value="">
					</p>
					
					<p>Comment (MAX 500 characters)</p>
					<textarea cols="35" rows="7" id="comment" name="comment"></textarea>
					
					<p></p>
					
					<!-- calls ajax -->
					<input type="submit" onclick="return uploadAndRefresh()" name="submit" value="Submit Comment">
					
					
				</form>
			</div>
				
			
		</div>
	</body>
</html>