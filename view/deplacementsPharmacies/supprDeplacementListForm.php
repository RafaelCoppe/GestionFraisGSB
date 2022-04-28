<!-- code html de la page-->
<h1 class="text-center">Suppression d'une demande de remboursement</h1>
<form action="index.php?action=supprDepPharmaTrait" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDeplacements) == 0) {
            echo ("Vous n'avez saisi aucune demande");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez la demande à supprimer</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" name="idDepPharma">
                <option value=""></option>
                <?php foreach ($lesDeplacements as $unDeplacement) {
                    $id = $unDeplacement->getId();
                    $lib = "Date : " . $unDeplacement->getDate() . "&emsp;&emsp;Déplacement : " . $unDeplacement->getLaPharmacie()->getNom() . ", " . $unDeplacement->getLaPharmacie()->getAdresse() . ", " . $unDeplacement->getLaPharmacie()->getLaVille()->getCodePostal() . " " .  $unDeplacement->getLaPharmacie()->getLaVille()->getNom() . " par " . $unDeplacement->getDelegue()->getNom() . " " . $unDeplacement->getDelegue()->getPrenom();
                    if (isset($_POST['deplacement']) == true && $_POST['deplacement'] == $unDeplacement->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
                </select>
            </div>
        <?php
        }
        ?>
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

        