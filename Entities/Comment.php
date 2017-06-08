<?php

class Comment
{
	public $id;
	protected $idParent;
	protected $idArticle;
	protected $titre;
	protected $auteur;
	protected $contenu;
	protected $datePublication;
	protected $nbrSignalement;
	protected $reponses = [];

	public function isValid()
	{
		return !(empty($this->auteur) || empty($this->contenu));
	}

	


	// SETTERS //

	public function setId($id)
	{
		$this->id = (int) $id;
	}

	public function setIdParent($idParent)
	{
		$this->idParent = (int) $idParent;
	}

	public function setIdArticle($idArticle)
	{
		$this->idArticle = (int) $idArticle;
	}

	public function setTitre($titre)
	{
		$this->$titre = $titre;
	}
	

	public function setAuteur($auteur)
	{
		$this->auteur = $auteur;
	}

	public function setContenu($contenu)
	{
		$this->contenu = $contenu;
	}

	public function setDatePublication($datePublication)
	{
		$this->datePublication = $datePublication;
	}
	
	public function setNbrSignalement($nbrSignalement)
	{
		$this->nbrSignalement = $nbrSignalement;
	}

	public function setReponses(array $reponses)
	{
		$this->reponses = $reponses;
	}


	public function addReponse(Comment $reponse)
	{
		$this->reponses[] = $reponse; 
	}


	
	// GETTERS //

	public function id()
	{
		return $this->id;
	}

	public function idParent()
	{
		return $this->idParent;
	}

	public function idArticle()
	{
		return $this->idArticle;
	}

	public function titre()
	{
		return $this->titre;
	}

	public function auteur()
	{
		return $this->auteur;
	}

	public function contenu()
	{
		return $this->contenu;
	}

	public function datePublication()
	{
		$datePublication = new DateTime($this->datePublication);

		return $datePublication->format('d-m-Y à H:i:s');

		
	}
	
	public function nbrSignalement()
	{
		return $this->nbrSignalement;
	}

	public function reponses()
	{
		return $this->reponses;
	}

}

