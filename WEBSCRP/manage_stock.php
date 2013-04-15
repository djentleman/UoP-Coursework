<?php
	include "header.php"
?>
		<script src="js/form_buy.js"></script> <!-- fetching item pages -->
		<script src="ajax/add_stock.js"></script>


		<div class="mainContent">
			<h1>Manage Stock</h1>
			
			<!-- generate a basket like table of all stock, with add stock buttons -->
			
			<?php
				include "scripts/get_stock.php";
			?>
		</div>
	</body>
</html>
