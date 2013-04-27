	<?php 
		include "header.php" 
	?>
		
		<script>	
			function shiftLeft(){
				var current = document.getElementsByClassName('currentContent')[0];
				var left = document.getElementsByClassName('leftContent')[0];
				var right = document.getElementsByClassName('rightContent')[0];
				
				current.className = "rightContent";
				left.className = "currentContent";
				right.className = "leftContent";
				
				return false;
			}
			
			function shiftRight(){
				var current = document.getElementsByClassName('currentContent')[0];
				var left = document.getElementsByClassName('leftContent')[0];
				var right = document.getElementsByClassName('rightContent')[0];
				
				current.className = "leftContent";
				left.className = "rightContent";
				right.className = "currentContent";
				
				return false;
			}
		</script>
		
		
		<div style="overflow:hidden" class="mainContent">
			<?php
				echo "<h1>Welcome To " . $_SESSION['storeName'] . "</h1>";
				
				echo "<div class='indexItemWrap'>";
				
				echo "<div onclick='return shiftLeft()' class='leftButton'>";
				echo "<";
				echo "</div>";
				
				echo "<div  onclick='return shiftRight()' class='rightButton'>";
				echo ">";
				echo "</div>";
				
				echo "<div class='currentContent'>";
				getHighestRated();
				echo "</div>";
				
				echo "<div class='leftContent'>";
				getNewest();
				echo "</div>";
				
				echo "<div class='rightContent'>";
				getMostPopular();
				echo "</div>";
				
				echo "</div>";
				
				echo "<a style='text-decoration: none;' href='browse.php'><h3 style='color:grey'>Begin Shopping</h3></a>";
				
				function getHighestRated(){
					echo "<h2>Highest Rated</h2>";
				}
				
				function getMostPopular(){
					echo "<h2>What's Popular</h2>";
				}
				
				function getNewest(){
					echo "<h2>What's New</h2>";
				}
			?>
		</div>
	</body>
</html>