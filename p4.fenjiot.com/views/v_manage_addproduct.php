<div class="col-wrapper">
	<div class="col-2-sub1">
	</div> <!-- end .col-2-sub1 -->
	
	<div class="col-2-sub2">
	</div> <!-- end .col-2-sub2 -->

	<div class="col-2-sub3">
		<div id="main_information">

			<form name='new-post' method='POST' action='/manage/p_addproduct'>
				<div class="module">
					<div class="header" id="header-dynamic">First Add a new product</div>
					<br>
					
					<div class="field-wrapper">
						<label for="product-name">Product Name</label>
						<div class="input"><input id="product-name" type="text" name="product_name" placeholder="i.e. Saddle bag" required="required"></div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="field-wrapper">
						<label for="product-name">Product Category</label>
						<div class="input"><input id="product-category" type="text" name="product_category" placeholder="i.e. Totes" required="required"></div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
					<br>
					
					<div class="field-wrapper">
						<label for="product-material">Material Name</label>
						<div class="input"><input id="product-material-name" type="text" name="material_name" placeholder="i.e. Leather" required="required"></div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="field-wrapper">
					<label for="product-color">Material Color</label>
					<div class="input"><input id="product-material-color" type="text" name="material_color" placeholder="i.e. Butterscotch" required="required"></div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
					<br>
					
					<div class="field-wrapper">
						<label for="product-material">Material Description</label>
						<div class="input">
							<textarea rows="10" cols="50" id="product-material-description" type="text" name="material_description" placeholder="i.e. Horween Chromexcel" required="required"></textarea>
						</div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
					<br>
					
					<div class="field-wrapper">
						<label for="product-description">Product Description</label>
						<div class="input">
							<textarea rows="10" cols="50" id="product-description" type="text" name="product_description" placeholder="More detailed explanation of the product" required="required"></textarea>
						</div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
					<br>
					
					<div class="field-wrapper">
						<label for="product-story">Product Story</label>
						<div class="input">
							<textarea rows="10" cols="50" id="product-story" type="text" name="product_story" placeholder="Story of the product" required="required"></textarea>
						</div>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
				
					<br><br>
						
				</div> <!-- end .module -->
				
				<div class="module">
					<input id="button" type="submit" name="submit" value="Add product">
				</div> <!-- end .module -->
				
				<? if(@$_GET['error']): ?>
					<span class="error"><?=$_GET['error']?></span><br>
				<? endif; ?>
			 
				<? if(@$_GET['alert']): ?>
				<span class="alert"><?=$_GET['alert']?></span><br>
				<? endif; ?>
				
			</form>
			
			<!--
			<div id='results'></div>
			
			<script type='text/javascript'>
				
				// Set up the options for Ajax and our form
				var options = { 
					type: 'POST',
					url: '/manage/p_addproduct/',
					beforeSubmit: function() {
						$('#results').html("Adding...");
					},
					success: function(response) { 	
						$('#results').html("The product has been added.");
					} 
				}; 
					
				// Using the above options, Ajax'ify the form	
				$('form[name=new-post]').ajaxForm(options);
				
			</script>
			-->
			<br>
			
			<form name='new-post2' method='POST' enctype="multipart/form-data" action='/manage/p_addimage'>
				<div class="module">
					<div class="header" id="header-dynamic">Then Add an image for this product </div>
					<input type="hidden" name="product_id" value="<?=$_GET['alert']?>">
					<br>
					
					<div class="field-wrapper">
						<label for="product-image">Add Product Image</label>
						<div class="input"><input id="product-image" type="file" name="image_name"></div>
						<? if(@$_GET['errorimage']): ?>
							<span class="error"><?=$_GET['errorimage']?></span><br>
						<? endif; ?>
					 
						<? if(@$_GET['alertimage']): ?>
						<span class="alert"><?=$_GET['alertimage']?></span><br>
						<? endif; ?>
					</div>  <!-- end .field-wrapper -->
					
					<div class="clear"></div>
				
					<br><br>
					
				</div> <!-- end .module -->
				
				<div class="module">
					<input id="button" type="submit" name="submit" value="Add image">
				</div> <!-- end .module -->
			</form>
			
			<!--
			<div id='results2'></div>
			
			<script type='text/javascript'>
				
				// Set up the options for Ajax and our form
				var options = { 
					type: 'POST',
					url: '/manage/p_addimage/',
					beforeSubmit: function() {
						$('#results2').html("Adding...");
					},
					success: function(response) { 	
						$('#results2').html("Image has been added to the product.");
					} 
				}; 
					
				// Using the above options, Ajax'ify the form	
				$('form[name=new-post2]').ajaxForm(options);
				
			</script>
			-->

		</div> <!-- end main_information div -->
	</div><!-- end col-2-sub3 -->	
</div><!-- end col-wrapper -->
