<?php
require_once 'databases.php';


$novosts = mysqli_query($connect, "SELECT * FROM `news`" );
$bd_novosts = array();
while ($bd = mysqli_fetch_assoc($novosts)){
    $bd_novosts[] = $bd;
}



$sentencess = mysqli_query($connect, "SELECT
sentences.text as texts, sentences.tonality as tonalitys,
news.url as urls
FROM sentences
JOIN news ON news.id = sentences.idnews" );
$bd_sentencess = array();
while ($bd = mysqli_fetch_assoc($sentencess)){
    $bd_sentencess[] = $bd;
}

$nametosents = mysqli_query($connect, "SELECT
sentences.text as texts, names.name as names, news.url as urls
FROM sentences
JOIN nametosent ON nametosent.idsent = sentences.id
JOIN names ON names.id = nametosent.idname
JOIN news ON news.id = sentences.idnews" );
$bd_nametosents = array();
while ($bd = mysqli_fetch_assoc($nametosents)){
    $bd_nametosents[] = $bd;
}

$attrtosents = mysqli_query($connect, "SELECT
sentences.text as texts, attractions.name as names, news.url as urls
FROM sentences
JOIN attrtosent ON attrtosent.idsent = sentences.id
JOIN attractions ON attractions.id = attrtosent.idattr
JOIN news ON news.id = sentences.idnews" );
$bd_attrtosents = array();
while ($bd = mysqli_fetch_assoc($attrtosents)){
    $bd_attrtosents[] = $bd;
}

?>