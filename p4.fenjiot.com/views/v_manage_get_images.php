<? if($images == array ()): ?>
 	<h2>There are no images associated with this product</h2>
 	<a class="mediumwords" href="/manage/addproduct/"> &nbsp&gt;&gt;Add a product</a>
<? else: ?>
	<ul class="rslides">
		<? foreach($images as $image): ?>
			<li><img src="<?=$image['thumb_path']?>" alt="<?=$image['thumb_name']?>"></li>
		<? endforeach; ?>
	</ul>
<? endif; ?>