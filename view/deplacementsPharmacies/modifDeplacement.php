<h1 class="text-center">Modification d'un deplacement en pharmacie</h1>
<form action="index.php?action=modifDepPharmaTrait" method='post'>
    <div class="row mb-3">
        <label for="pharmacie" class="col-lg-4 col-form-label">Pharmacie visitée</label>
        <div class="col-sm-12">
            <!-- liste déroulante -->            
            <select class="form-select form-select-md" name="pharmacie">
                <?php foreach ($lesPharmacies as $unePharma) {
                    $id = $unePharma->getId();
                    $lib = $unePharma->getNom() . ", " . $unePharma->GetAdresse() . " " . $unePharma->getLaVille()->GetCodePostal() . " " . $unePharma->getLaVille()->GetNom();
                    if (isset($laDepPharmacie) == true && $laDepPharmacie->getLaPharmacie()->getId() == $unePharma->getId())
                        echo ("<option selected value=$id>$lib</option>");
                    else
                        echo ("<option value=$id>$lib</option>");
                }?>
            </select>
        </div>
    </div>

    <?php $_SESSION['idDepPharma'] = $laDepPharmacie->getId();?>

    <div class="row mb-3">
        <label for="date" class="col-lg-4 col-form-label">Date</label>
        <div class="col-sm-12">
            <input type="date" class="form-control" name="date" id="date" value="<?php if ($laDepPharmacie != null) echo substr($laDepPharmacie->getDate(), 0, 10); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="time" class="col-lg-4 col-form-label">Heure</label>
        <div class="col-sm-12">
            <input type="time" step="any" class="form-control" name="time" id="time" value="<?php if ($laDepPharmacie != null) echo substr($laDepPharmacie->getDate(), -8); ?>">
        </div>
    </div>

    <div class="row mb-3">
        <label for="comment" class="col-lg-4 col-form-label">Commentaire</label>
        <div class="col-sm-12">
            <input type="text" class="form-control" name="commentaire" id="comment" value="<?php if ($laDepPharmacie != null) echo $laDepPharmacie->getCommentaire(); ?>">
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