<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class PharmacieRepository extends Repository
{
    /*public function ajoutDeplacementPharmacie(DeplacementPharmacie $deplacement)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into deplacement_pharmacie 
            values (0,:par_date_saisie,:par_pharma_id,:par_commentaire,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $deplacement->getDate(), PDO::PARAM_STR);
            $req->bindValue(':par_pharma_nom', $deplacement->getLaPharmacie()->GetId(), PDO::PARAM_INT);
            $req->bindValue(':par_commentaire', $deplacement->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_delegue', $deplacement->getDelegue()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }*/
    public function getLesPharmacies()
    {
        $lesPharmacies = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select pharmacie.*, ville_france.ville_nom_simple AS nomVille, ville_france.ville_code_postal AS CPVille
        from pharmacie
        JOIN ville_france ON pharmacie.id_ville = ville_france.ville_id");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unePharmacie = new Pharmacie(
                $enreg->id,
                $enreg->nom,
                $enreg->adresse,
                new Ville($enreg->id_ville, $enreg->nomVille, $enreg->CPVille),
            );
            array_push($lesPharmacies, $unePharmacie);
        }
        return $lesPharmacies;
    }
}
