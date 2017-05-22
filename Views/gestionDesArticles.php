<div class="container">
	<h1>Gestion des articles</h1>
	<table class="table">
		<tr>
			<th>Titre</th>
			<th>Date de Publication</th>
			<th>Modifier l'article</th>
			<th>Supprimmer l'article</th>
		</tr>

		<?php foreach ($listeArticles as $articles) : ?>
		<tr>
			<td>
				<a href="/blogv2/index.php?page=show&id=<?=$articles->id()?>">
					 <?= $articles->titre() ?> 
				</a>
			</td>
			<td> <?= $articles->dateAjout() ?> </td>
			<td>
				<a href="/blogv2/admin.php?page=modifierArticle&id=<?=$articles->id()?>" class="btn btn-primary">modifier</a>
			</td>
			<td>
				<form action="http://localhost/blogv2/admin.php?page=deleteArticle" method="post">
					<input type="hidden" name="id" value="<?= $articles->id()?>"/>
					<button type="submit">Supprimer</button>
				</form>
			</td>
		</tr>

	<?php endforeach ?>

	</table>
</div>











