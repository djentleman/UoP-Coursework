
			function run(isCat){
				if (!isCat){
					document.getElementById("dragtarget").style.visibility = 'hidden';
					showItem();
				} else{
					document.getElementById("dragtarget").style.visibility = 'hidden';
					showCatagory();
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}