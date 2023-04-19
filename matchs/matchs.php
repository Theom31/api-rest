<?php

require_once 'db_connect.php';
function getMatchs($id)
{
    $req = connectDB(); // initialize $req as a new PDO object

    if(empty($id)){
        $sql = "SELECT * FROM matchs";
        $stmt = $req->query($sql); // use $req->query() to execute the SQL query
        $result = $stmt->fetchAll();

        header('Content-Type: application/json');
        echo json_encode($result);
    } else {
        $sql = "SELECT * FROM matchs WHERE id = ?";
        $stmt = $req->prepare($sql); // use $req->prepare() to execute a prepared statement
        $stmt->execute([$id]);
        $result = $stmt->fetch();

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}

function addMatchs()
{
    $_POST = array();
    parse_str(file_get_contents('php://input'), $_POST);
    $id_matchs = $_POST["id_matchs"];
    $datematch = $_POST["datematch"];
    $scoreequipe1 = $_POST["scoreequipe1"];
    $scoreequipe2 = $_POST["scoreequipe2"];
    $id_tournoi = $_POST["id_tournoi"];
    $id_equipe1 = $_POST["id_equipe1"];
    $id_equipe2 = $_POST["id_equipe2"];
    $sql = "INSERT INTO matchs (id_matchs, datematch, scoreequipe1, scoreequipe2, id_tournoi, id_equipe1, id_equipe2) VALUES (:id_matchs, :datematch, :scoreequipe1, :scoreequipe2, :id_tournoi, :id_equipe1, :id_equipe2)";
    $req = connectDB()->prepare($sql);
    $req->bindParam(":id_matchs", $id_matchs);
    $req->bindParam(":datematch", $datematch);
    $req->bindParam(":scoreequipe1", $scoreequipe1);
    $req->bindParam(":scoreequipe2", $scoreequipe2);
    $req->bindParam(":id_tournoi", $id_tournoi);
    $req->bindParam(":id_equipe1", $id_equipe1);
    $req->bindParam(":id_equipe2", $id_equipe2);
    $stmc = $req->execute();

    header('Content_Type: application/json');
    if ($stmc) {
        echo json_encode('crée');
    } else {
        echo json_encode('echec');
    }
}


function updateMatchs($id)
{
    $_PUT = array();
    parse_str(file_get_contents('php://input'), $_PUT);
    $id_matchs = $_PUT["id_matchs"];
    $datematch =$_PUT["datematch"];
    $scoreequipe1 = $_PUT["scoreequipe1"];
    $scoreequipe2 =$_PUT["scoreequipe2"];
    $id_tournoi =$_PUT["id_tournoi"];
    $id_equipe1 =$_PUT["id_equipe1"];
    $id_equipe2 =$_PUT["id_equipe2"];
    $sql = "UPDATE matchs SET id_matchs = '$id_matchs', datematch = '$datematch', scoreequipe1 = '$scoreequipe1', scoreequipe2 = '$scoreequipe2', id_tournoi = '$id_tournoi', id_equipe1 = '$id_equipe1', id_equipe2 = '$id_equipe2' WHERE id_matchs = '$id_matchs'";
    $req = connectDB()->prepare($sql);
    $stmc = $req -> execute();

    header('Content_Type: application/json');
    if ($stmc){
        echo json_encode('update');
    }else {
        echo json_encode('echec');
    }
}

function deleteMatchs($id_matchs)
{
    $sql = "DELETE FROM matchs WHERE id_matchs = '35'";
    $resultat= connectDB()->prepare($sql);
    $resultat->bindParam(":id_matchs",$id_matchs);
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
        $matchs = getMatchs($id = null);
        $json = json_encode($matchs);

        header('Content-Type: application/json');
        echo $json;
        break;
    case $method == 'GET' && !empty ($_GET["id"]):
        $id = intval($_GET["id"]);
        $matchs = getMatchs($id);
        $json = json_encode($matchs);
        header('Content-Type: application/json');
        echo $json;
        break;
    case $method == 'POST':
        $add = addMatchs();
        $json = json_encode($add);
        break;
    case $method == 'PUT':
        $id = intval($_GET["id"]);
        $json = updateMatchs($id);
        echo $json;
        break;
    case $method == 'DELETE':
            $id = intval($_GET["id"]);
            $delete = deleteMatchs($id);
            $json = json_encode($delete);
            break;
        default:
            break;
}









