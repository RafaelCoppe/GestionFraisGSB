<?php

class VisitesMedecinsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/VisitesChezMedecinsRepository.php');
        require_once(ROOT . '/model/entity/VisitesChezMedecins.php');
        require_once(ROOT . '/model/entity/Medecin.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function ajoutVisitesMedecinsForm()
    {
        $MedecinRepository = new MedecinRepository();
        $leMedecin = $MedecinRepository->getMedecin();

        $this->render("VisitesMedecins/ajoutVisitesMedecins", array("title" => "Ajout d'une visite chez le médecin", "lesVisitesMedecins" => $lesVisitesMedecins));
    }
    public function ajoutVisitesMedecinsTrait()
    { 
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laVisite = new VisitesMedecins(
            null,
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new leMedecin ($_POST['medecin'], null),
            new Utilisateur($idUtilConnecte)
        );
        $MedecinRepository = new MedecinRepository();
        $ret = $MedecinRepository->ajoutVisitesMedecins($laVisite);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre demande n'a pas été enregistrée</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre demande a été enregistrée</p>";
        }

        //
        $MedecinRepository = new MedecinRepository();
        $leMedecin = $MedecinRepository->getMedecin();
        $this->render("VisitesMedecins/ajoutVisitesMedecins", array("title" => "Ajout d'une visite chez le médecin", "lesVisitesMedecins" => $lesVisitesMedecins, "msg" => $msg));
    }

};
