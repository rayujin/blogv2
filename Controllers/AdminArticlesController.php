<?php
class AdminArticlesController extends Controller
{
	
	// Affiche la liste des articles
	public function ListeArticlesAdmin()
	{
		// on récupère la liste des articles
		$db = PDOFactory::getMysqlConnexion();
		$objetArticle = new ArticlesManager($db);
		$listeArticles = $objetArticle->getListArticles();		

		// On require la vue 
		$this->render('gestionDesArticles', compact('listeArticles'));

		//Affichage des messages erreurs/succès
		$this->message();
	}

	public function affichageModifierArticle()
	{
		$db = PDOFactory::getMysqlConnexion();

		if(isset($_GET['id']))
		{
			//Affichage de l'article
			$objetArticle = new ArticlesManager($db);
			$article = $objetArticle->getUniqueArticle((int) $_GET['id']);

			//require de la vue
			$this->render('modifierArticle', compact('article'));
		}

		$this->message();
	}



	//Supprimer un article
	public function supprimerArticle()
	{
		$db = PDOFactory::getMysqlConnexion();
		$objetArticle = new ArticlesManager($db);

		if(isset($_POST['id']))
		{
			$objetArticle->deleteArticle($_POST['id']);
			
			//On redirige le visiteur
			$this->redirect('admin.php?page=gestionDesArticles&message=successSupprimerArticle');

		}


	}


	//Ajouter un article
	public function ajouterArticle()
	{
		$this->render('ajouterArticle');

		$db = PDOFactory::getMysqlConnexion();
		$objetArticle = new ArticlesManager($db);
		
		if(!empty($_POST['titre']) && !empty($_POST['contenu']))
		{
		
			$titre = htmlspecialchars($_POST['titre']);
			$contenu = $_POST['contenu'];
			
			
			$article = new Article;
			$article->setTitre($titre);
			$article->setContenu($contenu);

			$objetArticle->addArticle($article);

			$this->redirect('admin.php?page=gestionDesArticles&message=successAjouterArticle');
		}

	}



	//Modifier un article
	public function modifierArticle()
	{
		$db = PDOFactory::getMysqlConnexion();
		$objetArticle = new ArticlesManager($db);

		if(!empty($_POST['titre']) && !empty($_POST['contenu']))
		{
			$titre = htmlspecialchars(($_POST['titre']));
			$contenu = $_POST['contenu'];
			$id = $_GET['id'];

			$article = new Article;
			$article->setID($id);
			$article->setTitre($titre);
			$article->setContenu($contenu);

			$objetArticle->updateArticle($article);

			//On redirige l'admin
			$this->redirect('admin.php?page=gestionDesArticles&message=successModifArticle');
		}
		else
		{
			$this->redirect('admin.php?page=modifierArticle&id=' . $_GET['id'] . '&message=errorChampsIncorrect');
		}


	}


}