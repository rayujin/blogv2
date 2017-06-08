<?php
class CommentsController extends Controller
{

	//Ajouter un commentaire
	public function ajouterCommentaire()
	{
		if ((isset($_POST['pseudo'])) && (isset($_POST['commentaire'])))
		{

			$db = PDOFactory::getMysqlConnexion();
			$objetCommentaire = new CommentsManager($db);

			if (!empty($_POST['pseudo']) && !empty($_POST['commentaire']))
			{
				//On récupère les valeurs passées en POST et l'id passée en GET
				$pseudo = htmlspecialchars($_POST['pseudo']);
				$contenu = htmlspecialchars($_POST['commentaire']);
				$idArticle = $_GET['id'];

				//On créé un new objet $comment avec les valeurs ci dessus
				$comment = new Comment;
				$comment->setAuteur($pseudo);
				$comment->setContenu($contenu);
				$comment->setIdArticle($idArticle);

				//On ajoute le commentaire en bdd
				$objetCommentaire->add($comment);

				//On redirige le visiteur
				$this->redirect('index.php?page=show&message=successAjouterCommentaire&id=', $_GET['id']);	
			}

			else
			{
				$this->redirect('index.php?page=show&message=errorChampsIncorrect&id=', $_GET['id']);	

			}


		}
	}

		//Répondre à un commentaire
		public function repondre()
		{
			if (isset($_POST['pseudo']) && isset($_POST['commentaire']))
			{
				$db = PDOFactory::getMysqlConnexion();
				$objetCommentaire = new CommentsManager($db);

				if (!empty($_POST['pseudo']) && !empty($_POST['commentaire']))
				{
					//On récupère les valeurs passées en POST
					$pseudo = htmlspecialchars($_POST['pseudo']);
					$contenu = htmlspecialchars($_POST['commentaire']);

					//On récupère les valeurs passées en GET
					$idArticle = $_GET['article'];
					$idParent = $_GET['idParent'];

					//On créé un nouvel objet $comment avec les valeurs ci-dessus
					$comment = new Comment;
					$comment->setAuteur($pseudo);
					$comment->setContenu($contenu);
					$comment->setIdArticle($idArticle);
					$comment->setIdParent($idParent);

					//On ajoute la reponse au commentaire en bdd
					$objetCommentaire->addResponse($comment);

					// On redirige le visiteur
					$this->redirect('index.php?page=show&message=successAjouterCommentaire&id=', $_GET['article']);
				}

			else
				{
					$this->redirect('index.php?page=show&message=errorChampsIncorrect&id=', $_GET['article']);	

				}


				
			}
		}


	//Signaler un commentaire
	public function signalerCommentaire()
	{
		if (isset($_GET['id']) && isset($_GET['report']))
		{
			$db = PDOFactory::getMysqlConnexion();
			$objetCommentaire = new CommentsManager($db);
			
			//on récupère l'id du commentaire et son nbr de signelement envoyé en GET
			$id = $_GET['id'];
			$nbrSignalement = $_GET['report'];

			//on ajoute 1 à son signelement;
			$nbrSignalement = $nbrSignalement + 1;

			//on met à jour la bdd
			$objetCommentaire->reportComment($id, $signalement);

			//on redirige le visiteur
			$this->redirect('index.php?page=show&message=successSignalerCommentaire&id=', $_GET['idArticle']);
		}

		else
			{
				$this->redirect('index.php?page=show&message=errorSignalerCommentaire&id=', $_GET['article']);	

			}
	}






}