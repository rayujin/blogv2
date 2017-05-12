
<?php 
session_start();

// Inclusion de l'autoloader
require ('C:\wamp64\www\blogv2\Includes\autoload.php');

//On vérifie si l'utilisateur est bien connecté
$user = new User;
$user->userLogged();


if(!isset($_GET['page']))
{
	header("Location: http://localhost/blogv2/admin.php?page=accueilAdmin");
	die();
}
else
{
	$page = $_GET['page'];
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administration</title>
        <meta charset="utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style-child.css" rel="stylesheet">
        <script src="//cloud.tinymce.com/stable/tinymce.min.js"></script>
	  	<script>tinymce.init({ selector:'textarea' });</script>
    </head>
    
    <body>

	<!--On require le header -->
	<?php require ('C:\wamp64\www\blogv2\Includes\header.php') ?>



	<?php
	//Génération de page accueil de l'administration
	if ($page === "accueilAdmin")
	{
		$controller = new AdminController;
		$controller->executeAdmin();
	}



	//Génération de la page de gestion des articles
	if ($page === "gestionDesArticles")
	{
		$controller = new AdminArticlesController;
		$controller->ListeArticlesAdmin();	
	}

	//Supression d'un article
	if ($page === "deleteArticle")
	{
		$controller = new AdminArticlesController;
		$controller->supprimerArticle();

	}



	//Génération de la page pour modifier un article
	if($page === "modifierArticle")
	{
		$controller = new AdminArticlesController;
		$controller->affichageModifierArticle();	
	}



	//Mise à jour de la BDD
	if($page === "updateArticle")
	{
		$controller = new AdminArticlesController;
		$controller->modifierArticle();
	}




	//Génération de la page pour ajouter un article
	if ($page === "ajouterUnArticle")
	{
		$controller = new AdminArticlesController;
		$controller->ajouterArticle();
	}



	//Gération de la page de gestion des commentaires
	if($page === "gestionDesCommentaires")
	{
		$controller = new AdminCommentsController;
		$controller->affichageCommentairesAdmin();
	}



	//Suppresion d'un commentaire
	if($page === "deleteComment")
	{
		$controller = new AdminCommentsController;
		$controller->supprimerCommentaire();

	}

	?>

	<!--On require le footer -->
	<?php require ('C:\wamp64\www\blogv2\Includes\footerAdmin.php') ?>
  
	</body>
</html>







