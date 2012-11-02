<? if($posts == array ()): ?>
	
 	<h2>You're not following anyone.&nbsp Nothing to see here.</h2>
 	<a href="/posts/users/">Follow someone</a>

<? else: ?>
	
	<? foreach($posts as $post): ?>
	
		<div class="infotext">Posted on <?=Time::display($post['post.modified'])?></div>
		<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
		<?=$post['content']?>
		
		<br><br>
		
<? print_r($post) ?> <!-- FOR TESTING ONLY WANT TO TRIM DOWN INFORMATION PASSED INTO VIEW FROM $posts -->
		
	<? endforeach; ?>
	
<? endif; ?>