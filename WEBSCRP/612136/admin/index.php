	<?php 
		include "adminheader.php" 
	?>
		<script src="../js/form_buy.js"></script>
		<script src="../ajax/add_stock.js"></script>
		<script src="../ajax/upload_reply.js"></script>
		
		
		
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