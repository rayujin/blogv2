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



			//Trie des commentaires
			
			$comments = []; //Liste des commentaires principaux
			$commentaireParId = []; // liste des commentaires triés en fonction de leur id


			foreach($listeComments as $comment) 
			{
				//Liste des commentaires PRINCIPAUX  avec comme clés leur id

				if ($comment->idParent() === NULL)
				{
					$comments[$comment->id()] = $comment;

				}

				//Liste de TOUS les  commentaires triés en fonction de leur id
				$commentaireParId[$comment->id()] = $comment;
			}

			foreach($listeComments as $reponse)
			{
				
				if($reponse->idParent() !== NULL)
				{
					$parent = $commentaireParId[$reponse->idParent()];
					$parent->addReponse($reponse);
				}
			}

			var_dump($comments);
			//Affichage de la vue associé
			$this->render('show', compact('article','comments'));	
			
					
		}


		//Gestion des messages erreurs\succès
		$this->message();


	}
}








