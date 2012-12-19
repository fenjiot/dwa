<? if(!$posts):?>

		<div class="mediumwords">You don't have any posts.</div>
		<br>
		
		<div class="words">How about adding one today?</div>
		<br>
		
		<?php include("views/v_posts_add.php"); ?>

<? else: ?>
	<? foreach($posts as $post): ?>
		<form name='new-post' method='POST' action='/posts/edit'>
			<div class="posts">
				<h2><?=$post['first_name']?> <?=$post['last_name']?> says:</h2>
				<div class="postedtext"><?=$post['content']?></div>
				<div class="smallwords">Posted on <?=Time::display($post['modified'])?></div>
				<br><br>
				<div class="mediumwords">Edit:</div>
				
				<input type="hidden" name="post_id" value="<?=$post['post_id']?>">
				<textarea rows="10" cols="50" name='content' placeholder="text area is expandible"></textarea>
				<br>
				
				<input type='submit'>	
						
				<br><br>
			</div>
		</form>
		<div id='results'></div>
	<? endforeach; ?>
<? endif; ?>