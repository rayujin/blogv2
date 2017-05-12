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
			/*
			$comments = [];
			$reponses = [];
			$commentaireParId = [];

			foreach($listeComments as $comment) 
			{
				if ($comment->parent() === NULL)
				{
					$comments[] = $comment;

				}
				$commentaireParId[$comment->id()] = $comment;


			}


			foreach($listeComments as $reponse)
			{
				$parent = $commentaireParId[$reponse->parent()];

				if($reponse->parent() !== NULL)
				{
					$parent->setReponses($reponse);
				}
			}
			var_dump($comments);
			die();
			
				*/

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

			}




			//Affichage de l'article et des commentaires
			$this->render('show', compact('article','listeComments', 'firstLevelComments', 'secondLevelComments', 'thirdLevelComments', 'fourthLevelComments'));	
			
		}
	}















}








