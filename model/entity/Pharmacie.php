<?php
class Pharmacie
{
	private ?int $id;
    private string $nom;
    private string $adresse;
    private Ville $laVille;

	public function __construct($id, $nom, $adresse, $laVille)
	{
		$this->id = $id;
		$this->nom = $nom;
		$this->adresse = $adresse;
		$this->laVille = $laVille;
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
    public function getLaVille()
	{
		return $this->laVille;
	}
	public function setLaVille($laVille)
	{
		$this->laVille = $laVille;
    }
}