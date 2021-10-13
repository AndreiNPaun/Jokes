<?php
foreach($jokes as $joke) { ?>
<blockquote>
<p>
	<?=$joke->joketext?> 
	
	<em>Posted by: <?=$joke->getAuthor()->username?></em>
<?php
	if (isset($_SESSION['loggedin'])){?>
		<a href="/joke/edit?id=<?=$joke->id?>">edit</a>

		<form action="/joke/delete" method="POST">
			<input type="hidden" name="id" value="<?=$joke->id?>" />
			<input type="submit" value="Delete" />
		</form>

<?php } ?>

</p>
</blockquote>
<?php } ?>
