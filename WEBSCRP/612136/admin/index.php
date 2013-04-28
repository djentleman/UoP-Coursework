	<?php 
		include "adminheader.php"; 
	?>
		<script src="../js/form_buy.js"></script>
		<script src="../ajax/add_stock.js"></script>
		<script src="../ajax/upload_reply.js"></script>
		<script>
			// validation
			
			
            function checkForInjection(id){
				var target = document.getElementById(id);
				var str = target.value;
				
				var regex = new RegExp("(([/]?(.+)[>])|([<][/]?(.+))|')");
				var hasInjection = regex.test(str);
                
                // if true, str has HTML tags or SQL injection in it
                
                // (true BAD false GOOD)
				
				return hasInjection;
            }
			
			function replyButtonDown(){
				if (!(document.getElementById('replyText').className == "invalidBox")){
					document.getElementById('replyResponse').innerHTML = "";
					return uploadReply();
				} else {
					document.getElementById('replyResponse').innerHTML = "Invalid Input: Reply Text Is Invalid";
					return false;
				}
			}
			
			function updateCommentRemaining(){
				// get number of characters
				var currentText = document.getElementById('replyText').value;
				var len = currentText.length;
				var remaining = 1000 - len;
				
				var message = remaining + " Characters Remaining";
				console.log(message);
				document.getElementById('charRemaining').innerHTML = message;
				return false;
			}
			
			
			function commentKeyDown(){
				updateCommentRemaining();
				var hasInjection = checkForInjection('replyText');
				
				if (hasInjection){
					document.getElementById('replyText').className = "invalidBox";
				} else {
					var regex = new RegExp("^(.{0,999})?$");
					var valid = regex.test(document.getElementById('replyText').value);
					if (valid){
						document.getElementById('replyText').className = "";
					} else {
						document.getElementById('replyText').className = "invalidBox";
					}
				}
				return false;
			}
		
		
		</script>
		
		
		
		<div class="mainContent">
			<?php
				include "../scripts/mysql.php";
				echo "<h1>Welcome To The " . $_SESSION['storeName'] . " Admin Panel</h1>";
				
				echo "<div class='lowOnStock'>";
				echo "<h3>Items Running Low On Stock</h3>";

						include "../scripts/get_stock_low.php";
						
				
				echo "</div>";
				
				
				echo "<div class='poorComments'>";
				echo "<h3>Recent Poor Reviews</h3>";
				
				include "../scripts/get_poor_reviews.php";
				
				echo "</div>";
				
			?>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
	</body>
</html>