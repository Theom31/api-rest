<?php 

$url = "http://localhost/API%20REST/matchs/matchs.php";
$data = array ('id_matchs'=>'35','datematch'=>'2025-06-05','scoreequipe1'=>'3','scoreequipe2'=>'2','id_tournoi'=>'2','id_equipe1'=>'1','id_equipe2'=>'2');
$ch =curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST,"POST");
curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($data));
$response = curl_exec($ch);
var_dump($response);
if(!$response){
    return false;
}

?>