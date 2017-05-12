<?php 
session_start();

// Inclusion de l'autoloader
require ('C:\wamp64\www\blogv2\Includes\autoload.php');



if(!isset($_GET['page']))
{
	header("Location: http://localhost/blogv2/index.php?page=accueil");
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
        <title>Index</title>
        <meta charset="utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style-child.css" rel="stylesheet">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>

    	<!-- Require du header -->
    	<?php require ('C:\wamp64\www\blogv2\Includes\header.php') ?>

		<?php
		// Gébération de la page d'accueil
		if ($page === "accueil")
		{
			$controller = new ArticlesController;
			$controller->executeAccueil();
		}



		// Générattion de la page article unique
		if ($page === "show")
		{
			//Affichage de l'article et de ses commentaires
			$controllerArticle = new ArticlesController();
			$controllerArticle->executeShow();	
		}

		//Ajouter un commentaire
		if ($page === "addComment")
		{
			$controllerCommentaire = new CommentsController();
			$controllerCommentaire->ajouterCommentaire();	
		}

		//ajouter une réponse à un commentaire
		if ($page === "addResponse")
		{
			$controllerCommentaire = new CommentsController();
			$controllerCommentaire->repondre();
		}


		//Signaler un commentaire
		if ($page === "reportComment")
		{
			$controllerCommentaire = new CommentsController();
			$controllerCommentaire->signalerCommentaire();
		}


		 // Génération de la page de connexion au panel d'administration
		if ($page === "connexion")
		{
			$controllerUser = new UsersController;
			$controllerUser->connexionAdmin();
		}

		?>

		<!-- Require du footer -->
		<?php require ('C:\wamp64\www\blogv2\Includes\footer.php') ?>
		 	
    </body>
 </html>


