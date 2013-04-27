<?php 
	include "header.php";	
	$_SESSION['flag'] = false; // init, unlocked
		
?>
	
		<!-- Script For Comment Upload -->
		<script src="ajax/upload_com.js"></script>
		<script src="ajax/check_valid_quantity.js"></script>
		<script>
			// validation for comments
			
			setInterval(function(){
				updateItemStock(); // update stock updates
			},3000);
			
			function updateItemStock(){
				var itemID = document.getElementById('itemID').value;
				//console.log(itemID);
				if (itemID == -1){
					console.log("invalid item id, 404");
					return false; // end
				}
				// next part is AJAX
				
				var xhr = new XMLHttpRequest();
				var target = document.getElementById('quan');
				
				var changeListener = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						var callback = xhr.responseText;
						if (callback == 0){
							target.innerHTML = "SOLD OUT";
							target.style.color = "red";
						} else if (callback < 6){
							target.innerHTML = "Only " + callback + " Left In Stock!";
							target.style.color = "red";
						} else {
							target.innerHTML = callback + " Left In Stock";
							target.style.color = "black";
						}
						console.log(callback);
						// normally would use nested if, but this one is being built compact
					}
				};
			
				stringToPass = "?itemID=" + itemID;
				
				xhr.onreadystatechange = changeListener;
				xhr.open("GET", "./scripts/get_quantity.php" + stringToPass, true);
				xhr.send();
			}
			
			
            function checkForInjection(id){
				var target = document.getElementById(id);
				var str = target.value;
				
				var regex = new RegExp("(([/]?(.+)[>])|([<][/]?(.+))|')");
				var hasInjection = regex.test(str);
                
                // if true, str has HTML tags or SQL injection in it
                
                // (true BAD false GOOD)
				
				return hasInjection;
            }
			
			function checkValidUser(){
				var hasInjection = checkForInjection('posterName');
				
				if (hasInjection){
					document.getElementById('posterName').className = "invalidBox";
				} else {
					document.getElementById('posterName').className = "";
				}
				return false;
			
			}
			
			function updateCommentRemaining(){
				// get number of characters
				var currentText = document.getElementById('comment').value;
				var len = currentText.length;
				var remaining = 1000 - len;
				
				var message = remaining + " Characters Remaining";
				console.log(message);
				document.getElementById('charRemaining').innerHTML = message;
				return false;
			}
			
			function commentKeyDown(){
				updateCommentRemaining();
				var hasInjection = checkForInjection('comment');
				
				if (hasInjection){
					document.getElementById('comment').className = "invalidBox";
				} else {
					var regex = new RegExp("^(.{0,999})?$");
					var valid = regex.test(document.getElementById('comment').value);
					if (valid){
						document.getElementById('comment').className = "";
					} else {
						document.getElementById('comment').className = "invalidBox";
					}
				}
				return false;
			}
			
			function addComment(){
				var valid = true;
				var callback = ""; // validation callback
				if (document.getElementById('comment').className == "invalidBox"){
					valid = false;
					callback = "Invalid Comment Body";
				}
				if (document.getElementById('posterName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Poster Name";
				}
				
				if(valid){
					document.getElementById('validationCallback').innerHTML = "";
					uploadAndRefresh();
				} else {
					document.getElementById('validationCallback').innerHTML = "Invalid Input: " + callback;
				}
				return false;
			}
				
		</script>
		
		<div class="mainContent">
				<?php
				
					if (isset($_GET['itemID'])){
						$itemID = $_GET['itemID'];
					} else {
						$itemID = -1;
					}
					
					include "scripts/getItemInfo.php"; // comes with a free scripts/mysql.php
					
					if ($itemName == "404: Item Not Found :("){
						echo "<div id='404'>";
						echo "<img src='img/404.jpg'><img>";
						echo "<h1>Item Not Found</h1>";
						echo "<a style='text-decoration: none;' href='index.php'><h3 style='color:grey'>Back To Home</h3></a>";
						echo "<input type='hidden' id='itemID' value='-1'>";
						echo "</div>";
						die();
						
					} else {
						
						echo "<input type='hidden' id='itemID' value='$itemID'>";
						
						echo "<div class='itemInfo'>";
						echo "<h2>$itemName</h2>";
						if ($itemQuantity > 5){
							echo "<p>Price &pound;$itemPrice</p>";
							echo "<p id='quan'>$itemQuantity Left In Stock</p>";
						} else {
							echo "<p>Price &pound;$itemPrice</p>";
							if ($itemQuantity != 0){
								echo "<p id='quan' style='color:red'>Only $itemQuantity Left In Stock!</p>";
							} else {
								echo "<p id='quan' style='color:red'>SOLD OUT</p>";
							}
						}
						echo "<p> Seller Name: $sellerName</p>";
						echo "<p> Category: $catagoryName</p>";
						
						if ($isNew == 0){
							echo "Item Is New";
						} else {
							echo "Item Is Used";
						}
						if ($averageRating == -1){
							echo "<p>Item Not Yet Rated</p>";
						} else {
							echo "<p>Average Rating: $averageRating/10</p>";
						}
					
						
					
						echo "<form method='post' action='basket.php'> <!-- still uses php lol -->";
						echo "Quantity To Buy:";
						
						$id = '"quanToBuy"';
						if ($itemQuantity > 0){
							echo "<input class='validBox' id='quanToBuy' onload='return checkValid($itemID, $id)' onkeyup='return checkValid($itemID, $id)' style='width:20px' type='text' name='quanToBuy' value='1'>";
						} else {
							echo "<input class='invalidBox' id='quanToBuy' onkeyup='return checkValid($itemID, $id)' style='width:20px' type='text' name='quanToBuy' value='1'>";
						}
					
					
						echo "<input type='hidden' name='itemID' value='$itemID'>"; // item, ID to carry forward
					
					
					    echo "<input type='submit' name='submit' value='Add To Basket'>";
						echo "</form>";
					}
				?>
			</div> <!--closes 404 div OR item info div -->
			<div class="itemPicture">
				<?php
					
					if (!($itemName == "404: Item Not Found :(")){
						if ($image != "none" && $image != ""){
							echo "<img src='$image' class='itemImage'></img>";
						}
						else {
							echo "<img src='img/no_img.png' class='itemImage'></img>"; // 'no image defined'
						}
					}
				?>
			</div>
			<div class="itemDescription">
				<?php
					if (!($itemName == "404: Item Not Found :(")){
						echo "<p> <strong>Description:</strong>   $itemDescription</p>";
						echo "<br>";
						echo "<br>";
						echo "<p><strong>Item Tags:</strong> $tags </p>";
					}
				?>
			</div>
			
			<div class="itemComments">
				
				
				<h3>COMMENTS</h3>
				<div id="comments">
					<?php
						if (!($itemName == "404: Item Not Found :(")){
							
							include "scripts/fetch_comments.php";
						}
					?>
				</div>
				
				<p id="dynamicText"></p>
				
				
			
				
				
				
				
				
				<!--  action="comment_upload_complete.php" OLD ACTION -->
				<form class="commentForm" method="get">
					
					
					<?php
						if (!($itemName == "404: Item Not Found :(")){
							// for mysql reference
							echo "<h4>Add A Comment</h4>";
							echo "<input type='hidden' id='itemID' name='itemID' value='$itemID'>";
							echo "Poster Name (leave blank for 'Anon')";
						
							echo "<input type='text' onkeyup='return checkValidUser()' id='posterName' name='posterName' value=''>";
							echo "<p></p>";
							
							echo "Submit A Rating:";
							echo "<select id='rating'>";
							echo "<option value='-1'>No Rating</option>";
							echo "<option value='0'>0/10</option>";
							echo "<option value='1'>1/10</option>";
							echo "<option value='2'>2/10</option>";
							echo "<option value='3'>3/10</option>";
							echo "<option value='4'>4/10</option>";
							echo "<option value='5'>5/10</option>";
							echo "<option value='6'>6/10</option>";
							echo "<option value='7'>7/10</option>";
							echo "<option value='8'>8/10</option>";
							echo "<option value='9'>9/10</option>";
							echo "<option value='10'>10/10</option>";
							echo "</select>";
							
							echo "<p>Comment (MAX 500 characters)</p>";
							
							
							echo "<textarea cols='35' onkeyup='return commentKeyDown();' rows='7' id='comment' name='comment'></textarea>";
							echo "<p id='charRemaining' class='charRemaining'>1000 Characters Remaining</p>";
							
							
							echo "<p></p>";
							
							echo "<!-- calls ajax -->";
							echo "<button onclick='return addComment()' name='submit'>Add Comment</button>";
							echo "<p id='validationCallback'></p>";
						}
					?>
					
					
					
					
				</form>
			</div>
				
			
		</div>
	</body>
</html>