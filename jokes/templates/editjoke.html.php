<form action="" method="post">
		<input type="hidden" name="joke[id]" value="<?=$joke->id ?? ''?>" />
		<label for="joketext">Type your joke here:</label>		
		<textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?=$joke->joketext ?? ''?></textarea>
		<input type="hidden" name="joke[authorID]" value="<?=$_SESSION['loggedin'] ?? ''?>" />
		<label>Joke Category</label>
		<select name="category">
		<?php
			foreach($category->getCategory() as $jokeCategory){ ?>
				<option value="<?=$jokeCategory->id?>"><?=$jokeCategory->name?></option>;
		<?php } ?>
		</select>
		<input type="submit" value="Add">
</form>