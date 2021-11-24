<?php
//class dont on a besoin (classe Repository.php obligatoire)
require_once("Repository.php");

class DeplacementPharmacieRepository extends Repository
{
    public function ajoutDeplacementPharmacie(DeplacementPharmacie $deplacement)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("insert into deplacement_pharmacie 
            values (0,:par_date_saisie,:par_pharma_id,:par_commentaire,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $deplacement->getDate(), PDO::PARAM_STR);
            $req->bindValue(':par_pharma_id', $deplacement->getLaPharmacie()->GetId(), PDO::PARAM_INT);
            $req->bindValue(':par_commentaire', $deplacement->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_delegue', $deplacement->getDelegue()->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            echo $e;die;
            $ret = false;
        }
        return $ret;
    }
    public function getLesDemandesRemboursement($idDelegue = null)
    {
        $lesDemandes = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT CONCAT(pharmacie.nom, ', ', pharmacie.adresse, ', ', ville_france.ville_nom_simple) AS Pharmacie, CONCAT(utilisateur.nom, ' ', utilisateur.prenom) AS Délegué, commentaire AS Commentaire FROM deplacement_pharmacie
        JOIN pharmacie ON pharmacie.id = deplacement_pharmacie.pharmacie_id
        JOIN ville_france ON ville_france.ville_id = pharmacie.id_ville
        JOIN Utilisateur ON utilisateur.id = deplacement_pharmacie.id_delegue");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $uneDemande = new DemandeRemboursement(
                $enreg->id,
                $enreg->date_saisie,
                $enreg->montant,
                $enreg->commentaire,
                new TypeFrais(null, $enreg->libelle),
                null
            );
            array_push($lesDemandes, $uneDemande);
        }
        return $lesDemandes;
    }
}
