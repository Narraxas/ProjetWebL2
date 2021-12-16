
<header id="header">
    <div class="row">
        <a id="logo" class="col-sm-1" href="/index.php"><img class="img-fluid img-thumbnail" src="assets/logo.jpeg"></a>
        <div class="col-sm-8">
            <br>
            <h1 id="titre_acceuil">Hard Discounter</h1>
            <h2 id="sous_titre_acceuil">Votre magasin en ligne</h2>
        </div>
        <?php if (!isset($_SESSION["UTILISATEUR_CONNECTE"])): ?>
            <div class="col-sm-1"></div>
            <div class="col-sm-1">
                <a href="/login.php"><input type="button" id="btn_connexion" class="img-thumbnail buttons" value="Se connecter"></button></a>
            </div>
        <?php else: ?>
            <div class="col-sm-1">
                <a href="/deconnection.php"><input type="button" id="btn_deconnexion" class="img-thumbnail buttons" value="Se Déconnecter"></button></a>
            </div>
            <div class="col-sm-1">
                <a href="/panier"><img id="img_panier" src="assets/panier.png"></a>
            </div>
        <?php endif; ?>
        <div class="col-sm-1"></div>
    </div>
    <nav id="main_nav" class="row">
        <div class="col-sm-2"></div>
        <a class="col-sm-2 nav_link" href="/portables.php"><h5>Portables</h5></a>
        <a class="col-sm-2 nav_link" href="/tablettes.php"><h5>Tablettes</h5></a>
        <a class="col-sm-2 nav_link" href="/mobiles.php"><h5>Smartphones</h5></a>
        <a class="col-sm-2 nav_link" href="/produits.php"><h5>Tous les produits</h5></a>
        <div class="col-sm-2"></div>
    </nav>
</header>