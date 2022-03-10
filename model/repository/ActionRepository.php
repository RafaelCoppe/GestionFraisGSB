<?php

namespace App\model\repository;

use App\model\repository\Repository;
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class ActionRepository extends Repository
{
    public function getIdByLibelle(Action $action)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("select id from action where libelle = :par_libelle");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_libelle', $action->getLibelle(), PDO::PARAM_STR);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        return intval($enreg->id);
    }
}
