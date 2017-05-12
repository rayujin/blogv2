<?php


class Article
{
	protected $id;
	protected $titre;
	protected $contenu;
	protected $dateAjout;



	public function resume()
	{
		// soit l'article fait la taille d'un résumé
		if (strlen($this->contenu()) <= 500)
		{
			return  $this->contenu();
		}
		// sinon il est plus grand alors il faut le couper
		else
		{
			return substr($this->contenu(), 0, 500) . " ...";
		}
	}

	// SETTERS //
	public function setID($id)
	{
		$this->id = (int) $id;
	}

	public function setTitre($titre)
	{
		$this->titre = $titre;
	}

	public function setContenu($contenu)
	{
		$this->contenu = $contenu;
	}

	public function setDateAjout($dateAjout)
	{
		$this->dateAjout = $dateAjout;
	}



	// GETTERS //
	public function id()
	{
		return $this->id;
	}

	public function titre()
	{
		return $this->titre;
	}

	public function contenu()
	{
		return $this->contenu;
	}

	public function dateAjout()
	{
		$dateAjout = new DateTime($this->dateAjout);

		return $dateAjout->format('d-m-Y');
	}


}
