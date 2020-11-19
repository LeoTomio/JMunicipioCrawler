<?php

require './util/JMunicipioCrawler.php';

$Mun = new Municipio();
$link = $Mun->imprimeLink();
$titu = $Mun->imprimeTitulo();
$img = $Mun->imprimeImagem();

print_r("Links : ");
print_r($link);

print_r("Noticia : ");
print_r($titu);

print_r("Link da Imagens : ");
print_r($img);
?>


