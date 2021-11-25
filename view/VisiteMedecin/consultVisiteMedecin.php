<!-- code html de la page-->
<h2 class="text-center">Visites chez les medecins</h2>

<?php
if (count($lesVisites) == 0) {
    echo ("Vous n'avez saisi aucune visite");
} else {
?>
    <table class="table table-bordered table-lg">
        <thead class="table-light">
            <tr>
                <th class="col">date de saisie</th>
                <th scope="col">commentaire</th>
                <th scope="col">médecin</th>
            </tr>
        </thead>
        <?php foreach ($lesVisites as $uneVisite) {
            echo ("<tr>");
            echo ("<td>" . $uneVisite->getDateSaisie() . "</td>");
            echo ("<td>" . $uneVisite->getCommentaire() . "</td>");
            echo ("<td>" . $uneVisite->getMedecin()->getNom() . ' ' .$uneVisite->getMedecin()->getPrenom() . "</td>");
            echo ("</tr>");
        } ?>
    </table>
<?php
}
?>