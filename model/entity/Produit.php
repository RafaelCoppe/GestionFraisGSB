<?php

namespace App\model\entity;

use App\model\entity\produit_type;

class Produit
{
	private ?int $id;
    private string $produit_nom;
    private Produit_Type $leTypeProduit;

	public function __construct($id, $produit_nom, $leTypeProduit)
	{
		$this->id = $id;
		$this->produit_nom = $produit_nom;
		$this->leTypeProduit = $leTypeProduit;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
    }
    public function getNomProduit()
	{
		return $this->produit_nom;
	}
	public function setNomProduit($nomProduit)
	{
		$this->produit_nom = $nomProduit;
    }
    public function getLeTypeProduit()
	{
		return $this->leTypeProduit;
	}
	public function setLeTypeProduit($leTypeProduit)
	{
		$this->leTypeProduit = $leTypeProduit;
    }
}