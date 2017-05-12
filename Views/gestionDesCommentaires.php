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
				<?= $comment->commentaire() ?>
			</td>
			<td>
				<?= $comment->datePubli() ?>
			</td>
			<td>
				<?= $comment->signalement() ?>
				
			</td>
			<td>
				<form action="http://localhost/blog1/admin.php?page=deleteComment" method="post">
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
				<?= $comment->commentaire() ?>
			</td>
			<td>
				<?= $comment->datePubli() ?>
			</td>
			<td>
				<form action="http://localhost/blog1/admin.php?page=deleteComment" method="post">
					<input type="hidden" name="id" value="<?= $comment->id()?>"/>
					<button type="submit" class="btn btn-danger">Supprimer</button>
				</form>
			</td>
		</tr>

		<?php endforeach ?>

	</table>














