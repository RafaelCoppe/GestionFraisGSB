<?php
class Pharmacie
{
	private ?int $id;
    private string $nom;
    private string $adresse;
    private int $id_ville;

	public function __construct($id, $nom, $adresse, $id_ville)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->adresse = $adresse;
		$this->id_ville = $id_ville;
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
    public function getAdresse()
	{
		return $this->adresse;
	}
	public function setAdresse($adresse)
	{
		$this->adresse = $adresse;
    }
    public function getIdVille()
	{
		return $this->id_ville;
	}
	public function setIdVille($id_ville)
	{
		$this->id_ville = $id_ville;
    }
}