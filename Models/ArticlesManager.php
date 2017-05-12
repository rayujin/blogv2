<?php
class ArticlesManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	//methode permettant de récupérer la liste des articles
	public function getListArticles()
	{
		$requete = $this->db->query('SELECT * FROM articles ORDER BY id DESC');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

		$listeArticles = $requete->fetchALL();

		return $listeArticles;


	}

	//methode retournant un article précis
	public function getUniqueArticle($id)
	{
		$requete = $this->db->prepare('SELECT * FROM articles WHERE id = :id');
		$requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$requete->execute();

		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Article');

		$article = $requete->fetch();

		return $article;
	}

	//Méthode permettant de modifier un article
	public function updateArticle(Article $article)
	{
		$requete = $this->db->prepare('UPDATE articles SET id = :id, titre = :titre, contenu = :contenu WHERE id = :id');
		$requete->bindValue(':id', $article->id());
		$requete->bindValue(':titre', $article->titre());
		$requete->bindValue(':contenu', $article->contenu());
		$requete->execute();
	}

	//Méthode permettant de supprimer un article
	public function deleteArticle($id)
	{
		 $requete = $this->db->prepare('DELETE FROM articles WHERE id = :id');
		 $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		 $requete->execute();	
	}

	//Méthode permettant d'ajouter un article
	public function addArticle(Article $article)
	{
		$requete = $this->db->prepare('INSERT INTO articles SET titre = :titre, contenu = :contenu, dateAjout = NOW() ');
		$requete->bindValue(':titre', $article->titre());
		$requete->bindValue(':contenu', $article->contenu());
		$requete->execute();
	}
}

