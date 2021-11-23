<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class VisitesChezMedecinsRepository extends Repository
{
    public function ajoutVisiteChezMedecin(VisiteChezMedecin $visACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into visites_chez_medecins
            values (0,:par_date_saisie,:par_commentaire,:par_id_medecin)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $visACreer->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $visACreer->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_medecin', $visACreer->getMedecin()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
 
}
