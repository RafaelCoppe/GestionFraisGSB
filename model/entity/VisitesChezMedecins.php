<?php 
class VisitesChezMedecins {
    private int $id;
    private string $dateSaisie;
    private string $commentaire;
    private Medecin $leMedecin;
	private Utilisateur $leDelegue;

    public function __construct($id, $dateSaisie, $commentaire, $leMedecin, $leDelegue)
	{
		$this->id = $id;
		$this->dateSaisie = $dateSaisie;
		$this->commentaire = $commentaire;
        $this->leMedecin = $leMedecin;
		$this->leDelegue = $leDelegue;
	}
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
    public function getDateSaisie()
	{
		return $this->dateSaisie;
	}
	public function setDateSaisie($dateSaisie)
	{
		$this->dateSaisie = $dateSaisie;
	}
	public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
	}
    public function getMedecin()
	{
		return $this->leMedecin;
	}
	public function setMedecin($leMedecin)
	{
		$this->leMedecin = $leMedecin;
	}
	public function getDelegue()
	{
		return $this->leDelegue;
	}
	public function setDelegue($leDelegue)
	{
		$this->leDelegue = $leDelegue;
	}
}
?>