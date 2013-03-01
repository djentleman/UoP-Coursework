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
				} else if (radioValue == "catagory"){
					showCatagory();
				} else {
					showImage();
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}