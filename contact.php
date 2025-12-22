<?php
// Connexion MySQL
$host = "localhost:3306";
$dbname = "franckys_contactdb";
$username = "franckys_contactuser"; 
$password = "0994699173Francky";    

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier la soumission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom     = $_POST["nom"] ?? null;
    $email   = $_POST["email"] ?? null;
    $sujet   = $_POST["sujet"] ?? null;
    $message = $_POST["message"] ?? null;

    // Ajout dans la base
    $sql = "INSERT INTO contact_messages (nom, email, sujet, message, date_envoi)
            VALUES (:nom, :email, :sujet, :message, NOW())";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nom" => $nom,
        ":email" => $email,
        ":sujet" => $sujet,
        ":message" => $message
    ]);

    // REDIRECTION APRÈS SUCCÈS
    header("Location: success.php");
    exit();
}
?>
