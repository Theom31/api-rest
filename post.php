<?php 

$url = "http://localhost/API%20REST/produits.php";
$data = array ('id_equipe'=>'6','nomequipe'=>'ERIS','ville'=>'toulouse','pays'=>'France');
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