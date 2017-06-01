<div class="container">

	<!-- Affichage de l'article -->
	<h2>
		<?= $article->titre() ?>
	</h2>

	<em> <?= $article->dateAjout()?></em>
	<p>
		<?= nl2br($article->contenu()) ?>
	</p>



	<!-- Affichage des commentaires -->
	<h1>Liste des commmentaires :</h1>


		<!-- Commentaires principaux -->
		<?php foreach ($comments as $comment) : ?>
	
			<div class="primaryComment">
				
				<div class="primaryCommentHeader" style="margin-top: 10px">
					<strong class="commentAutor">
						<?= $comment->auteur() ?>
					</strong> 

					<em>
						<?= $comment->datePubli() ?>
					</em>
				</div>

				<div>
					<?= $comment->commentaire() ?>
				
			

					<!-- Option de commentaire (signaler, repondre) -->
					<span class="commentOption">

						<!-- Bouton pour afficher le formulaire pour répondre à un commentaire -->
						<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$comment->id()?>">Repondre</button>
						<!--Signaler un commentaire -->
						<a class="btn btn-primary" 
						   href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$comment->id()?>&report=<?=$comment->signalement()?>">Signaler
						</a>

					</span>

				</div>

					<!--Formulaire pour répondre à un commentaire -->
					<div id="<?=$comment->id()?>" class="collapse">
						
						<form class="form"  action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$comment->id()?>" method="post">
						<?php require ('C:\wamp64\www\blogv2\Includes\formRepondreCommentaire.php') ?>
			</div>




			<!-- Réponses aux commentaires principaux (1er niveaux) -->
			<?php foreach ($comment->reponses() as $PremierNiveauDeReponse) : ?>

				<div class="firstResponse">
					<div class="firstResponseHeader">
						<strong>
							<?= $PremierNiveauDeReponse->auteur()?>
						</strong>
						
						<em>
							<?= $PremierNiveauDeReponse->datePubli() ?>
						</em>

					</div>

					<div>
						<?= $PremierNiveauDeReponse->commentaire() ?>
					


						<!--Option de commentaire (signaler, répondre) -->
						<span class="commentOption">
							<!-- Bouton pour afficher le formulaire pour répondre à un commentaire --> 
							<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$PremierNiveauDeReponse->id()?>">repondre</button>

							<!--Signaler un commentaire -->
							<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$PremierNiveauDeReponse->id()?>&report=<?=$PremierNiveauDeReponse->signalement()?>">Signaler</a>
							
						</span>

					</div>

					<!--Formulaire pour répondre à un commentaire -->
					<div id="<?=$PremierNiveauDeReponse->id()?>" class="collapse">
						<form class="form" action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$PremierNiveauDeReponse->id()?>" method="post">
						<?php require ('C:\wamp64\www\blogv2\Includes\formRepondreCommentaire.php') ?>
				</div>


				<!-- Réponses aux réponses des commentaires principaux (2ème niveau) -->
				<?php foreach ($PremierNiveauDeReponse->reponses() as $DeuxiemeNiveauDeReponse) : ?>
					<div class="secondResponse">
						<div class="secondResponseHeader">
							<strong>
								<?= $DeuxiemeNiveauDeReponse->auteur() ?>
							</strong>

							<em>
								<?= $DeuxiemeNiveauDeReponse->datePubli() ?>
							</em>

						</div>

						<div>
							<?= $DeuxiemeNiveauDeReponse->commentaire() ?>
						

							<!--Option de commentaire -->
							<span class="commentOption">
								<!-- Bouton pour afficher le formulaire pour répondre à un commentaire -->
								<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$DeuxiemeNiveauDeReponse->id()?>">repondre</button>

								<!--Signaler un commentaire -->
								<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$DeuxiemeNiveauDeReponse->id()?>&report=<?=$DeuxiemeNiveauDeReponse->signalement()?>">Signaler</a>
							</span>
						</div>

						<!--Formulaire pour répondre à un commentaire -->
						<div id="<?=$DeuxiemeNiveauDeReponse->id()?>" class="collapse">
							<form class="form" action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$DeuxiemeNiveauDeReponse->id()?>" method="post">
							<?php require ('C:\wamp64\www\blogv2\Includes\formRepondreCommentaire.php') ?>
					</div>	


				<!-- Troisième niveau de réponse -->
					<?php foreach ($DeuxiemeNiveauDeReponse->reponses() as $TroisiemeNiveauDeReponse) : ?>
						<div class="thirdResponse">
							<div class="thirdResponseHeader">
								<strong>
									<?= $TroisiemeNiveauDeReponse->auteur() ?>
								</strong>
								
								<em>
									<?= $TroisiemeNiveauDeReponse->datePubli() ?>
								</em>

							</div>

							<div>
								<?= $TroisiemeNiveauDeReponse->commentaire() ?>
							

								<!-- Option de commentaire -->
								<span class="commentOption">
									<!--Signaler un commentaire -->
									<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$TroisiemeNiveauDeReponse->id()?>&report=<?=$TroisiemeNiveauDeReponse->signalement()?>">Signaler</a>

								</span>
							</div>
						</div>
					<?php endforeach ?>
				<?php endforeach ?>
			<?php endforeach ?>
		<?php endforeach ?>



	<!-- Ajouter un commentaire -->
	<h2>Ajouter un commentaire</h2>

	<form class="form-horizontal" action="http://localhost/blogv2/index.php?page=addComment&id=<?=$_GET['id']?>" method="post">
		<div class="form-group">
			<label class="col-sm-1 control-label" for="pseudo">Pseudo</label>
			<div class="col-sm-10">
				<input class="form-control" type="text" name="pseudo" />
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-1 control-label" for="commentaire">Commentaire</label>
			<div class="col-sm-10">
				<textarea class="form-control" name="commentaire"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-10">
				<input class="btn btn-default" type="submit" value='commenter'/>
			</div>
		</div>
	</form>


	<!-- Affichage des messages erreurs/succès -->

</div>




