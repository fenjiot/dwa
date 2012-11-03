<? if($posts == array ()): ?>
	
 	<h2>You're not following anyone.&nbsp Nothing to see here.</h2>
 	<a href="/posts/users/">Follow someone</a>

<? else: ?>

	<? foreach($posts as $post): ?>
		<div class="posts">
			<h2><?=$post['first_name']?> <?=$post['last_name']?> says:</h2>
			<div class="postedtext"><?=$post['content']?></div>
			<div class="smallwords">Posted on <?=Time::display($post['modified'])?></div>
			
			<br><br>
		</div>
	<? endforeach; ?>
	
<? endif; ?>