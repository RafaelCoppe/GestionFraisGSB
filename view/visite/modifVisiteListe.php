<!-- code html de la page-->
<h1 class="text-center">Modification d'une Visite</h1>
<form action="index.php?action=modifVisiteForm" method='post'>
    <div class="row mb-3">
        <?php
        if (count($lesVisites) == 0) {
            echo ("Vous n'avez saisi aucune visite");
        } else {
        ?>
            <label for="lesVis" class="col-lg-4 col-form-label">Choisissez la visite à modifier</label>
            <div class="col-sm-12">
                <!-- liste déroulante -->
                <select class="form-select form-select-md" onChange="submit();" name="listVisite">
                <option value=""></option>
                    <?php foreach ($lesVisites as $uneVisite) {
                        $id = $uneVisite->getId();
                        $Visite = $uneVisite->getCommentaire() . ' , Medecin : ' . $uneVisite->getMedecin()->getNom().' '.$uneVisite->getMedecin()->getPrenom().' le ' . $uneVisite->getDate();
                        if (isset($_POST['listVisite']) == true && $_POST['listVisite'] == $id)
                            echo ("<option selected value=$id>$Visite</option>");
                        else
                            echo ("<option value=$id>$Visite</option>");
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