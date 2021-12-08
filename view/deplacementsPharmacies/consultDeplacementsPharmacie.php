<!-- code html de la page-->
<h2 class="text-center">Les déplacements en pharmacie</h2>

<?php
if (count($lesDeplacements) == 0) {
    echo ("Aucun deplacement n'a été saisi");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">date de saisie</th>
                <th scope="col">pharmacie</th>
                <th scope="col">adresse</th>
                <th scope="col">commentaire</th>
                <th scope="col">délegué</th>
            </tr>
        </thead>
        <?php foreach ($lesDeplacements as $unDeplacement) {
            echo ("<tr>");
            echo ("<td>" . $unDeplacement->getdate() . "</td>");
            echo ("<td>" . $unDeplacement->getLaPharmacie()->getNom() . "</td>");
            echo ("<td>" . $unDeplacement->getLaPharmacie()->getAdresse() . ", " . $unDeplacement->getLaPharmacie()->getLaVille()->getCodePostal() . " " .  $unDeplacement->getLaPharmacie()->getLaVille()->getNom() . "</td>");
            echo ("<td>" . $unDeplacement->getCommentaire() . "</td>");
            echo ("<td>" . $unDeplacement->getDelegue()->getNom() . " " . $unDeplacement->getDelegue()->getPrenom() . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>