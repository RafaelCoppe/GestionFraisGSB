<?php

class DeplacementsPharmacieController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DeplacementPharmacieRepository.php');
        require_once(ROOT . '/model/repository/PharmacieRepository.php');
        require_once(ROOT . '/model/entity/DeplacementPharmacie.php');
        require_once(ROOT . '/model/entity/Pharmacie.php');
        require_once(ROOT . '/model/entity/Ville.php');
        require_once(ROOT . '/model/entity/Produit.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function ajoutDeplacementPharmacieForm()
    {
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();

        $this->render("deplacementsPharmacies/ajoutDeplacement", array("title" => "Ajout d'un déplacement en pharmacie", "lesPharmacies" => $lesPharmacies));
    }
    public function ajoutDeplacementPharmacieTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leDeplacement = new DeplacementPharmacie(
            null,
            date('Y-m-d H:i:s'),
            new Pharmacie($_POST['pharmacie']),
            $_POST['commentaire'],
            new Utilisateur($idUtilConnecte)
        );
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $ret = $unDeplacementRepository->ajoutDeplacementPharmacie($leDeplacement);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }
        //
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();

        $this->render("deplacementsPharmacies/ajoutDeplacement", array("title" => "Ajout d'un deplacement en pharmacie", "lesPharmacies" => $lesPharmacies, "msg" => $msg));
    }

    public function consultDeplacementsPharmacie()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $undeplacementPharmacieRepository = new DeplacementPharmacieRepository();
        $lesDeplacements = $undeplacementPharmacieRepository->getLesDeplacementsPharmacie($idUtilConnecte);

        $this->render("deplacementsPharmacies/consultDeplacementsPharmacie", array("title" => "Liste des demandes de remboursement", "lesDeplacements" => $lesDeplacements));
    }

    public function consultDeplacementsPharmacieDelegue()
    {
        session_start();
        $idDelegue = $_POST['delegue'];
        $undeplacementPharmacieRepository = new DeplacementPharmacieRepository();
        $lesDeplacements = $undeplacementPharmacieRepository->getLesDeplacementsPharmacieDelegue($idDelegue);

        $this->render("deplacementsPharmacies/consultDeplacementsPharmacie", array("title" => "Liste des deplacements en pharmacie", "lesDeplacements" => $lesDeplacements));
    }
    public function modifDeplacementsPharmacieListeForm()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $undeplacementPharmacieRepository = new DeplacementPharmacieRepository();
        $lesDeplacements = $undeplacementPharmacieRepository->getLesDeplacementsPharmacie($idUtilConnecte);

        $this->render("deplacementsPharmacies/modifDeplacementListForm", array("title" => "Liste des deplacements en pharmacie", "lesDeplacements" => $lesDeplacements));
    }
    public function modifDeplacementsPharmacieForm()
    {
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();

        //
        $idDemande =  $_POST["listDemRemb"];

        //
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $laDemandeAModifier = $unDemRemboursRepository->getUneDemandeRemboursement($idDemande);
        //
        $this->render("demandeRemboursement/modifDemande", array("title" => "Modification d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais, "laDemande" => $laDemandeAModifier));
    }

    public function modifDeplacementsPharmacieTrait()
    {
        //
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laDemande = new DemandeRemboursement(
            $_POST['idDemande'],
            date('Y-m-d H:i:s'),
            $_POST['montant'],
            $_POST['commentaire'],
            new TypeFrais($_POST['typeFrais'], null),
            new Utilisateur($idUtilConnecte)
        );
        $uneDemandeRepository = new DemandeRemboursementRepository();
        $ret = $uneDemandeRepository->modifDemandeRemboursement($laDemande);
        if ($ret == false) {
            $msg = "modification impossible";
            $typeFraisRepository = new TypeFraisRepository();
            $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
            $this->render("demandeRemboursement/modifDemande", array("title" => "Modification d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais,  "laDemande" => $laDemande, "msg" => $msg));
        } else {
            $msg = "modification effectuée";
            $unDemRemboursRepository = new DemandeRemboursementRepository();
            $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);
            $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes, "msg" => $msg));
        }
    }
};
