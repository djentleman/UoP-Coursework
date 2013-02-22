					
				<div  class="left">	
					
					
					
					
					<h2>New Item</h2>
					<h2>Step 2: Image</h2>
					

				
					<form method="post" enctype="multipart/form-data">
						<p>The item data has now been uploaded; please upload an image for the new item</p>
						<br>
						<p> Add Image*
							<!-- Add Image Path* -->
					
							<!-- <input type="text" name="image" value=""> -->
						
							<input name="MAX_FILE_SIZE" value="10002400" type="hidden">
							<input type="file" name="image" id="img" accept="image/jpeg">
						</p>
						
						
						<button onclick="return uploadItem2()">Submit</button> 
					</form>
					
					<div id="dynamicText"></div>
				</div>