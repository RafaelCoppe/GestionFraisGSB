<?php

namespace App\controller;

use App\controller\controller;
use App\model\repository\{DemandeRemboursementRepository, TypeFraisRepository, ActionRepository, TableRepository, LogEvenementRepository};
use App\model\entity\{TypeFrais, Utilisateur, LogEvenement};

class DemandeRemboursementController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/DemandeRemboursementRepository.php');
        require_once(ROOT . '/model/repository/TypeFraisRepository.php');
        require_once(ROOT . '/model/repository/LogEvenementRepository.php');
        require_once(ROOT . '/model/repository/ActionRepository.php');
        require_once(ROOT . '/model/repository/TableRepository.php');
        require_once(ROOT . '/model/entity/DemandeRemboursement.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
        require_once(ROOT . '/model/entity/TypeFrais.php');
        require_once(ROOT . '/model/entity/LogEvenement.php');
        require_once(ROOT . '/model/entity/Action.php');
        require_once(ROOT . '/model/entity/Table.php');
    }
    public function ajoutDemandeRemboursementForm()
    {
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();

        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais));
    }
    public function ajoutDemandeRemboursementTrait()
    {
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laDemande = new DemandeRemboursement(
            null,
            date('Y-m-d H:i:s'),
            $_POST['montant'],
            $_POST['commentaire'],
            new TypeFrais($_POST['typeFrais'], null),
            new Utilisateur($idUtilConnecte)
        );
        $uneDemandeRepository = new DemandeRemboursementRepository();
        $ret = $uneDemandeRepository->ajoutDemandeRemboursement($laDemande);

        //
        if ($ret[0] == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
            
            $unActionRepository = new ActionRepository();
            $leIdAction = $unActionRepository->getIdByLibelle(new Action(null, "ajout"));

            $unTableRepository = new TableRepository();
            $leIdTable = $unTableRepository->getIdByNom(new Table(null, "demande_remboursement"));

            $leLogEvenement = new LogEvenement(
                null,
                $_SERVER['REMOTE_ADDR'],
                date('Y-m-d H:i:s'),
                $ret[1],
                new Utilisateur($idUtilConnecte),
                new Action($leIdAction, "ajout"),
                new Table($leIdTable, "demande_rembousement")
            );

            $unLogEvenementRepository = new logEvenementRepository();
            $leResult = $unLogEvenementRepository->insertLog($leLogEvenement);
        }
        //
        $typeFraisRepository = new TypeFraisRepository();
        $lesTypesFrais = $typeFraisRepository->getLesTypesFrais();
        $this->render("demandeRemboursement/ajoutDemande", array("title" => "Ajout d'une demande de remboursement", "lesTypesFrais" => $lesTypesFrais, "msg" => $msg));
    }
    public function modifDemandeRemboursementListeForm()
    {
        //
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);

        $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }
    public function modifDemandeRemboursementForm()
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

    public function modifDemandeRemboursementTrait()
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
            $unActionRepository = new ActionRepository();
            $leIdAction = $unActionRepository->getIdByLibelle(new Action(null, "modification"));

            $unTableRepository = new TableRepository();
            $leIdTable = $unTableRepository->getIdByNom(new Table(null, "demande_remboursement"));

            $leLogEvenement = new LogEvenement(
                null,
                $_SERVER['REMOTE_ADDR'],
                date('Y-m-d H:i:s'),
                $_POST['idDemande'],
                new Utilisateur($idUtilConnecte),
                new Action($leIdAction, "modification"),
                new Table($leIdTable, "demande_rembousement")
            );

            $unLogEvenementRepository = new logEvenementRepository();
            $leResult = $unLogEvenementRepository->insertLog($leLogEvenement);

            $msg = "modification effectuée";
            $unDemRemboursRepository = new DemandeRemboursementRepository();
            $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);
            $this->render("demandeRemboursement/modifDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes, "msg" => $msg));
        }
    }
    public function consultMesDemandeRemboursement()
    {
        session_start();
        $idUtilConnecte = $_SESSION['profil'];
        
        $unDemRemboursRepository = new DemandeRemboursementRepository();
        $lesDemandes = $unDemRemboursRepository->getMesDemandesRemboursement($idUtilConnecte);

        $this->render("demandeRemboursement/consultDemandeListe", array("title" => "Liste des demandes de remboursement", "lesDemandes" => $lesDemandes));
    }
};
