<?php

namespace App\model\repository;

use App\model\repository\Repository;
use App\model\entity\{VisiteMedecin, Medecin};
use PDO, PDOException;

class VisiteMedecinRepository extends Repository
{
    public function ajoutVisiteMedecin(VisiteMedecin $visACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into visite_medecin
            values (0,:par_date_saisie,:par_commentaire,:par_id_medecin,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $visACreer->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $visACreer->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_medecin', $visACreer->getMedecin()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_delegue', $visACreer->getDelegue()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    
    public function getVisiteMedecin($idDelegue = null)
    {
        $lesVisites = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select visite_medecin.id as id, 
                    DATE_FORMAT(date_saisie, '%d/%m/%Y à %H:%i:%s') as date_saisie, commentaire, medecin.nom, medecin.prenom
                    from visite_medecin 
                    join medecin on medecin.id = id_medecin
                    where id_delegue = " . $idDelegue);
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneVisite = new VisiteMedecin(
                $enreg->id,
                $enreg->date_saisie,
                $enreg->commentaire,
                new Medecin(null, $enreg->nom, $enreg->prenom),
                null
            );
            array_push($lesVisites, $uneVisite);
        }
        return $lesVisites;
    }
}
