	<?php 
		include "header.php" 
	?>
		
		
		<div class="mainContent">
			<h1>Advanced Search</h1>
			<br>
			<br>
			<form method="post" action="advancedBrowse.php">
				<div class="left">
					<?php
					
					
					// catagory
					
					echo "<p> Search Catagory";
					echo "<input type='checkbox' name='isCatagory' value='true'> </p>";
					
					include "scripts/renderListBox.php"; // going to need this for catagory
					include "scripts/executeQuery.php";
					
					// ListBox requires SQL link
					
					$con = mysql_connect("localhost","root");
						

					$query = "USE `tbuyer`";
					executeQuery($query, $con);
								
					$query = "SELECT * FROM `catagories`";
					renderListBoxCat($query, $con); // catagoryID is DDB variable name
								
								
					mysql_close($con);
					
					// --------------- end listBox
					
					echo "<br>"; // new line
					echo "<br>"; // new line
					 
					// tags
					
					echo "<p> Search Tags";
					echo "<input type='checkbox' name='isTags' value='true'> </p>";
					
					echo "<input type='text' name='tagSearch' value=''>";
					
					
					echo "<br>"; // new line
					echo "<br>"; // new line
					
					// item Name
					
					echo "<p> Search Item Name";
					echo "<input type='checkbox' name='isName' value='true'> </p>";
					
					echo "<input type='text' name='nameSearch' value=''>";
					
					
					
					echo "<p> </p>"; // new line
					
					echo "<input type='submit' name='submit' value='search'>";
					?>
				</div>
			</form>
			<br>
		</div>
	</body>
</html>