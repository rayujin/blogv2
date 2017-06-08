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

			$this->redirect('admin.php?page=gestionDesCommentaires');
		}
		

	}


}