	// finds the value of the radiobutton
			function getRadioValue(name) {
				var group = document.getElementsByName(name);

				for (var i=0;i<group.length;i++) {
					if (group[i].checked) {
						return group[i].value;
					}
				}
				return '';
			}
			
			function run(){
				var radioValue = getRadioValue('updateType');
				if (radioValue == "item"){
					showItem();
					document.getElementById("dragtarget").style.visibility = 'hidden';
				} else if (radioValue == "catagory"){
					showCatagory();
					document.getElementById("dragtarget").style.visibility = 'hidden';
				} else {
					showImage(); // render text
					document.getElementById("dragtarget").style.visibility = 'visible';
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}