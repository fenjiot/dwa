<form method='POST' action='/posts/edit'>

<? foreach($posts as $post): ?>
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

		
<? endforeach; ?>

</form>