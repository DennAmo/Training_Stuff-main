<?php $servername = "localhost";
$username = "id21203121_builds";
$password = "obsoletepassword";
$dbname = "id21203121_builds";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion: " . $conn->connect_error);
}?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Division 2 Builds</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header>
        <h1>
            <span class="d">B</span>
            <span class="m">u</span>
            <span class="e">I</span>
            <span class="o">L</span>
            <span class="e">D</span>
        </h1>

        <nav>
            <ul>
                <li><a href="#module1"><span></span>Send Build</a></li>
                <li><a href="#module2"><span></span>Builds list</a></li>
            </ul>
        </nav>
    </header>
    <main>         
        <section id="module1">
            <h2>Send Build</h2>
                <form action="submit.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="playerName">Nom du joueur:</label>
                    <input type="text" id="playerName" name="playerName" required>
                </div>
                
                <div class="form-group">
                    <label for="buildName">Nom du build:</label>
                    <input type="text" id="buildName" name="buildName" required>
                </div>
                
                <div class="form-group">
                    <label for="buildImage">Image du build:</label>
                    <input type="file" id="buildImage" name="buildImage" accept="image/*" required>
                </div>
                
                <div class="form-group">
                    <label for="buildDetails">Explications du joueur:</label>
                    <textarea id="buildDetails" name="buildDetails" rows="4" required></textarea>
                </div>
                
                <input type="submit" value="Submit">
            </form>
        </section>        
        <section id="module2">
    <h2>Builds List</h2>
    <div id="approvedBuilds">
<?php
$result = $conn->query("SELECT id, playerName, buildName, buildDetails FROM builds");
if ($result === false) {
    die("Erreur SQL : " . $conn->error);
}
while($row = $result->fetch_assoc()) {
    echo '<div class="build-container">';
    
    echo '<div class="build-title" onclick="toggleBuildDetails(this)">';
    echo "<strong>" . $row["playerName"] . "</strong> - " . $row["buildName"];
    echo '</div>';
    echo '<div class="build-details">';
    echo nl2br($row["buildDetails"]) . "<br>";
    echo '<img src="get_image.php?id=' . $row["id"] . '" alt="Build Image" width="500">'; // Vous pouvez encore modifier la largeur si nécessaire
    echo '</div>';
    
    echo "<hr>";
    echo '</div>';
}
?>
    </div>
</section>
        
    </main>

    <footer>
        <p>Copyright Free</p>
    </footer>
 <script> function toggleBuildDetails(element) {
    const details = element.nextElementSibling;
    if (details.style.display === "none" || details.style.display === "") {
        details.style.display = "block";
    } else {
        details.style.display = "none";
    }
}
</script>
</body>

</html>
