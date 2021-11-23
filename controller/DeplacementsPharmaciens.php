<?php

class DeplacementsPharmaciens extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DeplacementPharmacieRepository.php');
        require_once(ROOT . '/model/entity/DeplacementPharmacie.php');
        require_once(ROOT . '/model/entity/Produits.php');
    }
    public function ajoutDeplacementPharmacieForm()
    {
        $this->render("deplacementsPharmacies/ajoutDeplacement", array("title" => "Ajout d'un déplacement en pharmacie"));
    }
    public function ajoutDeplacementPharmacieTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leDeplacement = new DeplacementPharmacie(
            null,
            date('Y-m-d H:i:s'),
            $_POST['pharmacie_nom'],
            $_POST['pharmacie_adresse'],
            $_POST['commentaire'],
            new Utilisateur($idUtilConnecte)
        );
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $ret = $uneDemandeRepository->ajoutDemandeRemboursement($laDemande);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais, "msg" => $msg));
    }

    public function consultDeplacementPharmacie()
    {
        session_start();
        $idUtilConnecte = $_SESSION['profil'];
        
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);

        $this->render("demandeRemboursement/consultDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }
};
