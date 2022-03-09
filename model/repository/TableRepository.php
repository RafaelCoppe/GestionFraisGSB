<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class TableRepository extends Repository
{
    public function getIdByNom(Table $table)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("select id from rembours_frais.table where nom = :par_nom");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_nom', $table->getNom(), PDO::PARAM_STR);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        return intval($enreg->id);
    }
}
