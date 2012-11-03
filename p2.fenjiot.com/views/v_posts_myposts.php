<form method='POST' action='/posts/edit'>

<? foreach($posts as $post): ?>
		<div class="posts">
			<div class="infotext">Posted on <?=Time::display($post['modified'])?></div>
			<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
			<?=$post['content']?>
			
			<br><br>
			<div class="minor">Edit:</div>
			
			<input type="hidden" name="post_id" value="<?=$post['post_id']?>">
			<textarea rows="10" cols="50" name='content' placeholder="text area is expandible"></textarea>
			<br>
			
			<input type='submit'>	
					
			<br><br>
		</div>

		
<? endforeach; ?>

</form>