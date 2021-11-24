<h1 class="text-center">Ajout d'un deplacement en pharmacie</h1>
<form action="index.php?action=ajoutDepPharmaFormTrait" method='post'>
    <div class="row mb-3">
        <label for="pharmacie" class="col-lg-4 col-form-label">Pharmacie visitée</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="pharmacie">
                <?php foreach ($lesPharmacies as $unePharma) {
                    $id = $unePharma->getId();
                    $lib = $unePharma->getNom() . ", " . $unePharma->GetAdresse() . " " . $unePharma->getLaVille()->GetCodePostal() . " " . $unePharma->getLaVille()->GetNom();
                    if (isset($_POST['pharmacie']) == true && $_POST['pharmacie'] == $unePharma->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
            </select>
        </div>
    </div>
    
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment">
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