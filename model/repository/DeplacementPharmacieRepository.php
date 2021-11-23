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
            $req = $db->prepare("insert into deplacements_pharmacie 
            values (0,:par_date_saisie,:par_pharma_nom,:par_pharma_adresse,:par_commentaire,:par_id_delegue)");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date_saisie', $deplacement->getDateSaisie(), PDO::PARAM_STR);
            $req->bindValue(':par_pharma_nom', $deplacement->getNomPharmacie(), PDO::PARAM_STR);
            $req->bindValue(':par_pharma_adresse', $deplacement->getAdressePharmacie(), PDO::PARAM_STR);
            $req->bindValue(':par_commentaire', $deplacement->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_delegue', $deplacement->getIdDelegue(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();
        } catch (PDOException $e) {
            $ret = false;
        }
        return $ret;
    }
    /*public function getMesDemandesRemboursement($idDelegue = null)
    {
        $lesDemandes = array();
        $db = $this->dbConnect();
        $req = $db->prepare("select demande_remboursement.id as id, 
                        DATE_FORMAT(date_saisie, '%d/%m/%Y à %H:%i:%s') as date_saisie, 
                        type_frais.libelle,montant, commentaire
                        from demande_remboursement 
                join type_frais on type_frais.id = id_type_frais
                where id_delegue = " . $idDelegue);
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
    }*/
}
