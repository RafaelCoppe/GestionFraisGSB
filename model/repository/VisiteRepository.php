<?php
date_default_timezone_set('Europe/Paris');
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class VisiteRepository extends Repository
{
    public function ajoutVisite(Visite $visACreer)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into visite 
            values (0,:par_date_saisie,:par_commentaire,:par_id_medecin,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $visACreer->getDate(), PDO::PARAM_STR);
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
    public function modifVisite(Visite $visAModifier)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("update visite 
            set 
            DATE_FORMAT(date, '%d/%m/%Y à %H:%i:%s') = :par_date_saisie,
            commentaires = :par_commentaire,
            id_medecin=:par_id_medecin
            where id = :par_id_visite");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $visAModifier->getDate(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $visAModifier->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_medecin', $visAModifier->getMedecin()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_id_visite', $visAModifier->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
    public function getLesVisitesConsult($idDelegue)
    {
        
        $lesVisites = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select visite.id as id, 
                            DATE_FORMAT(date, '%d/%m/%Y à %H:%i:%s') as date, 
                            commentaires, medecin.nom, medecin.prenom
                            from visite 
                            join medecin on medecin.id = id_medecin
                            join utilisateur on utilisateur.id = id_delegue
                            where utilisateur.id = :par_idDel");

        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_idDel', $idDelegue, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneVisite = new Visite(
                $enreg->id,
                $enreg->date,
                $enreg->commentaires,
                new Medecin(null, $enreg->nom, $enreg->prenom),
                null
            );

            array_push($lesVisites, $uneVisite);
        }
        return $lesVisites;
    }
    public function getUneVisite($idVis)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("select visite.id, DATE_FORMAT(date, '%d/%m/%Y à %H:%i:%s') as date, 
        commentaires, id_Medecin 
        from visite 
        join medecin on medecin.id = id_medecin
        where visite.id = :par_id");
        // on affecte une valeur au paramètre déclaré dans la requête 
        $req->bindValue(':par_id', $idVis, PDO::PARAM_INT);
        // on demande l'exécution de la requête 
        $req->execute();
        $enreg = $req->fetch();
        $uneVisite = new Visite(
            $enreg->id,
            $enreg->date,
            $enreg->commentaires,
            new Medecin($enreg->id, null, null),
            null
        );
        return $uneVisite;
    }
    public function getLesVisites($idDelegue = null)
    {
        
        $lesVisites = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select visite.id as id, 
                        DATE_FORMAT(date, '%d/%m/%Y à %H:%i:%s') as date, 
                        commentaires, medecin.nom, medecin.prenom
                        from visite 
                        join medecin on medecin.id = id_medecin
                        join utilisateur on utilisateur.id = id_delegue
                        where utilisateur.id =" . $idDelegue);
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneVisite = new Visite(
                $enreg->id,
                $enreg->date,
                $enreg->commentaires,
                new Medecin(null, $enreg->nom, $enreg->prenom),
                null
            );

            array_push($lesVisites, $uneVisite);
        }
        return $lesVisites;
    }
}