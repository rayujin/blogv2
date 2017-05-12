<?php

class UsersManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	// Methode permettant de verifier si l'utilisateur existe
	public function exist($pseudo, $password)
	{
		$requete = $this->db->prepare('SELECT pseudo, password FROM users WHERE pseudo = :pseudo AND password = :password ');
		$requete->bindValue(':pseudo', $pseudo);
		$requete->bindValue(':password', $password);

		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'User');
		$userVerif = $requete->FetchALL();

		return $userVerif;

	}


}