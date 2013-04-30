	<?php 
		include "cmsheader.php";
		if ($_SESSION['currency'] == "&yen;"){
			echo "<input type='hidden' id='isYen' value='1'>";
		} else {
			echo "<input type='hidden' id='isYen' value='0'>";
		}
	?>
		<script src="../ajax/edit_cat.js"></script>
		<script src="../ajax/edit_item.js"></script>
		<script src="../ajax/form_update_chooser.js"></script>
		<script src="../js/form_choice_update.js"></script>
		<script src="../js/dragupdate.js"></script> <!-- drag and drop uploader listeners -->
		<!-- drag and drop may need moving -->
		<script>
			function validateItem(){
				var valid = true;
				var callback = "";
                
				if (document.getElementById('itemName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Item Name";
				}
				
				if (document.getElementById('quantity').className == "invalidBox"){
					valid = false;
					callback = "Invalid Quantity";
				}
                
				if (document.getElementById('price').className == "invalidBox"){
					valid = false;
					callback = "Invalid Price";
				}
                
				if (document.getElementById('sellerName').className == "invalidBox"){
					valid = false;
					callback = "Invalid Seller Name";
				}
				
				if (document.getElementById('tags').className == "invalidBox"){
					valid = false;
					callback = "Invalid Tags";
				}
				
				if (document.getElementById('desc').className == "invalidBox"){
					valid = false;
					callback = "Invalid Description";
				}
				
				if (document.getElementById('itemList').value == "-1"){
					valid = false;
					callback = "No Item Selected";
				}
				
				if (valid){
					document.getElementById('dynamicText').innerHTML = "";
					document.getElementById("dynamicText").style.backgroundColor = "#4DB870";
					return editItem();
				} else {
					document.getElementById('dynamicText').innerHTML = callback;
					document.getElementById("dynamicText").style.backgroundColor = "#FF4D4D";
					return false;
				}
			}
            
            
            function genericValidate(isNumeric, id){
                var valid = true;
                var target = document.getElementById(id);
                var str = target.value;
                
                var hasInjection = checkForInjection(id);
                if(hasInjection){
                    valid = false;
                }
                
                if (isNumeric){
                    if (id == "price"){
                        // use regex
						if (document.getElementById('isYen') == "0"){
							// not yen
							var regex = new RegExp("^(([0-9]+([.][0-9]{2})?)|(^$))$");
						} else {
							// yen
							var regex = new RegExp("^(([0-9]?)*)$");
						}
                        var priceValid = regex.test(str);
                        if (!priceValid){
                            valid = false;
                        }
                    } else {
                        if (str != "" && isNaN(str)){
                            valid = false;
                        } else {
                            if (str < 0){
                                valid = false;
                            }
                        }
                    }
                }
                
                if (valid){
                    target.className = "";
                } else {
                    target.className ="invalidBox";
                }
                return false;
            }
			
			function validateCat(){
				var valid = true;
				var callback = "";
				
				if (document.getElementById('catagoryList').value == "-1"){
					valid = false;
					callback = "No Catagory Selected";
				}
                
                if (document.getElementById('catName').className == "invalidBox"){
                    valid = false;
					callback = "Invalid Catagory Name";
                }
				
				if (valid){
					document.getElementById('dynamicText').innerHTML = "";
					document.getElementById("dynamicText").style.backgroundColor = "#4DB870";
					return editCat();
				} else {
					document.getElementById('dynamicText').innerHTML = callback;
					document.getElementById("dynamicText").style.backgroundColor = "#FF4D4D";
					return false;
				}
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
			
			function checkValidDesc(){
				var target = document.getElementById('desc');
				var desc = target.value;
				
				var regex = new RegExp("^(.{0,999})?$");
				var valid = regex.test(desc);
                
                var hasInjection = checkForInjection('desc');
                if(hasInjection){
                    valid = false;
                }
				
				if (valid){
					target.className = "";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			function checkValidTags(){
				var target = document.getElementById('tags');
				var tags = target.value;
				
				var regex = new RegExp("^(.{0,499})?$");
				var valid = regex.test(tags);
				
                var hasInjection = checkForInjection('tags');
                if(hasInjection){
                    valid = false;
                }
				
				if (valid){
					target.className = "";
				} else {
					target.className = "invalidBox";
				}
				console.log(valid);
				return false;
			}
			
			function updateTagsRemaining(){
				// get number of characters
				var currentText = document.getElementById('tags').value;
				var len = currentText.length;
				var remaining = 500 - len;
				
				var message = remaining + " Characters Remaining";
				console.log(message);
				document.getElementById('tagsRemaining').innerHTML = message;
				return false;
			}
			
			function tagsKeyDown(){
				updateTagsRemaining();
				checkValidTags()
				return false;
			}
			
			
			function descKeyDown(){
				checkValidDesc()
				return false;
			}
			
			
		</script>
		
		
		
		<div class="mainContent">
			<h1>Update Content</h1>
			<div class="choiceObject" onclick="return run(0);">
				<p style="padding-top: 3px;">Update an Item</p>
			</div>
			<div class="choiceObject" onclick="return run(2);">
				<p style="padding-top: 3px;">Update An Image</p>
			</div>
			<div class="choiceObject" onclick="return run(1);">
				<p style="padding-top: 3px;">Update a Catagory</p>
			</div>

			
			<br>
			
			<div id="dynamic"></div>
			
			<!-- hidden (for now) so listeners init -->
			<!-- doesn't render with ajax, uses regular JS to unhide -->
			<div class="dragBox" id="dragtarget" style="visibility:hidden"> <!--   -->
				<p style="white-space: normal;">Drop The Image You Want To Upload Here</p>
				<p id="response">No Image Uploaded Yet</p>
			</div>
			
			
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
	</body>
</html>