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
        <?php include_once("header.php");
        try {
            $dbName = 'hard_discounter';
            $host = 'localhost';
            $utilisateur = 'root';
            $motDePasse = 'root';
            $port='3306';
            $dns = 'mysql:host='.$host .';dbname='.$dbName.';port='.$port;
            $connection = new PDO( $dns, $utilisateur, $motDePasse);
        } catch ( Exception $e ) {
            echo "Connection à la BDD impossible : ", $e->getMessage();
            die();
        }
        $reqSql = 'SELECT * FROM produits WHERE categorie="portable"';
        $req = $connection->prepare($reqSql);
        $req->execute();
        $produits = $req->fetchAll();
        echo '<div class="produit_container">';
        $i = 0;
        foreach ($produits as $produit) {
            if ($i === 0) {
                echo '<div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 row">';
            }
            echo '<div class="col-sm-3 article"><div class="text-center"><img class="img_article" src="./' . $produit["photo"] . '"></div><div class="text-center nom_article">' . $produit["nom"] . '</div><div class="text-center prix_article">' . $produit["prix"] . '€</div></div>';
            $i++;
            if ($i === 4) {
                echo '</div>
                <div class="col-sm-1"></div>
                </div>';
                $i = 0;
            }
        }
        echo '</div></div></div>';
        include_once("footer.php"); ?>
    </body>
</html>