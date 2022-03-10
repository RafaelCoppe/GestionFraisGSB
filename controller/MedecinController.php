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
    }
    public function ajoutMedecinForm()
    {
        $this->render("Medecin/ajoutMedecin", array("title" => "Ajout d'un médecin"));
    }
    public function ajoutMedecinTrait()
    { 
        session_start();
        $unMedecin = new Medecin(
            null,
            $_POST['nom'],
            $_POST['prenom'],
        );
        $unMedecinRepository = new MedecinRepository();
        $ret = $unMedecinRepository->ajoutMedecin($unMedecin);

        //
        if ($ret == false) {
            $msg = "<p class='text-danger'>ERREUR : le médecin n'a pas été enregistrée</p>";
        } else {
            $msg = "<p class='text-success'>Le médecin a été enregistrée</p>";
        }

        //
        $unMedecinRepository = new MedecinRepository();
        $this->render("Medecin/ajoutMedecin", array("title" => "Ajout d'un médecin","msg" => $msg));
    }
}