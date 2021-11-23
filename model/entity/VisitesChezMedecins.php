<?php 
class VisitesChezMedecins {
    private int $id;
    private string $dateSaisie;
    private string $commentaire;
    private Medecin $leMedecin;

    public function __construct($id, $dateSaisie, $commentaire, $leMedecin)
	{
		$this->id = $id;
		$this->dateSaisie = $dateSaisie;
		$this->commentaire = $commentaire;
        $this->leMedecin = $leMedecin;
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
}
?>