	<?php 
		include "adminheader.php" 
	?>
	
		<script src="../ajax/changeStoreName.js"></script>
		
		
		<div class="mainContent">
			<h1>Customize The Store</h1>
			<div id="storeNameWrap">
				<h3>Change The Store Name</h3>
				<p>Enter New Store Name:</p>
					<input type="text" id="storeName">
				<button onclick="return changeName()">Submit</button>
				<p id="validationCallback"></p>
			</div>
			<div id="DCSSWrap">
				<h3>Change The Colour Scheme</h3>
			</div>
		</div>
	</body>
</html>