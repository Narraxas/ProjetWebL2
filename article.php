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
        if (isset($_GET["idProduit"])) {
            $reqSql = 'SELECT * FROM produits WHERE idProduit = "' . $_GET['idProduit'] . '"';
            $req = $connection->prepare($reqSql);
            $req->execute();
            $produits = $req->fetchAll();
            foreach ($produits as $produit) {
                echo '<div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8 row">
                            <div class="col-sm-4">
                                <img class="image_article" src="' . $produit["photo"] . '">
                            </div>
                            <div id="article_container" class="col-sm-8">
                                <div id="nom_article">' . $produit["nom"] . '</div>
                                <div id="marque_article">Marque: ' . $produit["marque"] . '</div><br />
                                <div id="description_article"><strong>Description:</strong> ' . $produit["descriptif"] . '</div>
                                <div id="prix_article"><strong>Prix:</strong> ' . $produit["prix"] . '€</div><br />
                                <div id="stock_article">Stock restant: ' . $produit["stock"] . '</div>
                                <form method="post" action="?idProduit=' . $produit["idProduit"] . '&ajoutPanier">
                                <button type="submit" class="center btn btn-primary"><strong>Ajouter au panier</strong></button>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-2"></div>
                </div>';
            }
            if (isset($_GET["ajoutPanier"])) {
                if (isset($_SESSION["UTILISATEUR_CONNECTE"])) {
                    echo '<div class="alert alert-success" role="alert">
                    Article ' . $produit["nom"] . ' ajouté au panier avec succès!
                    </div>';
                    $reqSql = 'SELECT * FROM commandes';
                    $req = $connection->prepare($reqSql);
                    $req->execute();
                    $commandes = $req->fetchAll();
                    foreach ($commandes as $commande) {
                        if ($commande["etat"] === "0") {
                            $_SESSION["commandeActuelle"] = $commande;
                            $commandeEnCours = true;
                            break;
                        }
                    }
                    if (!isset($commandeEnCours)) {
                        $reqSql = 'INSERT INTO commandes (idCommande, date_c, email, etat) VALUES (?, ?, ?, ?)';
                        $req = $connection->prepare($reqSql);
                        $req->execute([0, "2021", $_SESSION["UTILISATEUR_CONNECTE"], 0]);
                        $reqSql = 'SELECT * FROM commandes';
                        $req = $connection->prepare($reqSql);
                        $req->execute();
                        $commandes = $req->fetchAll();
                        foreach ($commandes as $commande) {
                            if ($commande["etat"] === 0) {
                                $_SESSION["commandeActuelle"] = $commande;
                                break;
                            }
                        }
                    }
                    $reqSql = 'SELECT * FROM produits WHERE idProduit = ' . $_GET['idProduit'];
                    $req = $connection->prepare($reqSql);
                    $req->execute();
                    $produitCommande = $req->fetchAll();
                    foreach ($produits as $ajoutCommande) {
                        $reqSql = 'INSERT INTO lignesCommandes (idLigneCommande, idCommande, idProduit, quantite, montant) VALUES (?, ?, ?, ?, ?)';
                        $req = $connection->prepare($reqSql);
                        $req->execute([0, $_SESSION["commandeActuelle"]["idCommande"], $ajoutCommande["idProduit"], 1, $ajoutCommande["prix"]]);
                    }
                } else {
                    header('Location: /login.php');
                    exit();
                }
            }
        }
        include_once("footer.php");
        ?>
    </body>
</html>