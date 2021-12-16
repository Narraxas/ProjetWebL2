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
        <form action="http://localhost:8100/server/facture.php" method="GET">
            <?php include("header.php"); ?>
            <main id="main">
                <div class="container">
                    <div class="searchbar">
                        <form class="navbar-form navbar-left col-sm-4" role="search">
                            <div class="row">
                                <div class="col-sm-4"></div>
                                <div class="form-group col-sm-3">
                                    <input type="text" class="form-control" placeholder="Entrer un nom d'article ou une catégorie...">
                                </div>
                                <button type="submit" class="col-sm-1 buttons">Rechercher</button>
                                <div class="col-sm-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <h4 class="text-center">Retrouvez tous nos articles du moment à prix réduits!</h4>
            <div class="row">
                <div class="col-sm-3"></div>
                <div id="carousel" class="carousel slide col-sm-6 text-center" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="./assets/archos.jpg" alt="archos">
                        </div>
                        <div class="carousel-item">
                            <img  src="./assets/asus.jpg" alt="asus">
                        </div>
                        <div class="carousel-item">
                            <img  src="./assets/lenovo.jpg" alt="lenovo">
                        </div>
                        <div class="carousel-item">
                            <img  src="./assets/samsung.jpg" alt="samsung">
                        </div>
                    </div>
                </div>
            </div>
            </main>
            <?php include("footer.php"); ?>
        </form>
        <script>
            $(".carousel").carousel({ interval: 4000 })
        </script>
    </body>
</html>