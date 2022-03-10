<?php

namespace App\controller;

use App\controller\controller;

use App\model\repository\{MedecinRepository};
use App\model\entity\{Medecin};

class MedecinController extends Controller
{
    public function __construct()
    {
        parent::__construct();
<<<<<<< HEAD
=======
        require_once(ROOT . '/model/repository/MedecinRepository.php');
        require_once(ROOT . '/model/entity/Medecin.php');
>>>>>>> 6f7b701c891cbf5f0c349f3d2a4554bf324ea47d
    }
    public function ajoutMedecinForm()
    {
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();

        $this->render("medecin/ajoutMedecin", array("title" => "Ajout d'un médecin", "lesMedecins" => $lesMedecins));
    }
    public function ajoutMedecinTrait()
    {
        session_start();
        $leMedecin = new Medecin(
            null,
            $_POST['prenom'],
            $_POST['nom']
        );
        $unMedecinRepository = new MedecinRepository();
        $ret = $unMedecinRepository->ajoutMedecin($leMedecin);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : votre médecin n'a pas été enregistré</p>";
        } else {
            $_POST = array();
            $msg = "<p class='text-success'>Votre médecin a été enregistré</p>";
        }
        $medecinRepository = new MedecinRepository();
        $lesMedecins = $medecinRepository->getLesMedecins();
        $this->render("medecin/ajoutMedecin", array("title" => "Ajout d'un médecin", "lesMedecins" => $lesMedecins, "msg" => $msg));
    }
}