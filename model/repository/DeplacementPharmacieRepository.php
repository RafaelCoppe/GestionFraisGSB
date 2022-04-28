<?php

namespace App\model\repository;

use App\model\repository\Repository;
use App\model\entity\{DeplacementPharmacie, Pharmacie, Ville, Utilisateur};
use PDO, PDOException;

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
    public function getLesDeplacementsPharmacie($idDelegue)
    {
        $lesDeplacements = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT deplacement_pharmacie.id AS idDeplacement, deplacement_pharmacie.date, deplacement_pharmacie.commentaire, pharmacie.id, pharmacie.nom AS nomPharmacie, pharmacie.adresse, ville_france.ville_nom AS nomVille, ville_france.ville_code_postal AS CPVille, utilisateur.nom, utilisateur.prenom FROM deplacement_pharmacie
        JOIN pharmacie ON pharmacie.id = deplacement_pharmacie.pharmacie_id
        JOIN ville_france ON ville_france.ville_id = pharmacie.id_ville
        JOIN Utilisateur ON utilisateur.id = deplacement_pharmacie.id_delegue");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unDeplacement = new DeplacementPharmacie(
                $enreg->idDeplacement,
                $enreg->date,
                $unePharmacie = new Pharmacie(
                    $enreg->id,
                    $enreg->nomPharmacie,
                    $enreg->adresse,
                    new Ville(null, null, $enreg->nomVille, $enreg->CPVille)),
                $enreg->commentaire,
                new Utilisateur($idDelegue, $enreg->nom, $enreg->prenom),
                );
            array_push($lesDeplacements, $unDeplacement);
        }
        return $lesDeplacements;
    }
    public function getLesDeplacementsPharmacieDelegue($idDelegue)
    {
        $lesDeplacements = array();
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT deplacement_pharmacie.id AS idDepPharma, deplacement_pharmacie.date, deplacement_pharmacie.commentaire, pharmacie.id, pharmacie.nom AS nomPharmacie, pharmacie.adresse, ville_france.ville_nom AS nomVille, ville_france.ville_code_postal AS CPVille, utilisateur.nom, utilisateur.prenom FROM deplacement_pharmacie
        JOIN pharmacie ON pharmacie.id = deplacement_pharmacie.pharmacie_id
        JOIN ville_france ON ville_france.ville_id = pharmacie.id_ville
        JOIN Utilisateur ON utilisateur.id = deplacement_pharmacie.id_delegue
        WHERE Utilisateur.id = $idDelegue");
        // on demande l'exécution de la requête 
        $req->execute();
        $lesEnregs = $req->fetchAll();
        foreach ($lesEnregs  as $enreg) {
            $unDeplacement = new DeplacementPharmacie(
                $enreg->idDepPharma,
                $enreg->date,
                $unePharmacie = new Pharmacie(
                    $enreg->id,
                    $enreg->nomPharmacie,
                    $enreg->adresse,
                    new Ville(null, null, $enreg->nomVille, $enreg->CPVille)),
                $enreg->commentaire,
                new Utilisateur($idDelegue, $enreg->nom, $enreg->prenom),
                );
            array_push($lesDeplacements, $unDeplacement);
        }
        return $lesDeplacements;
    }
    public function getUnDeplacementPharmacie($idDeplacement, $idDelegue)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT deplacement_pharmacie.id AS idDepPharma, deplacement_pharmacie.date, deplacement_pharmacie.commentaire, pharmacie.id, pharmacie.nom AS nomPharmacie, pharmacie.adresse, ville_france.ville_nom AS nomVille, ville_france.ville_code_postal AS CPVille, utilisateur.nom, utilisateur.prenom FROM deplacement_pharmacie
        JOIN pharmacie ON pharmacie.id = deplacement_pharmacie.pharmacie_id
        JOIN ville_france ON ville_france.ville_id = pharmacie.id_ville
        JOIN Utilisateur ON utilisateur.id = deplacement_pharmacie.id_delegue
        WHERE deplacement_pharmacie.id = $idDeplacement");
        // on demande l'exécution de la requête 
        $req->execute();
        $leEnreg = $req->fetch();
        $leDeplacement = new DeplacementPharmacie(
            $leEnreg->idDepPharma,
            $leEnreg->date,
            $unePharmacie = new Pharmacie(
                $leEnreg->id,
                $leEnreg->nomPharmacie,
                $leEnreg->adresse,
                new Ville(null, null, $leEnreg->nomVille, $leEnreg->CPVille)),
            $leEnreg->commentaire,
            new Utilisateur($idDelegue, $leEnreg->nom, $leEnreg->prenom),
            );
        return $leDeplacement;
    }
    public function modifDeplacementPharmacie(DeplacementPharmacie $depAModifier)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("update deplacement_pharmacie set date = :par_date, pharmacie_id=:par_id_pharmacie, commentaire=:par_commentaire where id = :par_id_deplacement");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_date', $depAModifier->getDate(), PDO::PARAM_STR);
            $req->bindValue(':par_id_pharmacie', $depAModifier->getLaPharmacie()->getId(), PDO::PARAM_INT);
            $req->bindValue(':par_commentaire', $depAModifier->getCommentaire(), PDO::PARAM_STR);
            $req->bindValue(':par_id_deplacement', $depAModifier->getId(), PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }
    }
        public function supprDeplacementPharmacie($idDeplacement)
    {
        $db = $this->dbConnect();
        try {
            // on prépare la requête select
            $req = $db->prepare("DELETE FROM deplacement_pharmacie WHERE id = :par_id");
            // on affecte une valeur au paramètre déclaré dans la requête 
            // récupération de la date du jour 
            $req->bindValue(':par_id', $idDeplacement, PDO::PARAM_INT);
            // on demande l'exécution de la requête 
            $ret = $req->execute();

            $ret = true;
        } catch (PDOException $e) {
            $ret = false;
        }

        return $ret;
    }
}
