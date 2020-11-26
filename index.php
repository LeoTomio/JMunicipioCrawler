<?php 
require "Classes/Noticia.php";
    $call = new Noticia();
    $noticias = $call->listarNoticias();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Noticias</title>
  </head>
  <body>
    <div class="container"><br>    
    
         <h3 align='center'>Lista de Noticias</h3>
        <div class="row row-col-md-4 row-col-sm-2  row-col-1">
            
        <?php
            foreach ($noticias as $noticia):
        ?>
            
           
            <div class="col mb-3">
                <br>
            <div class="card" style="width: 18rem;">
                <img src="<?=$noticia['imagem']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?=$noticia['titulo']?></p>
                        <a href="<?=$noticia['links']?>" class="btn btn-primary">Visualizar</a>
                    </div>
                </div>
            </div>
        <?php 
            endforeach;
        ?>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>


