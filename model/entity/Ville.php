<?php
class Ville
{
	private ?int $id;
    private string $nom;
    private string $codePostal;

	public function __construct($id, $nom, $codePostal)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->codePostal = $codePostal;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
    }
    public function getNom()
	{
		return $this->nom;
	}
	public function setNom($nom)
	{
		$this->nom = $nom;
    }
    public function getCodePostal()
	{
		return $this->codePostal;
	}
	public function setCodePostal($codePostal)
	{
		$this->codePostal = $codePostal;
    }
}