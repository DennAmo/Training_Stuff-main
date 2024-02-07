<?php
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "id21203121_builds";
$password = "Blablacar11*/";
$dbname = "id21203121_builds";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $playerName = $_POST["playerName"];
    $buildName = $_POST["buildName"];
    $buildDetails = $_POST["buildDetails"];
    $buildImage = (file_get_contents($_FILES['buildImage']['tmp_name']));

    $stmt = $conn->prepare("INSERT INTO builds (playerName, buildName, buildDetails, buildImage) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $playerName, $buildName, $buildDetails, $buildImage);
    $stmt->execute();
if ($stmt->error) {
    die("Erreur lors de l'insertion : " . $stmt->error);
}
    $stmt->close();
    $conn->close();
    
    header("Location: index.php");
    exit();
}
ob_end_flush();
?>