	<?php 
		include "adminheader.php" 
	?>
	
	
		<div class="adminInfo">
			<?php
				// hidden data goes here
				echo "<input id='test' type='hidden' name='Test2' value='5'>";
			?>
		</div>
		
		 <!--Load the AJAX API-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">

			// Load the Visualization API and the piechart package.
			google.load('visualization', '1.0', {'packages':['corechart']});

			// Set a callback to run when the Google Visualization API is loaded.
			google.setOnLoadCallback(drawChart);

			// Callback that creates and populates a data table,
			// instantiates the pie chart, passes in the data and
			// draws it.
			function drawChart() {

				// Create the data table.
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Product');
				data.addColumn('number', 'Sold');
				data.addRows([
					['Mushrooms', 4],
					['Onions', 1],
					['Olives', 1],
					['Zucchini', 1],
					['Ham', 3],
					['Pepperoni', 2]
				]);
				data.addRows([['Test', 3]]);
				var currentName = document.getElementById('test').name;
				var currentVal = document.getElementById('test').value;
				data.addRows([[currentName, parseInt(currentVal)]]);

				// Set chart options
				var options = {'title':'Most Popular Items In Store',
						   'width':800,
						   'height':600};

				// Instantiate and draw our chart, passing in some options.
				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			}
		</script>
		
		<div class="mainContent">
		
			<div id="chart_div"></div>

		</div>
	</body>
</html>