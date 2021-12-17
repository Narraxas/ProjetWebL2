<?php session_start(); ?>

<!DOCTYPE html>
<html>
    <head>
        <title id="titre">Hard Discounter</title>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
            include_once("header.php");
            try {
                $dbName = 'hard_discounter';
                $host = 'localhost';
                $utilisateur = 'root';
                $motDePasse = 'root';
                $port='3306';
                $dns = 'mysql:host='.$host .';dbname='.$dbName.';port='.$port;
                $connection = new PDO( $dns, $utilisateur, $motDePasse);
            } catch (Exception $e) {
                echo "Connection à la BDD impossible : ", $e->getMessage();
                die();
            }
            if (isset($_GET["idCommande"])) {
                $reqSql = 'SELECT * FROM lignesCommandes WHERE idCommande =' . $_GET["idCommande"];
                $req = $connection->prepare($reqSql);
                $req->execute();
                $lignesCommandes = $req->fetchAll();
                foreach ($lignesCommandes as $ligne) {
                    $reqSql = 'SELECT * FROM produits WHERE idProduit = "' . $ligne["idProduit"] .'"';
                    $req = $connection->prepare($reqSql);
                    $req->execute();
                    $articles = $req->fetchAll();
                    foreach ($articles as $article) {
                        echo '
                        <br />
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <img class="col-sm-1 image_article_panier" src="' . $article["photo"] . '">
                            <div class="col-sm-2"><br /><br />' . $article["nom"] . '</div>
                            <div class="col-sm-5"><br /><br />' . $article["descriptif"] . '</div>
                            <div class="col-sm-1"><br /><br />' . $ligne["quantite"] . '</div>
                            <div class="col-sm-1"><br /><br />' . $ligne["montant"] * $ligne["quantite"] . '</div>
                            <div class="col-sm-1"></div>
                        </div>
                        <br />
                        <hr />
                        ';
                    }
                }
            } else {
                $reqSql = 'SELECT * FROM commandes WHERE email = "' . $_SESSION["UTILISATEUR_CONNECTE"] . '"';
                $req = $connection->prepare($reqSql);
                $req->execute();
                $commande = $req->fetchAll();
                echo '<br />
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-1"><br /><br /><strong>Numéro de commande</strong></div>
                    <div class="col-sm-4"><br /><br /><strong>Mail du client</strong></div>
                    <div class="col-sm-1"><br /><br /><strong>Date de la commande</strong></div>
                    <div class="col-sm-1"><br /><br /><strong>Etat</strong></div>
                    <div class="col-sm-2"></div>
                    </div>
                    <br />
                    <hr />';
                    foreach ($commande as $ligne) {
                        echo '
                        <br />
                        <form method="post" action="?idCommande=' . $ligne["idCommande"] . '">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-1"><br /><br />' . $ligne["idCommande"] . '</div>
                                <div class="col-sm-4"><br /><br />' . $ligne["email"] . '</div>
                                <div class="col-sm-1"><br /><br />' . $ligne["date_c"] . '</div>
                                <div class="col-sm-1"><br /><br />' . $ligne["etat"]. '</div>
                                <button type="submit" class="center btn btn-primary col-sm-1"><strong>Voir la commande</strong></button>
                                <div class="col-sm-2"></div>
                            </div>
                        </form>
                    <br />
                    <hr />
                    ';
                }
            }
            include_once("footer.php");
        ?>
    </body>
</html>