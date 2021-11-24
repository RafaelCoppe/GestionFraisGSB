<h1 class="text-center">Ajout d'une visite chez le médecin</h1>
<form action="index.php?action=ajoutVisiteMedecinTrait" method='post'>
    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment">
        </div>
    </div>
    <div class="row mb-3">
        <label for="VisiteMedecin" class="col-lg-4 col-form-label">Médecins</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" name="VisiteMedecin">
                <?php foreach ($lesMedecins as $unMedecin) {
                    $id = $unMedecin->getId();
                    $nom = $unMedecin->getNom();
                    $prenom = $unMedecin->getPrenom();
                    if (isset($_POST['lesMedecins']) == true && $_POST['lesMedecins'] == $unMedecin->getId())
                        echo ("<option selected value=$id>$nom $prenom</option>");
                    else
                        echo ("<option value=$id>$nom $prenom</option>");
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