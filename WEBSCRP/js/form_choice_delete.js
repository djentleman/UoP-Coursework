
			function run(isCat){
				if (!isCat){
					showItem();
				} else{
					showCatagory();
				}
				
				
				//returning false stops the page from refreshing
				return false;
			}