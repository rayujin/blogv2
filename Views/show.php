<div class="container">
	<p>
		<a href="http://localhost/blogv2/index.php?page=accueil">Liste des articles</a>
	</p>

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

	<!-- 1er niveau de commentaire (commentaires principaux) -->
	<?php foreach ($firstLevelComments as $comment) : ?>
			<div class="primaryComment">
				<p class="primaryCommentHeader">
					<span class="commentAutor"><?= $comment->auteur() ?> </span>
					<em>
						<?= $comment->datePubli() ?>
					</em>
				</p>
				
				<p>
					<?= $comment->commentaire() ?>

					<span class="commentOption">						
						<!-- Signaler un commentaire -->		
						<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$comment->id()?>&report=<?=$comment->signalement()?>">Signaler</a>

						<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$comment->id()?>">Repondre</button>
					</span>


				</p>
			


				<!--Répondre à un commentaire -->
				<div id="<?=$comment->id()?>" class="collapse">
					
					<form class="form"  action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$comment->id()?>" method="post">
						<div class="form-group">
							<label for="pseudo">Pseudo</label>
							<input type="text" name="pseudo" />
						</div>
						<div class="form-group">
							<label for="commentaire">Commentaire</label>
							<textarea name="commentaire" rows="1" cols=""></textarea>
						</div>
							<input class="btn btn-primary" type="submit" value='repondre'/>
					</form>
				</div>
			</div>



		<!-- 2ème niveau de commentaire (réponses aux commentaires principaux) -->

		<?php foreach($secondLevelComments as $firstResponse) : ?>
			<?php if ($firstResponse->parent() === $comment->id()) : ?>
				<div class="firstResponse">
					<p class="firstResponseHeader">
						<span class="commentAutor"> <?= $firstResponse->auteur() ?> </span>
						<em>
							<?= $firstResponse->datePubli() ?>
						</em>
					</p>

					<p>
						<?= $firstResponse->commentaire() ?>

						<!--Signaler un commentaire -->
						<span class="commentOption">
							<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$firstResponse->id()?>&report=<?=$firstResponse->signalement()?>">Signaler</a>
							
							<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$firstResponse->id()?>">repondre</button>
						</span>

					</p>


					<!--Répondre à un commentaire -->
					<div id="<?=$firstResponse->id()?>" class="collapse">
						<form class="form" action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$firstResponse->id()?>" method="post">
							<div class="form-group">
								<label for="pseudo">Pseudo</label>
								<input type="text" name="pseudo" />
							</div>
							<div class="form-group">
								<label for="commentaire">Commentaire</label>
								<textarea name="commentaire" rows="1" cols=""></textarea>
							</div>
								<input class="btn btn-primary" type="submit" value='repondre'/>
						</form>
					</div>
				</div>



				<!-- 3ème niveau de commentaire -->
				<?php foreach($thirdLevelComments as $secondResponse) : ?>
					<?php if ($secondResponse->parent() === $firstResponse->id()) : ?>
						<div class="secondResponse">
							<p class="secondResponseHeader">
							<span class="commentAutor"><?= $secondResponse->auteur() ?> </span>
								<em>
									<?= $secondResponse->datePubli() ?>
								</em>
							</p>

							<p>
								<?= $secondResponse->commentaire() ?>

								<!--Signaler un commentaire -->
								<span class="commentOption">
									<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$secondResponse->id()?>&report=<?=$secondResponse->signalement()?>">Signaler</a>

									<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#<?=$secondResponse->id()?>">repondre</button>
								</span>
							</p>


							<!--Répondre à un commentaire -->
							<div id="<?=$secondResponse->id()?>" class="collapse">
								<form class="form"   action="http://localhost/blogv2/index.php?page=addResponse&article=<?=$article->id()?>&parent=<?=$secondResponse->id()?>" method="post">
									<div class="form-group">
										<label for="pseudo">Pseudo</label>
										<input type="text" name="pseudo" />
									</div>
									<div class="form-group">
										<label for="commentaire">Commentaire</label>
										<textarea name="commentaire" rows="1" cols=""></textarea>
									</div>
										<input class="btn btn-primary" type="submit" value='repondre'/>
								</form>
							</div>
						</div>


						<!-- 4ème niveau de commentaire -->
						<?php foreach($fourthLevelComments as $thirdResponse) : ?>
							<?php if($thirdResponse->parent() === $secondResponse->id()) : ?>
								<div class="thirdResponse">
									<p class="thirdResponseHeader">
										<span class="commentAutor"><?= $thirdResponse->auteur()?> </span>
										<em>
											<?= $thirdResponse->datePubli() ?>
										</em>
									</p>

									<p >
										<?= $thirdResponse->commentaire() ?>

										<!--Signaler un commentaire -->
										<span class="commentOption">
											<a class="btn btn-primary" href="index.php?page=reportComment&idArticle=<?=$article->id()?>&id=<?=$thirdResponse->id()?>&report=<?=$thirdResponse->signalement()?>">Signaler</a>
										</span>
									</p>
							


								</div>


							<?php endif ?>
						<?php endforeach ?>
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>	
		<?php endforeach ?>
	<?php endforeach ?>




	<!-- Ajouter un commentaire -->
	<h2>Ajouter un commentaire</h2>

	<form class="form-horizontal" action="http://localhost/blog1/index.php?page=addComment&id=<?=$_GET['id']?>" method="post">
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

</div>




