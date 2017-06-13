<?php
class AdminCommentsController extends Controller
{
	//Affichage des commentaires 
	public function affichageCommentairesAdmin()
	{
		$db = PDOFactory::getMysqlConnexion();
		$objetCommentaire = new CommentsManager($db);

		//Affichage de la liste des commentaires
		$listeComments = $objetCommentaire->getListCommentsByArticle();

		//Affichage de la liste des commentaires signalés
		$listeCommentsReported = $objetCommentaire->getListCommentsReported();


		//On require la vue
		$this->render('gestionDesCommentaires', compact('listeComments', 'listeCommentsReported'));

		//Affichage des messages erreurs/succes
		$this->message();
	}




	
	//Supprimer un commentaire
	public function supprimerCommentaire()
	{
		$db = PDOFactory::getMysqlConnexion();
		$objetCommentaire = new CommentsManager($db);

		if(isset($_POST['id']))
		{
			$objetCommentaire->deleteComment($_POST['id']);

		
			//Suppression des responses
			
			$listeComments = $objetCommentaire->getListCommentsByArticle();
			
			$response1;
			$reponse2;
			$reponse3;
			
			foreach ($listeComments as $reponse1) 
			{
				if($reponse1->idParent() === $_POST['id'])
				{
					$objetCommentaire->deleteComment($reponse1->id());

					foreach ($listeComments as $reponse2)
					{
						if($reponse2->idParent() === $reponse1->id())
						{
							$objetCommentaire->deleteComment($reponse2->id());
						}

						foreach ($listeComments as $reponse3)
						{
							if($reponse3->idParent() === $reponse2->id())
							{
								$objetCommentaire->deleteComment($reponse3->id());
							}
						}
					}
				}
			}

			$this->redirect('admin.php?page=gestionDesCommentaires');
		}
	}
}

