<html>
    <head>
        <title id="titre">Hard Discounter - Facture</title>
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
            include("data.php");
            $catalogue = getCatalogue();
            echo "<br><h1>Facture</h1><br>";
            print '<div class="row">
                        <div class="col-sm-1"></div>
                        <div class="row col-sm-10">
                            <div class="col-sm-2 text-center align-self-center"><h3>Quantité</h3></div>
                            <div class="col-sm-2 align-self-center"><h3>Image</h3></div>
                            <div class="col-sm-2 align-self-center"><h3>Nom</h3></div>
                            <div class="col-sm-2 text-center align-self-center"><h3>Prix Unitaire HT</h3></div>
                            <div class="col-sm-2 text-center align-self-center"><h3>T.V.A.</h3></div>
                            <div class="col-sm-2 text-center align-self-center"><h3>T.T.C.</h3></div>
                        </div>
                        <div class="col-sm-1"></div>
                    </div><hr><br>';
            foreach ($_GET as $nomP => $valeurP) {
                if (!empty($valeurP) && $nomP != "submit_button") {
                    $article = getArticle($catalogue, $nomP);
                    print '<div class="row">
                                <div class="col-sm-1"></div>
                                <div class="row col-sm-10">
                                    <div class="col-sm-2 text-center align-self-center">' . $valeurP . '</div>
                                    <div class="col-sm-2 align-self-center"><img src="./assets/' . $article["id"] . '.jpg" class="img-fluid"></div>
                                    <div class="col-sm-2 align-self-center">' . $article["nom"] . '</div>
                                    <div class="col-sm-2 text-center align-self-center">' . $article["prix"] . '</div>
                                    <div class="col-sm-2 text-center align-self-center">' . round($article["prix"] * 0.25, 2) . '</div>
                                    <div class="col-sm-2 text-center align-self-center">' . $valeurP * ($article["prix"] + round($article["prix"] * 0.25, 2)) . '</div>
                                    <hr>
                                </div>
                                <div class="col-sm-1"></div>
                            </div><br>';
                }
            }
        ?>
    </body>
</html>