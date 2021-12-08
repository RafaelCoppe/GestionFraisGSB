<?php

class VisiteMedecinController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(ROOT . '/model/repository/VisiteMedecinRepository.php');
        require_once(ROOT . '/model/repository/MedecinRepository.php');
        require_once(ROOT . '/model/entity/VisiteMedecin.php');
        require_once(ROOT . '/model/entity/Medecin.php');
        require_once(ROOT . '/model/entity/Utilisateur.php');
    }
    public function ajoutVisiteMedecinForm()
    {
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();

        $this->render("VisiteMedecin/ajoutVisiteMedecin", array("title" => "Ajout d'une visite chez le médecin", "lesMedecins" => $lesMedecins));
    }
    public function ajoutVisiteMedecinTrait()
    { 
        session_start();
        $idUtilConnecte = $_SESSION['id'];
        $laVisite = new VisiteMedecin(
            null,
            date('Y-m-d H:i:s'),
            $_POST['commentaire'],
            new Medecin ($_POST['visiteMedecin']),
            new Utilisateur($idUtilConnecte)
        );
        $uneVisiteRepository = new VisiteMedecinRepository();
        $ret = $uneVisiteRepository->ajoutVisiteMedecin($laVisite);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre visite n'a pas été enregistrée</p>";
        } else {
            $msg = "<p class='text-success'>Votre visite a été enregistrée</p>";
        }

        //
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();
        $this->render("VisiteMedecin/ajoutVisiteMedecin", array("title" => "Ajout d'une visite chez le médecin", "lesMedecins" => $lesMedecins, "msg" => $msg));
    }

    public function consultVisiteMedecin()
    {
        $visiteMedecinRepository = new visiteMedecinRepository();
        $lesVisites = $visiteMedecinRepository->getVisiteMedecin($_POST['listDelegue']);

        $this->render("VisiteMedecin/consultVisiteMedecin", array("title" => "Liste des visites chez le medecin", "lesVisites" => $lesVisites));
    }
};
