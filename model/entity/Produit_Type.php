<?php

namespace App\model\entity;

class Produit_type
{
	private ?int $id;
    private string $libelle;

	public function __construct($id, $libelle)
	{
		$this->id = $id;
		$this->produit_nom = $libelle;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
    }
    public function getLibelle()
	{
		return $this->libelle;
	}
	public function setLibelle($libelleProduit)
	{
		$this->libelle = $libelleProduit;
    }
}