<div class="col-wrapper">
	<div class="col-2-sub1">
	</div> <!-- end .col-2-sub1 -->
	
	<div class="col-2-sub2">
	</div> <!-- end .col-2-sub2 -->

	<div class="col-2-sub3">
		<div id="main_information">

			<? if($products == array ()): ?>
			 	<h2>There are no products in the system.&nbsp Nothing to see here.</h2>
			 	<a class="mediumwords" href="/manage/addproduct/"> &nbsp&gt;&gt;Add a product</a>
			<? else: ?>
				<? foreach($products as $product): ?>
					<div class="products tiled">
						<button >
						Product name: <?=$product['product_name']?>
						<img src="<?=$product['thumb_path']?>">				
						<br>						
						Category: <?=$product['product_category']?>
						<br>
						</button>
					</div>
				<? endforeach; ?>
			<? endif; ?>

		</div> <!-- end main_information div -->
	</div><!-- end col-2-sub3 -->	
</div><!-- end col-wrapper -->