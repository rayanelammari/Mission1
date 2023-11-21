<!-- Division pour le sommaire -->
<nav class="menuLeft">
    <ul class="menu-ul">
        <li class="menu-item"><a href="index.php">retour</a></li>

        <li class="menu-item">
            Visiteur :<br>
            <?php echo $_SESSION['prenom'] . "  " . $_SESSION['nom'] ?>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=etatFrais&action=selectionnerMois" title="Consultation de mes fiches de frais">Mes
                fiches de frais</a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=cumulfrais&action=montant" title="Etat de tout les frais">
               Mission a</a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=fraisVisiteur&action=visiteur" title="Etat de tout les frais visiteur">
            Mission b</a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=cumulmois&action=mois" title=" Etat de tout les frais par mois">
            Mission c </a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=cumulvisiteur&action=visiteur" title=" Etat de tout les frais par visiteur">
            Mission d </a>
        </li>
        <li class="menu-item">
            <a href="index.php?uc=saisie&action=saisieFrais" title=" Etat de tout les frais par visiteur">
            Mission e </a>
        </li>

        <li class="menu-item">
            <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
        </li>
    </ul>
</nav>
<section class="content">


