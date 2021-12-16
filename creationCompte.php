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
        <?php include_once("header.php"); ?>
        <?php
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
        $reqSql = 'SELECT * FROM clients';
        $req = $connection->prepare($reqSql);
        $req->execute();
        $clients = $req->fetchAll();
        ?>
        <?php
            if (isset($_POST["email"]) && isset($_POST["motDePasse"])) {
                foreach ($clients as $client) {
                    if ($client["email"] === $_POST["email"] && $client["motDePasse"] === $_POST["motDePasse"]) {
                        $messageErreur = sprintf("Adresse email déjà utilisée : %s", $_POST["email"]);
                        $compteExistant = true;
                    }
                }
                if (!isset($compteExistant)) {
                    $reqSql = 'INSERT INTO clients (email, motDePasse, nom, prenom, ville, adresse, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)';
                    $req = $connection->prepare($reqSql);
                    $req->execute([$_POST["email"], $_POST["motDePasse"], $_POST["nom"], $_POST["prenom"], $_POST["ville"], $_POST["adresse"], $_POST["telephone"]]);
                    $_SESSION["UTILISATEUR_INSCRIT"] = $_POST["email"];
                }
            }
        ?>

        <?php if (!isset($_SESSION["UTILISATEUR_INSCRIT"])): ?>
            <form action="creationCompte.php" method="post">
                <?php if (isset($messageErreur)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $messageErreur; ?>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <br />
                        <br />
                        <h2 class="text-center">Créer un compte</h2>
                        <hr />
                        <br />
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control" placeholder="Adresse mail">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="password" name="motDePasse" class="form-control" placeholder="Mot de passe">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="text" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="text" name="prenom" class="form-control" placeholder="Prénom">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <input type="text" name="ville" class="form-control" placeholder="Ville">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <input type="text" name="adresse" class="form-control" placeholder="Adresse">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <input type="text" name="telephone" class="form-control" placeholder="Telephone">
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="text-center">
                    <br />
                    <button type="submit" class="center btn btn-primary">S'inscrire</button>
                    <br />
                    <div>Vous avez déjà un compte ? <a id="connection_link" href="login.php">Connexion</a></div>
                    <br />
                </div>
            </form>
            <br />
        <?php else: ?>
        <div class="alert alert-success" role="alert">
            Bienvenue <?php echo $_POST["email"]; ?> !
            Création de compte réussie.
        </div>
        <div class="text-center">
            <br />
            <br />
            <form method="get" action="/index.php">
                <button type="submit" class="center btn btn-primary">Retour à l'accueil</button>
            </form>
            <br />
            <br />
        </div>
        <?php endif; ?>
        <?php include_once("footer.php"); ?>
    </body>
</html>