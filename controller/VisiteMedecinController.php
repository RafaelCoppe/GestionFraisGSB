<?php

class VisiteMedecinController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/VisiteMedecinRepository.php');
        require_once(ROOT . '/model/entity/VisiteMedecin.php');
        require_once(ROOT . '/model/entity/Medecin.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function ajoutVisitesMedecinsForm()
    {
        $MedecinRepository = new MedecinRepository();
        $leMedecin = $MedecinRepository->getMedecin();

        $this->render("VisiteMedecin/ajoutVisiteMedecin", array("title" => "Ajout d'une visite chez le médecin", "lesVisitesMedecins" => $lesVisitesMedecins));
    }
    public function ajoutVisiteMedecinTrait()
    { 
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laVisite = new VisiteMedecin(
            null,
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new leMedecin ($_POST['medecin'], null),
            new Utilisateur($idUtilConnecte)
        );
        $MedecinRepository = new MedecinRepository();
        $ret = $MedecinRepository->ajoutVisiteMedecin($laVisite);

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
        $this->render("VisitesMedecins/ajoutVisiteMedecin", array("title" => "Ajout d'une visite chez le médecin", "lesVisitesMedecins" => $lesVisitesMedecins, "msg" => $msg));
    }

};
