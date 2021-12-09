<!-- code html de la page-->
<h2 class="text-center">Les déplacements en pharmacie</h2>

<?php
if (count($lesDeleguesDepPharma) == 0) {
    echo ("Aucun delegue n'a soumis de deplacement en pharmacie");
} else {
?>
<form action="index.php?action=ConsultDepPharma" method='post'>
    <div class="row mb-3">
        <label for="delegue" class="col-lg-4 col-form-label">Choix du délégué</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->
            <select class="form-select form-select-md" onChange="submit();" name="delegue">
            <option value=""></option>
                <?php foreach ($lesDeleguesDepPharma as $unDelegue) {
                    $id = $unDelegue->getId();
                    $lib = $unDelegue->GetNom() . " " . $unDelegue->GetPrenom();
                    if (isset($_POST['delegue']) == true && $_POST['delegue'] == $unDelegue->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                } ?>
            </select>
        </div>
    </div>

<?php
}
?>