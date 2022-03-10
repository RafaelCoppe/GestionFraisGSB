<?php

namespace App\controller;

use App\controller\controller;

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
            $_POST['date'] . " " . $_POST['time'],
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
        $lesDeplacements = $undeplacementPharmacieRepository->getLesDeplacementsPharmacieDelegue($idUtilConnecte);

        $this->render("deplacementsPharmacies/modifDeplacementListForm", array("title" => "Liste des deplacements en pharmacie", "lesDeplacements" => $lesDeplacements));
    }
    public function modifDeplacementsPharmacieForm()
    {
        session_start();
        $PharmacieRepository = new PharmacieRepository();
        $lesPharmacies = $PharmacieRepository->getLesPharmacies();

        //
        $idDeplacement =  $_POST["deplacement"];
        $idDelegue = $_SESSION['id'];

        //
        $unDepPharmacieRepository = new DeplacementPharmacieRepository();
        $laDepPharmacieAModifier = $unDepPharmacieRepository->getUnDeplacementPharmacie($idDeplacement, $idDelegue);
        //
        $this->render("deplacementsPharmacies/modifDeplacement", array("title" => "Modification d'un deplacement en pharmacie", "lesPharmacies" => $lesPharmacies, "laDepPharmacie" => $laDepPharmacieAModifier));
    }

    public function modifDeplacementsPharmacieTrait()
    {
        //
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $leDeplacement = new DeplacementPharmacie(
            $_SESSION['idDepPharma'],
            $_POST['date'] . " " . $_POST['time'],
            new Pharmacie($_POST['pharmacie']),
            $_POST['commentaire'],
            new Utilisateur($idUtilConnecte)
        );
        $unDeplacementRepository = new DeplacementPharmacieRepository();
        $ret = $unDeplacementRepository->modifDeplacementPharmacie($leDeplacement);

        if ($ret == false) {
            $msg = "modification impossible";
            $PharmacieRepository = new PharmacieRepository();
            $lesPharmacies = $PharmacieRepository->getLesPharmacies();

            //
            $idDeplacement =  $_POST["deplacement"];
            $idDelegue = $_SESSION['id'];

            //
            $unDepPharmacieRepository = new DeplacementPharmacieRepository();
            $laDepPharmacieAModifier = $unDepPharmacieRepository->getUnDeplacementPharmacie($idDeplacement, $idDelegue);
            //
            $this->render("deplacementsPharmacies/modifDeplacement", array("title" => "Modification d'un deplacement en pharmacie", "lesPharmacies" => $lesPharmacies, "laDepPharmacie" => $laDepPharmacieAModifier, "msg" => $msg));
        } else {
            $msg = "modification effectuée";
            $idUtilConnecte = $_SESSION['id'];
            $undeplacementPharmacieRepository = new DeplacementPharmacieRepository();
            $lesDeplacements = $undeplacementPharmacieRepository->getLesDeplacementsPharmacie($idUtilConnecte);

            $this->render("deplacementsPharmacies/modifDeplacementListForm", array("title" => "Liste des deplacements en pharmacie", "lesDeplacements" => $lesDeplacements, "msg" => $msg));
        }
    }
};
