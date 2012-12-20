<div class="col-wrapper">
	
	<div class="col-2-sub1">
		<div class="subnav">
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
			<? else: ?>
				<? foreach($products as $product): ?>
					<div class="products tiled">
						<img src="<?=$product['thumb_path']?>">
					</div>
				<? endforeach; ?>
			<? endif; ?>
		</div> <!-- end main_information div -->
	</div><!-- end col-2-sub3 -->	
</div><!-- end col-wrapper -->	
				