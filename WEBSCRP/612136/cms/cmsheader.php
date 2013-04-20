<?php include "../scripts/classes/basket.php"; session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title> Tbuyer </title>
		<meta http-equiv="Content-Script-Type" content="text/javascript">
		<link rel="stylesheet" type="text/css" href="../css/Tbuyer.css">
		<script src="../ajax/reset.js"></script> <!-- AJAX for DB reset -->
		
		
	</head>
	
	<script>
		function confirmAction(){
			var confirmed = confirm("Are you sure you want to delete the current database and make a new one?");
			if(confirmed){
				return reset()
			} else
			{
				alert("The Database Has Not Been Reset");
			}
			return false
		}
	</script>
	
	<body>
		<header>
			<nav>
				<ul>
					<a href="index.php" ><img class="logo" style="margin-top:5px" src="../img/Tbuyer.png"></a></img>
					<li><a class="menuCase" style="margin-top:10px">Manage Content</a>
					<ul>
						<li><a class="menuCase" href="upload.php">Upload Content</a></li>
						<li><a class="menuCase" href="update_content.php">Update Content</a></li>
						<li><a class="menuCase" href="delete_content.php">Remove Content</a></li>
						<li><a class="menuCase" id="fetch" onclick="return confirmAction()">Reset Database</a></li>
					</ul>
					<li><a href="../" style="margin-top:10px;" class="menuCase">Log Out</a></li>
					<li><h2 style="margin-top:10px; margin-right:20px;">CMS</h2></li>
				</ul>
			</nav>

			
			
		</header>