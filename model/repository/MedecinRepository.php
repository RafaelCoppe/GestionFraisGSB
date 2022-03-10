<?php

namespace App\model\repository;

use App\model\repository\Repository;
use App\model\entity\{Medecin};
use PDO, PDOException;

class MedecinRepository extends Repository
{
    //requête permettant d'obtenir tous les types de frais
    public function getLesMedecins()
    {
        $lesMedecins = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM medecin");
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unMedecin = new Medecin(
                $enreg->id,
                $enreg->nom,
                $enreg->prenom,
            );
            array_push($lesMedecins, $unMedecin);
        }
        return $lesMedecins;
    }

    public function ajoutMedecin(Medecin $medACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into medecin
            values (0,:par_nom,:par_prenom)");
            
            $req->bindValue(':par_nom', $medACreer->getNom(), PDO::PARAM_STR);
            $req->bindValue(':par_prenom', $medACreer->getPrenom(), PDO::PARAM_STR);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
}
