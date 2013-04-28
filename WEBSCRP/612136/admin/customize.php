	<?php 
		include "adminheader.php";
	?>
	
		<script src="../ajax/changeStoreName.js"></script>
		<script src="../ajax/dcss.js"></script>
		<script>
			function updateHex(){
				var target = document.getElementById('hex');
				if (target.value != ""){
					target.style.color = "#000000";
				} else {
					target.style.color = "#999999";
					target.style.backgroundColor = "#FFFFFF";
					document.getElementById('hexCallback').innerHTML = "";
					return false; // no need to end
				}
				// check if valid
				var regex = new RegExp("^([0-9]|[A-F]){6}$");
				var valid = regex.test(target.value);
				console.log(valid);
				// give validation callback
				if (!valid){
					document.getElementById('hexCallback').innerHTML = "Invalid Hex Code";
					target.style.backgroundColor = "#FFFFFF";
					return false; //exit
				} else {
					document.getElementById('hexCallback').innerHTML = "";
				}
					
				// string is valid!
				var col = "#" + target.value;
				// update colour
				target.style.backgroundColor = col;
				return false;
			}
		
			function updateColour(){
				var target = document.getElementById('colourSelect');
				var selected = target.value;
				if (selected == "FFCC88"){
					target.style.backgroundColor = "#FFCC88";
				} else if (selected == "DD4747"){
					target.style.backgroundColor = "#DD4747";
				} else if (selected == "BCDEFF"){
					target.style.backgroundColor = "#BCDEFF";
				}
				return false;
			}
			
            function checkForInjection(id){
				var target = document.getElementById(id);
				var str = target.value;
				
				var regex = new RegExp("(([/]?(.+)[>])|([<][/]?(.+))|')");
				var hasInjection = regex.test(str);
                
                // if true, str has HTML tags or SQL injection in it
                
                // (true BAD false GOOD)
				
				return hasInjection;
            }
			
			function hideShowAdvancedSettings(){
				var buttonText = document.getElementById('advancedButton').innerHTML;
				var target = document.getElementById('advancedSettings');
				if (buttonText == "Show Advanced Settings") {
					// show settings
					document.getElementById('advancedButton').innerHTML = "Hide Advanced Settings";
					target.style.visibility = "visible";
				} else {
					// hide settings
					document.getElementById('advancedButton').innerHTML = "Show Advanced Settings";
					target.style.visibility = "hidden";
				}
				return false;
			}
			
			function checkHex(){
				if (!(document.getElementById('hexCallback').innerHTML == "Invalid Hex Code")){
					document.getElementById('hexCallback').innerHTML = "Colour Scheme Changed";
					return changeCSS(true)
				}
				return false;
			}
			
			function updateCurrencies(){
				// ajax request
				
				var xhr = new XMLHttpRequest();
				var target = document.getElementById('currentCurrency');
				
				var changeListener = function () {
					if (xhr.readyState === 4 && xhr.status === 200) {
						var callback = xhr.responseText;
						target.innerHTML = "Current Currency: " + callback;
						document.getElementById('old').value = callback;
					}
				};
			
				var code = document.getElementById('currencySelect').value;
				var convert = document.getElementById('convert').checked;
				var sym = document.getElementById('old').value;
				var old = "";
				if (sym == "¥" || sym == "&yen;"){
					old = "JPY";
				} else if (sym == "$" || sym == "&dollar;"){
					old = "USD";
				} else if (sym == "€" || sym == "&euro;"){
					old = "EUR";
				} else {
					old = "GBP";
				}
				
				
				var stringToPass = "?code=" + code + "&convert=" + convert + "&old=" + old;
					
				xhr.onreadystatechange = changeListener;
				xhr.open("GET", "../scripts/changeStoreCurrency.php" + stringToPass, true);
				xhr.send();
				return false;
			}
			
			function nameKeyDown(){
				var hasInjection = checkForInjection("storeName");
				if (hasInjection){
					document.getElementById('storeName').className = "invalidBox";
				} else {
					document.getElementById('storeName').className = "";
				}
				return false;
			}
			
			function checkValidNameChange(){
				if (document.getElementById('storeName').className != "invalidBox"){
					document.getElementById('validationCallback').innerHTML = "";
					return changeName()
				}
				document.getElementById('validationCallback').innerHTML = "Invalid Store Name";
				return false;
				
			}
		
		</script>
		
		
		<div class="mainContent">
			<h1>Customize The Store</h1>
			<div id="storeNameWrap">
				<h3>Change The Store Name</h3>
				<p>Enter New Store Name:</p>
				<input onkeyup="return nameKeyDown()" type="text" id="storeName">
				<button onclick="return checkValidNameChange()">Submit</button>
				<p id="validationCallback"></p>
			</div>
			<div id="currencyWrap">
				<h3>Change The Store Currency</h3>
				Currency:
				<select style="width:80px" id="currencySelect">
					<option value="GBP">GBP  £</option>
					<option value="USD">USD  $</option>
					<option value="EUR">EUR  €</option>
					<option value="JPY">JPY  ¥</option>
				</select>
				Convert Prices:
				<input id="convert" type="checkbox" checked="true">
				<button onclick="return updateCurrencies()">Submit</button>
				<p></p>
				<p id="currentCurrency" class="charRemaining">Current Currency: <?php echo $_SESSION['currency']; ?></p>
				<?php
					echo "<input type='hidden' id='old' value='" . $_SESSION['currency'] . "'>";
				
				?>
			</div>
			<div id="DCSSWrap">
				<h3>Change The Colour Scheme</h3>
				Popular Colours:
				<select id="colourSelect" onchange="return updateColour(false)">
					<option style="background-color:#FFCC88" value="FFCC88">default</option>
					<option style="background-color:#DD4747" value="DD4747">red</option>
					<option style="background-color:#BCDEFF" value="BCDEFF">blue</option>
				</select>
				<button onclick="return changeCSS()">Submit</button>
				<div style="height: 12px;">
					<p  class="noHighlight" onclick="return hideShowAdvancedSettings()" id="advancedButton" style="font-size: 12px;opacity: 0.8; margin-top: 20px;">Show Advanced Settings</p>
				</div>
				<div style="visibility:hidden" id="advancedSettings">
					<p>Please Enter A 6 Digit Hex Code:</p>
					#<input style="color: #999999" onkeyup="return updateHex()" value="eg. FFCC88" id="hex" onblur="if(this.value==''){this.value='eg. FFCC88';}" onclick="if(this.value=='eg. FFCC88'){this.value='';}" onkeyup="return updateHex()" type="text">
					<button onclick="return checkHex()">Submit</button>
					<p id="hexCallback"></p>
				</div>
			</div>
			
		</div>
	</body>
</html>