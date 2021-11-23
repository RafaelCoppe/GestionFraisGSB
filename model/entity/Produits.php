<?php
class Produits
{
	private int $id;
	private date $id_deplacement;
    private string $produit_nom;
    private string $produit_type;

	public function __construct($id, $id_deplacement, $produit_nom, $produit_type)
	{
		$this->id = $id;
		$this->id_deplacement = $id_deplacement;
		$this->produit_nom = $produit_nom;
		$this->produit_type = $produit_type;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
    }
    public function getIdDeplacement()
	{
		return $this->id_deplacement;
	}
	public function setIdDeplacement($idDeplacement)
	{
		$this->id_deplacement = $idDeplacement;
    }
    public function getNomProduit()
	{
		return $this->produit_nom;
	}
	public function setNomProduit($nomProduit)
	{
		$this->produit_nom = $nomProduit;
    }
    public function getTypeProduit()
	{
		return $this->produit_type;
	}
	public function setTypeProduit($typeProduit)
	{
		$this->produit_type = $typeProduit;
    }
}