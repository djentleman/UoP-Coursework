	<?php
		session_start();
		$GLOBALS = $GLOBALS+$_REQUEST;
		$_SESSION['items'] = "";
		$_SESSION['items'] = $_SESSION['items'] . $_GET['itemID'];
	?>
	
	<?php 
		include "header.php" 
	?>
		
		
		<div class="mainContent">
			<br>
			<br>
			
			
					<?php
						
						
						// needs work lol
						
						
						$arr = $_SESSION['items'];
						
						echo $arr;
						
						
					?>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>