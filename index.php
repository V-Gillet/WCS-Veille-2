<?php

use voku\helper\HtmlDomParser;

require 'vendor/autoload.php';

// initialise la session curl
$curl = curl_init();

// on lui indique l'url à récupérer
curl_setopt($curl, CURLOPT_URL, "https://tenor.com/view/cat-sad-gif-26415220");

// on lui dit qu'on veut le résultat en string
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// on lui dit qu'on veut garder les "locations :" données dans les requêtes http
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

// on exécute la session
$html = curl_exec($curl);

// on ferme la session
curl_close($curl);

//echo ($html);



$htmlDomParser = HtmlDomParser::str_get_html($html);
$sadCats = $htmlDomParser->find(".Gif img");
$sadCatsImgs = [];
foreach ($sadCats as $sadCat) {
    $sadCatsImg = $sadCat->getAttribute("src");
    $sadCatsImgs[] = $sadCatsImg;
}

//var_dump($sadCatsImgs);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="sadCat.css" rel="stylesheet">-->
</head>

<body>
    <?php
    foreach ($sadCatsImgs as $sadCat) : ?>
        <img src=<?= $sadCat; ?> alt="">
    <?php endforeach; ?>
</body>

</html>