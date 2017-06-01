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
				$commentaire = htmlspecialchars($_POST['commentaire']);
				$article = $_GET['id'];

				//On créé un new objet $comment avec les valeurs ci dessus
				$comment = new Comment;
				$comment->setAuteur($pseudo);
				$comment->setCommentaire($commentaire);
				$comment->setArticle($article);

				//On ajoute le commentaire en bdd
				$objetCommentaire->add($comment);

				//On redirige le visiteur
				$this->redirect('index.php?page=show&message=successAjouterCommenaire&id=', $_GET['id']);	
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
					$commentaire = htmlspecialchars($_POST['commentaire']);

					//On récupère les valeurs passées en GET
					$article = $_GET['article'];
					$parent = $_GET['parent'];

					//On créé un nouvel objet $comment avec les valeurs ci-dessus
					$comment = new Comment;
					$comment->setAuteur($pseudo);
					$comment->setCommentaire($commentaire);
					$comment->setArticle($article);
					$comment->setParent($parent);

					//On ajoute la reponse au commentaire en bdd
					$objetCommentaire->addResponse($comment);
				}

			// On redirige le visiteur
			$this->redirect('index.php?page=show&id=', $_GET['article']);
				
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
			$signalement = $_GET['report'];

			//on ajoute 1 à son signelement;
			$signalement = $signalement + 1;

			//on met à jour la bdd
			$objetCommentaire->reportComment($id, $signalement);

			//on redirige le visiteur
			$this->redirect('index.php?page=show&id=', $_GET['idArticle']);
		}
	}






}