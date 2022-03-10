<!-- code html de la page-->
<h1 class="text-center">Modification d'une visite</h1>
<form action="index.php?action=modifVisiteTrait" method='post'>
    <input type="hidden" name="idVisite" value="<?php if ($laVisite != null) echo $laVisite->getId(); ?>" <div class="row mb-3">
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" value="<?php if ($laVisite != null) echo $laVisite->getCommentaire(); ?>" id="comment">
        </div>
    </div>
    <div class="row mb-3">
        <label for="date" class="col-lg-4 col-form-label">Date</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="date" value="<?php if ($laVisite != null) echo $laVisite->getDate(); ?>" id="date">
        </div>
    </div>
    <div class="row mb-3">
        <label for="medecin" class="col-lg-4 col-form-label">Médecin</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="medecin">
            <option value=""></option>
                <?php foreach ($lesMedecins as $unMedecin) {
                    $id = $unMedecin->getId();
                    $lib = $unMedecin->getNom().' '. $unMedecin->getPrenom();
                    if($laVisite != null){
                        $idMedVis = $laVisite->getMedecin()->getId();
                    }else{
                        $idMedVis = 0;
                    }
                    if ($id == $idMedVis)
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
            </select>
        </div>
    </div>

    <div class="p-3 mb-4">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
<?php
if (isset($msg)) echo $msg;
?>