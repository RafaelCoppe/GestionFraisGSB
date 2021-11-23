<h1 class="text-center">Ajout d'un deplacement en pharmacie</h1>
<form action="index.php?action=ajoutDemRembTrait" method='post'>
    <div class="row mb-3">
        <label for="montant" class="col-lg-4 col-form-label">Montant du remboursement</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="montant" value="<?php if (isset($_POST['montant']) == true) echo $_POST['montant']; ?>" id="montant">
        </div>
    </div>
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment">
        </div>
    </div>
    <div class="row mb-3">
        <label for="typeFrais" class="col-lg-4 col-form-label">Type de frais</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="typeFrais">
                <?php foreach ($lesTypesFrais as $unType) {
                    $id = $unType->getId();
                    $lib = $unType->getLibelle();
                    if (isset($_POST['typeFrais']) == true && $_POST['typeFrais'] == $unType->getId())
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