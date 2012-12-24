<? if($materials == array ()): ?>
 	<h2>There are no materials associated with this product</h2>
 	<a class="mediumwords" href="/manage/addproduct/"> &nbsp&gt;&gt;Add a product</a>
<? else: ?>
	<? foreach($materials as $material): ?>
		<div class="products tiled">
			Material name: <?=$material['name']?> -- color: <?=$material['color']?>
			<br>
		</div>
	<? endforeach; ?>
<? endif; ?>