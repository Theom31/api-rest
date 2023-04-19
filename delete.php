<?php
$url="http://localhost/API%20REST/produits.php/1";
$ch =curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "DELETE");
$reponse=curl_exec($ch);
var_dump($reponse);
if(!$reponse){
    return false;
}

