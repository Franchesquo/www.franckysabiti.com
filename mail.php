<?php
// Vérifie que le formulaire a bien été envoyé via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1️⃣ Récupération et nettoyage des données
    $name    = htmlspecialchars(trim($_POST["name"] ?? ''));
    $email   = htmlspecialchars(trim($_POST["email"] ?? ''));
    $subject = htmlspecialchars(trim($_POST["subject"] ?? ''));
    $message = htmlspecialchars(trim($_POST["message"] ?? ''));
    
    // 2️⃣ Validation simple
    $errors = [];
    if ($name === '') {
        $errors[] = "Le champ nom est obligatoire.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse e-mail n'est pas valide.";
    }
    if ($subject === '') {
        $errors[] = "Le sujet est obligatoire.";
    }
    if ($message === '') {
        $errors[] = "Le message ne peut pas être vide.";
    }

    // Si erreurs → affichage
    if (!empty($errors)) {
        echo "<h3>Erreurs dans le formulaire :</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        exit;
    }

    // 3️⃣ Préparation du mail
    $to = "franckysabiti2@gmail.com"; // 🔧 Remplace par ton adresse
    $mail_subject = "📩 Nouveau message de ton site : " . $subject;
    $mail_body = "Nom : $name\n";
    $mail_body .= "Email : $email\n";
    $mail_body .= "Sujet : $subject\n\n";
    $mail_body .= "Message :\n$message\n";
    
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // 4️⃣ Envoi de l'email
    if (mail($to, $mail_subject, $mail_body, $headers)) {
        echo "<p style='color:green;'>Merci $name, ton message a bien été envoyé !</p>";
    } else {
        echo "<p style='color:red;'>Désolé, une erreur est survenue lors de l’envoi. Essaie plus tard.</p>";
    }

} else {
    // Si accès direct sans passer par le formulaire
    echo "<p>Accès non autorisé.</p>";
}
?>
