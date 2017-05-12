<?php

class User
{
	protected $id;
	protected $pseudo;
	protected $password;

	
	//Méthode permettant de savoir si l'utilisateur est connecté
	public function userLogged()
	{
		if (!isset($_SESSION['user']))
		{
			$error = new Errors;
			$error->forbidden();
		}
	}

	// SETTERS //
	public function setId($id)
	{
		$this->id = (int) $id;
	}
	public function setPseudo($pseudo)
	{
		$this->pseudo = $pseudo;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}

	// GETTERS //
	public function id()
	{
		return $this->id;
	}
	public function pseudo()
	{
		return $this->pseudo;
	}
	public function password()
	{
		return $this->password;
	}
}
?>

