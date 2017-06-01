<?php

class AdminController extends Controller
{
	public function executeAdmin()
	{
		$this->render('accueilAdmin');

		//Gestion des messages erreurs\succès
		$this->message();
	}
}