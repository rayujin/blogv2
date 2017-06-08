<?php
class CommentsManager
{
	protected $db;

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	//Methode retournant la liste des commentaires de l'article X
	public function getListComments($idArticle)
	{
		
		$requete = $this->db->prepare('SELECT * FROM comments WHERE idArticle = :idArticle ORDER BY id ');
		$requete->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
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
			'SELECT comments.id, comments.auteur, comments.contenu, comments.datePublication, articles.titre 
			FROM comments 
			INNER JOIN articles 
			ON comments.idArticle = articles.id 
			ORDER BY comments.idArticle');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

		$listeComments = $requete->fetchALL();

		return $listeComments;
	}

	//Méthode permettant de récupérer la liste des commentaires signalés
	public function getListCommentsReported()
	{
		$requete = $this->db->query(
			'SELECT comments.id, comments.auteur, comments.contenu, comments.datePublication, comments.nbrSignalement, articles.titre 
			FROM comments 
			INNER JOIN articles 
			ON comments.idArticle = articles.id 
			WHERE comments.nbrSignalement > 0 
			ORDER BY comments.nbrSignalement 
			DESC');
		$requete->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Comment');

		$listeCommentsReported = $requete->fetchALL();

		return $listeCommentsReported;
	}



	//Méthode permettant d'ajouter un commentaire
	public function add(Comment $comment)
	{
		
		$requete = $this->db->prepare('INSERT INTO comments SET  idArticle = :idArticle, auteur = :pseudo, contenu = :contenu, datePublication = NOW(), nbrSignalement = 0');
		$requete->bindValue(':idArticle', $comment->idArticle());
		$requete->bindValue(':pseudo', $comment->auteur());
		$requete->bindValue(':contenu', $comment->contenu());

		$requete->execute();	
	}

	//Methode permettant de repondre à un commentaire
	public function addResponse(Comment $comment)
	{
		$requete = $this->db->prepare('INSERT INTO comments SET idParent = :idParent, idArticle = :idArticle, auteur = :pseudo, contenu = :contenu, datePublication = NOW(), nbrSignalement = 0');
		$requete->bindValue(':idParent', $comment->idParent());
		$requete->bindValue(':idArticle', $comment->idArticle());
		$requete->bindValue(':pseudo', $comment->auteur());
		$requete->bindValue(':contenu', $comment->contenu());

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
		$requete = $this->db->prepare('UPDATE comments SET nbrSignalement = :nbrSignalement WHERE id = :id');
		$requete->bindValue(':id', $id);
		$requete->bindValue(':nbrSignalement', $signalement);
		$requete->execute();
	}

}