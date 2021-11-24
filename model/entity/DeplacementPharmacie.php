<?php
class DeplacementPharmacie
{
	private ?int $id;
	private ?string $date;
    private Pharmacie $laPharmacie;
    private string $commentaire;
    private ?Utilisateur $leDelegue;

	public function __construct($id, $date, $laPharmacie, $commentaire, $leDelegue)
	{
		$this->id = $id;
		$this->date = $date;
		$this->laPharmacie = $laPharmacie;
		$this->commentaire = $commentaire;
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
    public function getDate()
	{
		return $this->date;
	}
	public function setDate($date)
	{
		$this->date = $date;
    }
    public function getLaPharmacie()
	{
		return $this->laPharmacie;
	}
	public function setLaPharmacie($laPharmacie)
	{
		$this->laPharmacie = $laPharmacie;
    }
    public function getCommentaire()
	{
		return $this->commentaire;
	}
	public function setCommentaire($commentaire)
	{
		$this->commentaire = $commentaire;
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
