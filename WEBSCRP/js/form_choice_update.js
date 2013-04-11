	
			function run(code){
			// code 0 = item, 1 = img, 2 = cat
				if (code == 0){
					showItem();
					document.getElementById("dragtarget").style.visibility = 'hidden';
				} else if (code == 1){
					showCatagory();
					document.getElementById("dragtarget").style.visibility = 'hidden';
				} else {
					showImage(); // render text
					document.getElementById("dragtarget").style.visibility = 'visible';
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}