	<?php 
		include "adminheader.php";
		include "../scripts/mysql.php";
	?>
	
	
		<div class="adminInfo">
			<?php
				// data set goes here
				function getDataSets($query, $con){
					if (!$con){
						die('Could not connect: ' . mysql_error());
					}
					if (mysql_query($query ,$con)){
						$output = (mysql_query($query ,$con));
						$dataSetItems = array();
						$dataSetValues = array();
						while($row = mysql_fetch_array($output)){
							// push itemID to dataSetItems
							// push quantity sold to dataSetValues
							$orderQuantity = $row['orderQuantity'];
							$itemID = $row['itemID'];
							array_push($dataSetItems, $itemID);
							array_push($dataSetValues, $orderQuantity);
						}
						return array($dataSetItems, $dataSetValues);
						
					}
					else{
						echo mysql_error();
					}
						
				}
				
				
				$con = mysql_connect("localhost","root");
				
				$query = "USE `tbuyer`";
				executeQuery($query, $con);
				
				$query = "SELECT * FROM `orders`";
				$data = getDataSets($query, $con);
				
				generateData($data);
				
				function generateData($dataSets){
					$dataSetItemId = $dataSets[0];
					$dataSetQuantity = $dataSets[1];
					
					// collapse the data sets
					
					$len = count($dataSetItemId);
					
					echo "<input type='hidden' id='size' value='$len'>";
					
					for($index = 0; $index < $len; $index++){
						$currentId = $dataSetItemId[$index];
						$currentQuan = $dataSetQuantity[$index];
						$itemId = "id" . $index;
						$quanId = "quan" . $index;
						echo "<input type='hidden' id='$itemId' value='$currentId'>";
						echo "<input type='hidden' id='$quanId' value='$currentQuan'>";
					}
					
				}
				
				//echo json_encode($data);
				
				mysql_close($con);
				

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