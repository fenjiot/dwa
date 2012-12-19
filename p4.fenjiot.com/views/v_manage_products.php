<? if($products == array ()): ?>
	
 	<h2>There are no products in the system.&nbsp Nothing to see here.</h2>
 	<a class="mediumwords" href="/manage/addproduct/"> &nbsp&gt;&gt;Add a product</a>

<? else: ?>

	<? foreach($products as $product): ?>
		<div class="products tiled">
			<h2>Added by user_id: <?=$product['user_id']?></h2>
			<div class="">Product added on <?=Time::display($product['created'])?></div>
			<div class="">Product last modified on <?=Time::display($product['modified'])?></div>
			
			<br><br>
			
			Product Name: <?=$product['product_name']?>
			
			<br>
			
			Product Category: <?=$product['product_category']?>
			
			<br>
			
			Product Image: <img src="<?=$product['image_path']?>"><?=$product['image_name']?>
			
			<br>
			
			<div class="">
			Product Story:<?=$product['product_story']?></div>
			
			<br>
			
			<div class="">
			Product Description:<?=$product['product_description']?></div>
			
			<br>
		</div>
	<? endforeach; ?>
	
<? endif; ?>