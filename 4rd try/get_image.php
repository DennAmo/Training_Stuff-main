<?php
$servername = "localhost";
$username = "id21203121_builds";
$password = "Blablacar11*/";
$dbname = "id21203121_builds";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT buildImage FROM builds WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    
    header("Content-Type: image/jpeg"); 
    echo $image;
    
    $stmt->close();
}

$conn->close();
?>