<?php

namespace App\model\entity;

use App\model\entity\{DeplacementPhamacie, Produit};

class Deplacement_Produit
{
	private DeplacementPharmacie $leDeplacement;
	private Produit $leProduit;

	public function __construct($leDeplacement, $leProduit)
	{
		$this->leDeplacement = $leDeplacement;
		$this->leProduit = $leProduit;
	}
	public function getLeDeplacement()
	{
		return $this->leDeplacement;
	}
	public function setLeDeplacement($leDeplacement)
	{
		$this->leDeplacement = $leDeplacement;
    }
    public function getLeProduit()
	{
		return $this->leProduit;
	}
	public function setLeProduit($leProduit)
	{
		$this->leProduit = $leProduit;
    }
}