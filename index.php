<?php

namespace App;

use App\Autoloader;
use App\controller\{DemandeRemboursementController, DeplacementsPharmacieController, MedecinController, UtilisateurController, VisiteMedecinController, VisiteController};

require_once "./autoloader.php";
Autoloader::register();

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "ajoutUtilisateurForm":
            // demande du formulaire d'ajout d'un utilisateur
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurForm();
            break;
        case "ajoutUtilisateurTrait":
            // le formulaire d'ajout d'un utilisateur a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new UtilisateurController();
            $leControleur->ajoutUtilisateurTrait();
            break;
        case "ajoutDemRembForm":
            session_start();
            //if (session_status() == 3) {
            $idDelegue = $_SESSION['id'];
            //}
            if (isset($idDelegue) == false || $idDelegue == 0) {
                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }
            // demande du formulaire d'ajout d'une demande de remboursement
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementForm();
            break;
        case "ajoutDemRembTrait":
            // le formulaire d'ajout d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DemandeRemboursementController();
            $leControleur->ajoutDemandeRemboursementTrait();
            break;
        case "ajoutVisiteTrait":
            // le formulaire d'ajout d'une visite a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteTrait();
            break;
            
        case "ajoutVisiteForm":
            session_start();
            //if (session_status() == 3) {
            $idDelegue = $_SESSION['id'];
            //}
            if (isset($idDelegue) == false || $idDelegue == 0) {
                require(ROOT . "/controller/Controller.php");
                require(ROOT . "/controller/UtilisateurController.php");
                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }
            // demande du formulaire d'ajout d'une visite
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->ajoutVisiteForm();
            break;

        case "ajoutMedecinTrait":
            $leControleur = new MedecinController();
            $leControleur->ajoutMedecinTrait();
            break;
        case "ajoutMedecinForm":
            $leControleur = new MedecinController();
            $leControleur->ajoutMedecinForm();
            break;

        case "modifDemRembListeForm":
            // demande du formulaire permettant d'obtenir la liste des
            // demande de remboursement en vue d'une modification
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementListeForm();
            break;
        case "modifDemRembForm":
            // demande du formulaire de modification d'une demande de remboursement
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementForm();
            break;
        case "modifDemRembTrait":
            // le formulaire de modification d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DemandeRemboursementController();
            $leControleur->modifDemandeRemboursementTrait();
            break;
        case "modifVisiteListeForm":
            // demande du formulaire permettant d'obtenir la liste des
            // visites en vue d'une modification
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/visiteController.php");
            $leControleur = new VisiteController();
            $leControleur->modifVisiteListeForm();
            break;
        case "modifVisiteForm":
            // demande du formulaire de modification d'une visite
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/visiteController.php");
            $leControleur = new VisiteController();
            $leControleur->modifVisiteForm();
            break;
        case "modifVisiteTrait":
            // le formulaire de modification d'une visite a été soumis.
            // Vérification et enregistrement des informations saisies
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/visiteController.php");
            $leControleur = new VisiteController();
            $leControleur->modifVisiteTrait();
            break;
        case "consultMesDemRemb":
            // affichage des demandes de remboursements saisies par le délegué
            $leControleur = new DemandeRemboursementController();
            $leControleur->consultMesDemandeRemboursement();
            break;

        case "consultVisite":
            // affichage des visites pour le délegué choisis
            require(ROOT . "/controller/Controller.php");
            require(ROOT . "/controller/VisiteController.php");
            $leControleur = new VisiteController();
            $leControleur->consultLesVisites();
            break;

        case "ajoutDepPharmaForm":
            session_start();
            //if (session_status() == 3) {
            $idDelegue = $_SESSION['id'];
            //}
            if (isset($idDelegue) == false || $idDelegue == 0) {
                $leControleur = new UtilisateurController();
                $leControleur->connexionForm();
                break;
            }
            // demande du formulaire d'ajout d'un deplacement en pharmacie
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->ajoutDeplacementPharmacieForm();
            break;
        case "ajoutDepPharmaTrait":
            // le formulaire d'ajout d'un déplacement chez le pharmacien a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->ajoutDeplacementPharmacieTrait();
            break;
        case "ConsultDepPharma":
            // affichage des déplacements en pharmacie saisies par le délegué
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->consultDeplacementsPharmacieDelegue();
            break;
        case "ConsultListeDelegueDepPharma":
            // affichage des déplacements en pharmacie saisies par le délegué
            $leControleur = new UtilisateurController();
            $leControleur->selectDelegueDepPharma();
            break;
        case "modifDepPharmaListeForm":
            // demande du formulaire permettant d'obtenir la liste des
            // demande de remboursement en vue d'une modification
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->modifDeplacementsPharmacieListeForm();
            break;
        case "modifDepPharmaForm":
            // demande du formulaire de modification d'une demande de remboursement
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->modifDeplacementsPharmacieForm();
            break;
        case "modifDepPharmaTrait":
            // le formulaire de modification d'une demande de remboursement a été soumis.
            // Vérification et enregistrement des informations saisies
            $leControleur = new DeplacementsPharmacieController();
            $leControleur->modifDeplacementsPharmacieTrait();

        case "consultDelegueList":
            $leControleur = new UtilisateurController();
            $leControleur->consultDelegueList();
            break;
        case "consultVisiteMedecin":
            $leControleur = new VisiteController();
            $leControleur->consultLesVisites();

            break;
        case "connexionTrait":
            // le formulaire de connexion a été soumis. 
            // Vérification des informations saisies
            $leControleur = new UtilisateurController();
            $leControleur->connexionTrait($_POST);
            break;
        case "accueil":
            // action contient accueil (choix de l'option accueil dans le menu)
            afficheFormConnexion();
            break;
        default:
            // action contient une valeur non connue : on affiche le formulaire de connexion
            afficheFormConnexion();
            break;
    }
} else {
    // action n'est pas fourni : on affiche le formulaire de connexion
    afficheFormConnexion();
}
function afficheFormConnexion()
{
    $leControleur = new UtilisateurController();
    $leControleur->connexionForm();
}
