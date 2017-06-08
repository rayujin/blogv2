<div class="container">
	<h1>Gestion des commentaires</h1>

	<!-- Tableau des commentaires signalés -->
	<h2>Liste des commentaires signalés</h2>
	<table class=" table table-hover"  >
		<tr>
			<th>Article</th>
			<th>Auteur</th>
			<th>Contenu</th>
			<th>Date de publication</th>
			<th>Nombre de signalement</th>
			<th>Supprimmer le commentaire</th>
		</tr>

		<?php foreach ($listeCommentsReported as $comment) : ?>
		<tr>
			<td>
				<?= $comment->titre() ?>
			</td>
			<td>
				<?= $comment->auteur() ?>
			</td>
			<td>
				<?= $comment->contenu() ?>
			</td>
			<td>
				<?= $comment->datePublication() ?>
			</td>
			<td>
				<?= $comment->nbrSignalement() ?>
				
			</td>
			<td>
				<form action="http://localhost/blogv2/admin.php?page=deleteComment" method="post">
					<input type="hidden" name="id" value="<?= $comment->id()?>"/>
					<button type="submit" class="btn btn-danger">Supprimer</button>
				</form>
			</td>
		</tr>

		<?php endforeach ?>

	</table>




	<!-- Tableau des commentaires -->
	<h2>Liste des commentaires</h2>
	<table class="table table-hover">
		<tr>
			<th>Article</th>
			<th>Auteur</th>
			<th>Contenu</th>
			<th>Date de publication</th>
			<th>Supprimmer le commentaire</th>
		</tr>

		<?php foreach ($listeComments as $comment) : ?>
		<tr>
			<td>
				<?= $comment->titre() ?>
			</td>
			<td>
				<?= $comment->auteur() ?>
			</td>
			<td>
				<?= $comment->contenu() ?>
			</td>
			<td>
				<?= $comment->datePublication() ?>
			</td>
			<td>
				<form action="http://localhost/blogv2/admin.php?page=deleteComment" method="post">
					<input type="hidden" name="id" value="<?= $comment->id()?>"/>
					<button type="submit" class="btn btn-danger">Supprimer</button>
				</form>
			</td>
		</tr>

		<?php endforeach ?>

	</table>














