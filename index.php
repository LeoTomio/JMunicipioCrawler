<?php

require './util/JMunicipioCrawler.php';

$Mun = new Municipio();
$link = $Mun->imprimeLink();
$titu = $Mun->imprimeTitulo();
$img = $Mun->imprimeImagem();

//print_r("Links : ");
//print_r($link);

//print_r("Noticia : ");
//print_r($titu);

//print_r("Link da Imagens : ");
//print_r($img);


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-xl-4 row-cols-lg-4">  
        <?php 
            for ($i=0; $i < count($titu); $i++):
        ?>
        <div class="col"> 
            <br>           
        <div class="card" style="width: 18rem;">
            
            <img src="<?=$img[$i]?>" class="card-img-top w-100">
            <div class="card-body">
                <p class="card-text"><?= $titu[$i]?></p>
                <a href="<?= $link[$i]?>" class="card-link">Visualizar notícia completa</a>
            </div>
        </div>
        </div>
        <?php 
            endfor;
        ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>


