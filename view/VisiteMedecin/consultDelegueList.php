<!-- code html de la page-->
<h1 class="text-center">Visites chez les medecins</h1>
<form action="index.php?action=consultVisiteMedecin" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesDelegues) == 0) {
            echo ("Vous n'avez saisi aucun delegue");
        } else {
        ?>
            <label for="lesDel" class="col-lg-4 col-form-label">Choisissez le delegue</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listDelegue">
                <option value=""> </option>
                    <?php foreach ($lesDelegues as $unDelegue) {
                        $id = $unDelegue->getId();
                        $nomPrenom = $unDelegue->getNom(). ' '. $unDelegue->getPrenom();
                        
                            echo ("<option value=$id>$nomPrenom</option>");
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