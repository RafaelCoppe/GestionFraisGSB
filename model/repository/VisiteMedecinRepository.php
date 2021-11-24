<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class VisiteMedecinRepository extends Repository
{
    public function ajoutVisiteMedecin(VisiteChezMedecin $visACreer)
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
 
}
