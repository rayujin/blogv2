<?php
class CommentsManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	//Methode retournant la liste des commentaires de l'article X
	public function getListComments($article)
	{
		
		$requete = $this->db->prepare('SELECT * FROM comments WHERE article = :article ORDER BY id ');
		$requete->bindValue(':article', $article, PDO::PARAM_INT);
		$requete->execute();
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

		$listeComments = $requete->fetchALL();

		$requete->closeCursor();

	
		return $listeComments;

	}


	//Methode retournant la liste des commentaires trié par article
	public function getListCommentsByArticle()
	{
		$requete = $this->db->query(
			'SELECT comments.id, comments.auteur, comments.commentaire, comments.datePubli, articles.titre 
			FROM comments 
			INNER JOIN articles 
			ON comments.article = articles.id 
			ORDER BY comments.article');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

		$listeComments = $requete->fetchALL();

		return $listeComments;
	}

	//Méthode permettant de récupérer la liste des commentaires signalés
	public function getListCommentsReported()
	{
		$requete = $this->db->query(
			'SELECT comments.id, comments.auteur, comments.commentaire, comments.datePubli, comments.signalement, articles.titre 
			FROM comments 
			INNER JOIN articles 
			ON comments.article = articles.id 
			WHERE comments.signalement > 0 
			ORDER BY comments.signalement 
			DESC');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

		$listeCommentsReported = $requete->fetchALL();

		return $listeCommentsReported;
	}



	//Méthode permettant d'ajouter un commentaire
	public function add(Comment $comment)
	{
		
		$requete = $this->db->prepare('INSERT INTO comments SET  article = :article, auteur = :pseudo, commentaire = :commentaire, datePubli = NOW(), signalement = 0');
		$requete->bindValue(':article', $comment->article());
		$requete->bindValue(':pseudo', $comment->auteur());
		$requete->bindValue(':commentaire', $comment->commentaire());

		$requete->execute();	
	}

	//Methode permettant de repondre à un commentaire
	public function addResponse(Comment $comment)
	{
		$requete = $this->db->prepare('INSERT INTO comments SET parent = :parent, article = :article, auteur = :pseudo, commentaire = :commentaire, datePubli = NOW(), signalement = 0');
		$requete->bindValue(':parent', $comment->parent());
		$requete->bindValue(':article', $comment->article());
		$requete->bindValue(':pseudo', $comment->auteur());
		$requete->bindValue(':commentaire', $comment->commentaire());

		$requete->execute();
	}

	//Méthode permmant de supprimmer un commentaire
	public function deleteComment($id)
	{
		$requete = $this->db->prepare('DELETE FROM comments WHERE id = :id');
		$requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
		$requete->execute();
	}


	//Méthode permettant de signaler un commentaire
	public function reportComment($id, $signalement)
	{
		$requete = $this->db->prepare('UPDATE comments SET signalement = :signalement WHERE id = :id');
		$requete->bindValue(':id', $id);
		$requete->bindValue(':signalement', $signalement);
		$requete->execute();
	}

}