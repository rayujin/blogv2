<div class="container">
	<h1>Modifier un article</h1>
	
	<form action="http://localhost/blogv2/admin.php?page=updateArticle&id=<?=$_GET['id']?>" method="post">
		<label for="titre">Titre de l'article</label>
		<input type="text" name="titre" value="<?= $article->titre()?>"/>
		<textarea name="contenu"><?= $article->contenu()?></textarea>
		<input type="submit" value="Modifier" class="btn btn-primary"/>
	</form>
</div>