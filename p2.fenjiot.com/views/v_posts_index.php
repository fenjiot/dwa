<? if($posts == array ()): ?>
	
 	<h2>You're not following anyone.&nbsp Nothing to see here.</h2>
 	<a href="/posts/users/">Follow someone</a>

<? else: ?>
	
	<? foreach($posts as $post): ?>
	
<?=$post['first_name']?> <!-- line of debug code -->
		<div class="infotext">Posted on <!--<?=TIME::display($post['modified'])?>--></div>
		<h2><?=$post['first_name']?> <?=$post['last_name']?> posted:</h2>
		<?=$post['content']?>
		
		<br><br>
		
	<? endforeach; ?>
	
	<h4>I'm outside the foreach loop!</h4>
	
<? endif; ?>

<h4>I'm outside the if else loop!</h4>