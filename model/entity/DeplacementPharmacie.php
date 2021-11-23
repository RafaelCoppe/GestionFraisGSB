<?php
class DeplacementPharmacie
{
	private int $id;
	private date $date;
    private string $pharmacie_nom;
    private string $pharmacie_adresse;
    private string $commentaire;
    private int $id_delegue;

	public function __construct($id, $date, $pharmacie_nom, $pharmacie_adresse, $commentaire, $id_delegue)
	{
		$this->id = $id;
		$this->date = $date;
		$this->pharmacie_nom = $pharmacie_nom;
		$this->pharmacie_adresse = $pharmacie_adresse;
		$this->commentaire = $commentaire;
		$this->id_delegue = $id_delegue;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
    }
    public function getDate()
	{
		return $this->date;
	}
	public function setDate($date)
	{
		$this->date = $date;
    }
    public function getNomPharmacie()
	{
		return $this->id;
	}
	public function setNomPharmacie($nomPharmacie)
	{
		$this->pharmacie_nom = $nomPharmacie;
    }
    public function getAdressePharmacie()
	{
		return $this->pharmacie_adresse;
	}
	public function setAdressePharmacie($adressePharmacie)
	{
		$this->pharmacie_adresse = $adressePharmacie;
    }
    public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
    }
    public function getIdDelegue()
	{
		return $this->id_delegue;
	}
	public function setIdDelegue($idDelegue)
	{
		$this->id_delegue = $idDelegue;
	}
}
