<? if($posts == array ()):?>
	
 	<h2>You're not following anyone.&nbsp Nothing to see here.</h2>
 	<a href="/posts/users/">Follow someone</a>

<? else: ?>
	
	<? foreach($posts as $post): ?>
	
		<div class="infotext"><p>Posted on TIME<!--<?=TIME::display($post['modified'])?>-->TIME</p></div>
		<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
		<?=$post['content']?>
		
		<br><br>
		
	<? endforeach; ?>
	
<? endif; ?>