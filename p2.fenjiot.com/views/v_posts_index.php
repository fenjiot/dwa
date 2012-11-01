<? foreach($posts as $post): ?>

	<div>Posted on <?=TIME::display($post['modified'])?></div> <!-- check to see how we're going to get the correct modified / created timestamp -->
	<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
	<?=$post['content']?>
	
	<br><br>
	
<? endforeach; ?>
	