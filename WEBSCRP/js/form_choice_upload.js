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
				var radioValue = getRadioValue('uploadType');
				if (radioValue == "item"){
					document.getElementById("dragtarget").style.visibility = 'hidden';
					showItem();
				} else if (radioValue == "catagory"){
					document.getElementById("dragtarget").style.visibility = 'hidden';
					showCatagory();
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}