<div class="col-wrapper">
	
	<div class="col-2-sub1">
<!--		<div class="subnav">
			<ul>
				<li><a id="totes" href="#totes">totes</a></li>
				<li><a id ="handbags" href="#handbags">handbags</a></li>
				<li><a id="backpacks" href="#backpacks">backpacks</a></li>
				<li><a id="accessories" href="#accessories">accessories</a></li>
			</ul>
		</div> <!-- end .submenu1 -->
	</div> <!-- end .col-2-sub1 -->
	
	<div class="col-2-sub2">
		<div id="subnav2" class="subnav">
			<ul>
				<? if(isset($navigation)): ?>
					<? foreach($navigation as $key => $value): ?>
						<li><a id="#<?=$value?>"href="<?=$value?>"><?=$key?></a></li>
					<? endforeach; ?>
				<? endif; ?>
			</ul>
		</div>
	</div> <!-- end .col-2-sub2 -->

	<div class="col-2-sub3">
		<div id="main_information">
			<? if($products == array ()): ?>
			 	<h2>There are no products in the system.&nbsp Nothing to see here.</h2>
			 	<a class="mediumwords" href="/manage/addproduct/"> &nbsp&gt;&gt; Sign up and Add a product</a>
			<? else: ?>			
				<? foreach($products as $key => $product): ?>
					<div class="products tiled">
						Product name: <?=$product['name']?>
						<br>
						<ul class="rslides">
							<? foreach($product['images'] as $key3 => $image): ?>
								<li><img src="<?=$product['images'][$key3]['thumb_path']?>" alt="<?=$product['images'][$key3]['name']?>"></li>
							<? endforeach; ?>
						</ul>			
						<br>						
						Category: <?=$product['category']?>
						<br>
						Material:
						<ul>
							<? foreach($product['materials'] as $key2 => $material): ?>
								<li>&nbsp;&nbsp;&nbsp;<?=$product['materials'][$key2]['name']?> -- <?=$product['materials'][$key2]['color']?></li>
							<? endforeach; ?>
						</ul>
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div> <!-- end main_information div -->
		<p><a href="/users/login">Login</a> to add products</p>
	</div><!-- end col-2-sub3 -->	
</div><!-- end col-wrapper -->
				