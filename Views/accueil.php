	<!-- LISTE DES ARTICLES -->
	<?php foreach ($listeArticles as $articles) : ?>
		<div class="container">
		<h2>
			<a href="index.php?page=show&id=<?= $articles->id() ?>">
				<?= $articles->titre() ?>
			</a>
			<small>
				<?= $articles->dateAjout() ?>
			</small>
		</h2>

		<p>
			<?= $articles->resume() ?>
		</p>
		</div>

	<?php endforeach ?>
