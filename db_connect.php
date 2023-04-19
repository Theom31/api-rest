<?php
function connectDB()
{
    $connection = null;
    try{
        $host = 'localhost';
        $data ='projet bdd';
        $username = 'root';
        $password = 'mysql';

        $connection = new PDO(
            "mysql:host=" . $host . ";dbname=" . $data,
            $username,
            $password,
            array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (PDOException $e) {
        // Afficher un message d'erreur ou journaliser l'erreur si nécessaire
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }

    return $connection;
}


?>