<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(403);
    exit;
}

function clean($v) {
    return trim(strip_tags($v));
}

$nom = clean($_POST['nom'] ?? '');
$email = clean($_POST['email'] ?? '');
$telephone = clean($_POST['telephone'] ?? '');
$type = clean($_POST['type_projet'] ?? '');
$budget = clean($_POST['budget'] ?? '');
$delai = clean($_POST['delai'] ?? '');
$description = clean($_POST['description'] ?? '');

if (!$nom || !$email || !$type || !$description) {
    http_response_code(400);
    echo 'Champs obligatoires manquants';
    exit;
}

$message = "
📌 Nouvelle demande de projet

👤 Nom : $nom
📧 Email : $email
📞 Téléphone : $telephone

🧩 Type de projet : $type
💰 Budget : $budget
⏱️ Délai : $delai

📝 Description :
$description
";

$whatsappUrl = "https://wa.me/243850754604?text=" . urlencode($message);

echo $whatsappUrl;
exit;
