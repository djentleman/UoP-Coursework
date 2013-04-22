	<?php 
		include "adminheader.php";
		include "../scripts/mysql.php";
	?>
	
	
		<div class="data">
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
							array_push($dataSetItems, ($itemID));
							array_push($dataSetValues, ($orderQuantity));
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
				
				generateData($data, $con);
				
				function exists($id, $arr){
					foreach($arr as &$current){
						if ($current == $id){
							return true;
						}
					}
					return false;
				}
				
				function collapseDataSets($dataSets, $con){
					// collapses the data sets
					$oldId = $dataSets[0];
					$oldQuan = $dataSets[1];
					$newId = array();
					$newQuan = array();
					$len = count($oldId);
					for ($index = 0; $index < $len; $index++){
						// check if it exists
						$currentId = $oldId[$index];
						$currentQuan = $oldQuan[$index];
						
						// convert id to name
						$newQuery = "SELECT * FROM `items` WHERE `itemID` = '$currentId'";
						$currentName = getData($newQuery, $con)[0];
						
						$doesExist = exists($currentName, $newId);
						if ($doesExist){
							// exists, fold
							// add quantity
							$indexForQuanAdd = array_search($currentName, $newId);
							$newQuan[$indexForQuanAdd] += $currentQuan;
						} else {
							// new, add
							array_push($newId, $currentName);
							array_push($newQuan, $currentQuan);
						}
					}
					return array($newId, $newQuan);
				}
				
				function generateData($dataSets, $con){
					$dataSets = collapseDataSets($dataSets, $con);
					$dataSetItemId = $dataSets[0];
					$dataSetQuantity = $dataSets[1];
					
					
					
					
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
			//google.setOnLoadCallback(drawChart2);

			// Callback that creates and populates a data table,
			// instantiates the pie chart, passes in the data and
			// draws it.
			function drawChart() {

				// Create the data table.
				var data = new google.visualization.DataTable();
				data.addColumn('string', 'Product');
				data.addColumn('number', 'Sold');
				var len = document.getElementById('size').value;
				for(var i = 0; i < len; i++){
					var name = "id" + i;
					var quan = "quan" + i;
					var currentName = document.getElementById(name).value;
					var currentQuan = document.getElementById(quan).value;
					data.addRows([[currentName, parseInt(currentQuan)]]);
				}

				// Set chart options
				var options = {'title':'Most Popular Items In Store',
						   'width':1000,
						   'height':700};

				// Instantiate and draw our chart, passing in some options.
				var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				chart.draw(data, options);
			}
			

		</script>
		
		<div class="mainContent">
			<h1>Graphical Insights</h1>
		
			<div style="margin-left:20%" id="chart_div"></div>

		</div>
	</body>
</html>