<?php

class ArticlesController extends Controller
{
	// Affiche la liste des articles
	public function executeAccueil()
	{
		// on récupère la liste des articles
		$db = PDOFactory::getMysqlConnexion();
		$objetArticle = new ArticlesManager($db);
		$listeArticles = $objetArticle->getListArticles();		

		// On require la vue 
		$this->render('accueil', compact('listeArticles'));
	}



	//Affiche l'article et ses commentaires 
	public function executeShow()
	{

		$db = PDOFactory::getMysqlConnexion();

		if(isset($_GET['id']))
		{
			//Récupération de l'article
			$objetArticle = new ArticlesManager($db);
			$article = $objetArticle->getUniqueArticle((int) $_GET['id']);

			//Récupération des commentaires
			$objetCommentaire = new CommentsManager($db);
			$listeComments = $objetCommentaire->getListComments($_GET['id']);





			//Autre méthode pour trier les commentaires
			
			$comments = []; //Liste des commentaires principaux
			$commentaireParId = []; // liste des commentaires triés en fonction de leur id


			foreach($listeComments as $comment) 
			{
				//Liste des commentaires PRINCIPAUX  avec comme clés leur id

				if ($comment->parent() === NULL)
				{
					$comments[$comment->id()] = $comment;

				}

				//Liste de TOUS les  commentaires triés en fonction de leur id
				$commentaireParId[$comment->id()] = $comment;


			}

			
			foreach($listeComments as $reponse)
			{
				
				if($reponse->parent() !== NULL)
				{
					$parent = $commentaireParId[$reponse->parent()];
					$parent->addReponse($reponse);
				}
			}

			var_dump($comments);
			var_dump($commentaireParId);
			//var_dump($parent);
			//var_dump($commentaireParId);
			die();
			
				

			/*

			//Trie des commenantaires avec foreach
			$firstLevelComments = [];
			$secondLevelComments = [];
			$thirdLevelComments = [];
			$fourthLevelComments = [];
			
			foreach($listeComments as $comment)
			{
				//Commentaire principaux (1er niveau)
				if($comment->parent() === NULL)
				{
					$firstLevelComments[] = $comment;	
				}

				// reponse aux commentaires principaux (2ème niveau)
				foreach($firstLevelComments as $firstComment)
				{
					if($comment->parent() === $firstComment->id())
					{
						$secondLevelComments[] = $comment;
					}
				}

				// reponse aux reponses des commentaires principaux (3ème niveau)
				foreach ($secondLevelComments as $secondComment)
				{
					if($comment->parent() === $secondComment->id())
					{
						$thirdLevelComments[] = $comment;
					}
				}

				// (4ème niveau)
				foreach ($thirdLevelComments as $thirdComment)
				{
					if($comment->parent() === $thirdComment->id())
					{
						$fourthLevelComments[] = $comment;
					}
				}

			}*/




			//Affichage de l'article et des commentaires
			$this->render('show', compact('article','comments','listeComments', 'firstLevelComments', 'secondLevelComments', 'thirdLevelComments', 'fourthLevelComments'));	
			
		}
	}















}








