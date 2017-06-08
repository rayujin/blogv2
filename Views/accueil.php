<div class="container">
	
	<!-- PRESENTATION DE L'AUTEUR -->
	<div class="img_profil" style="margin-bottom: 10px">
		<img src="http://localhost/blogv2/Images/profil_resized.jpg" alt="image de profil" />
	</div>

	<div class="quiSuisJe">
		<h1>Qui suis-je ?</h1>
		<p> Bonjour je m'appelle <strong>Paul Roussel</strong> et vous êtes sur mon blog de voyage. J'ai fini mes études
			de journalisme il y a 3 mois. Avant de rentrer entièrement dans le vie active j'ai décidé de faire un road trip
			seul dans l'état américain de l'Alaska. J'ai décidé de faire ce voyage afin de me recentrer sur moi même, de 
			réfléchir sur ma place dans ce monde, toujours en mouvement. Mon voyage durera 2 mois. J'ai prévu d'essayer de faire
			ce voyage en grande partie en stop et de loger chez les locaux. Vous trouverez dans ce blog mons carnet de voyage
			que j'écrirai sous forme de roman. Un chapitre sera publié chaque semaine. Ce roman sera un mélange de fiction et
			de réalité sur mon voyage, mes pensées, mon ressentie. 
			Je vous souhaite une très bonne lecture de ce blog, n'hésitez pas à commenter les chapitres afin de me donner
			vos retours.<br/> 
			Amicalement vôtre, Paul Roussel.
		</p>
	</div>








	<!-- LISTE DES ARTICLES -->
	<?php foreach ($listeArticles as $articles) : ?>		
		<div class="accueilArticle">
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

</div>
