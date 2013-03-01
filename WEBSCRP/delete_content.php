	<?php 
		include "header.php" 
	?>
	
		<script>
			// finds the value of the radiobutton
			function getRadioValue(name) {
				var group = document.getElementsByName(name);

				for (var i=0;i<group.length;i++) {
					if (group[i].checked) {
						return group[i].value;
					}
				}
				return '';
			}
			
			function show(targetID){
				target = document.getElementById(targetID);
				target.style.visibility = 'visible';
			}
			
			function hide(targetID){
				target = document.getElementById(targetID);
				target.style.visibility = 'hidden';
			}
			
			function run(){
				var radioValue = getRadioValue('deleteType');
				if (radioValue == "item"){
					show('itemForm');
					hide('catForm');
				} else if (radioValue == "catagory"){
					hide('itemForm');
					show('catForm');
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}
				
			
		</script>
		
		
		<div class="mainContent">
			<h1>Remove Content</h1>
			<form>
				<p>Delete an Item:
					<input type="radio" name="deleteType" value="item">
				</p>
				
				<p>Delete a Catagory
					<input type="radio" name="deleteType" value="catagory">
				</p>
				
				<button onClick="return run()">Go!</button>
			</form>
			<br>
			<div id="itemForm" class="leftDiv" style="visibility: hidden;">
				<p class="left">Select Item To Delete</p>
				<form class="left" action="delete_complete.php" method="post">
					<?php
						$GLOBALS = $GLOBALS+$_REQUEST;
						
						
						include "scripts/executeQuery.php";
						include "scripts/renderListBox.php";
						
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `items`";
						renderListBox($query, $con); // itemID is del variable name
						
						
						mysql_close($con);
						
						echo "<input type='hidden' name='deleteType' value='item'>";
						
						echo "<input type='submit' name='submit' value='delete'>"
					?>
				</form>
			</div>
			
			<div id="catForm" class="rightDiv" style="visibility: hidden;">
				<p class="left"> Select a Catagory</p>
				<form class="left" action="delete_complete.php" method="post">
					<?php
						
						
						
						
						$con = mysql_connect("localhost","root");
				
						$query = "USE `tbuyer`";
						executeQuery($query, $con);
						
						$query = "SELECT * FROM `catagories`";
						renderListBoxCat($query, $con); // catagoryID is del variable name
						
						
						mysql_close($con);
						
						echo "<input type='hidden' name='deleteType' value='cat'>";
						
						echo "<input type='submit' name='submit' value='delete'>"
					?>
				</form>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>