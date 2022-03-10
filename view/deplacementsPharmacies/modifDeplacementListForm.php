<!-- code html de la page-->
<h1 class="text-center">Modification d'une demande de remboursement</h1>
<form action="index.php?action=modifDepPharmaForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDeplacements) == 0) {
            echo ("Vous n'avez saisi aucune demande");
        } else {
        ?>
            <label for="lesDem" class="col-lg-4 col-form-label">Choisissez la demande à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="deplacement">
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
</form>

<?php
if (isset($msg)) echo $msg;
?>

        