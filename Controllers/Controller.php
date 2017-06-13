<?php

class Controller
{
	// chemin où se trouve la vue à afficher
	protected $viewPath = 'C:\wamp64\www\blogv2\Views\\' ;
	// chemin où se trouve la page à afficher
	protected $redirectionPath = 'http://localhost/blogv2/';
	// chemin où se trouve le message à afficher
	protected $messagePath = 'C:\wamp64\www\blogv2\Views\Messages\\';



	// Méthode permettant le require de la view par le controller
	public function render($view, $variables = NULL)

	{
		if($variables != NULL)
		{
			extract($variables);	
		}
		
		require($this->viewPath . $view . '.php');
		
	}



	//Méthode permettant de faire la redirection
	public function redirect($redirection, $id = NULL)
	{
		header('Location: ' . $redirectionPath . $redirection . $id);
	}



	//Méthode permettant d'afficher les messages d'erreurs ou de succès
	public function message()
	{
		if (isset($_GET['message']))
		{
			$message = $_GET['message'];

			require ($this->messagePath . $message . '.php');
		}
	}
}