<?php

require_once 'db_connect.php';
function getEquipe($id)
{
    $req = connectDB(); // initialize $req as a new PDO object

    if(empty($id)){
        $sql = "SELECT * FROM equipe";
        $stmt = $req->query($sql); // use $req->query() to execute the SQL query
        $result = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        $sql = "SELECT * FROM equipe WHERE id = ?";
        $stmt = $req->prepare($sql); // use $req->prepare() to execute a prepared statement
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

function addEquipe()
{
$_POST = array();
parse_str(file_get_contents('php://input'), $_POST);
$id_equipe = $_POST["id_equipe"];
$nomequipe =$_POST["nomequipe"];
$ville = $_POST["ville"];
$pays =$_POST["pays"];
$sql = "INSERT INTO equipe (id_equipe, nomequipe, ville, pays) VALUES ('$id_equipe', '$nomequipe','$ville', '$pays')";
$req = connectDB()->prepare($sql);
$stmc = $req -> execute();

header('Content_Type: application/json');
if ($stmc) {
    echo json_encode('crée');
}else {
    echo json_encode('echec');
}

}

function updateEquipe($id)
{
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $id_equipe = $_PUT["id_equipe"];
    $nomequipe = $_PUT["nomequipe"];
    $ville = $_PUT["ville"];    
    $pays = $_PUT["pays"];
    $sql = "UPDATE equipe SET id_equipe = '$id_equipe', nomequipe = '$nomequipe', ville = '$ville', pays = '$pays' WHERE id_equipe = '$id_equipe'";
    $req = connectDB()->prepare($sql);
    $stmc = $req -> execute();

    header('Content_Type: application/json');
    if ($stmc){
        echo json_encode('update');
    }else {
        echo json_encode('echec');
    }
}

function deleteEquipe($ville)
{
    $sql = "DELETE FROM equipe WHERE ville = 'toulouse'";
    $resultat= connectDB()->prepare($sql);
    $resultat->bindParam(":ville",$ville);
    $stml = $resultat -> execute();
    if($stml) {
        echo json_encode('delete');
    } else {
        echo json_encode('echec');
    }

    return;
}


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case $method == 'GET' && empty ($_GET["id"]):
        $equipe = getEquipe($id = null);
        $json = json_encode($equipe);

        header('Content-Type: application/json');
        echo $json;
        break;
    case $method == 'GET' && !empty ($_GET["id"]):
        $id = intval($_GET["id"]);
        $equipe = getEquipe($id);
        $json = json_encode($equipe);
        header('Content-Type: application/json');
        echo $json;
        break;
    case $method == 'POST':
        $add = addEquipe();
        $json = json_encode($add);
        break;
    case $method == 'PUT':
        $id = intval($_GET["id"]);
        $json = updateEquipe($id);
        echo $json;
        break;
    case $method == 'DELETE':
            $id = intval($_GET["id"]);
            $delete = deleteEquipe($id);
            $json = json_encode($delete);
            break;
        default:
            break;
}









