<?php

class UsersController extends Controller
{
	//Méthode permettant de se connecter au panel d'administration
	public function connexionAdmin()
	{
		// on require la vue representant le formulaire de connexion
		$this->render('connexion');

		// si l'utilisateur est déjà connecté on le redirige
		if(isset($_SESSION['user']))
		{
			header('Location: admin.php');
		}

		//sinon si il a entré un pseudo et un mot de passe valide on le connecte
		else
		{
			if (isset($_POST['pseudo']) && isset($_POST['password']))
			{
				$db = PDOFactory::getMysqlConnexion();
				$objetUser = new UsersManager($db);

				if(!empty($_POST))
				{
					$pseudo = htmlspecialchars($_POST['pseudo']);
					$password = htmlspecialchars($_POST['password']); 

					if($objetUser->exist($pseudo, $password))
					{
						//die('Connecte');
						$_SESSION['user'] = $pseudo; 
						header('Location: admin.php');
					}
					else
					{
						echo 'Identifiant incorrect';
					}
				}
			}
		}
	}		
}