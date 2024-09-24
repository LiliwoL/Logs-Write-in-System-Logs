<?php
// Fonction pour enregistrer le message dans les logs Apache
function log_message($message, $severity) {
    // Détermine le niveau de log en fonction de la gravité
    switch ($severity) {
        case 'notice':
            $log_level = E_NOTICE;
            break;
        case 'warning':
            $log_level = E_WARNING;
            break;
        case 'error':
            $log_level = E_ERROR;
            break;
        default:
            $log_level = E_NOTICE; // Par défaut, on choisit 'notice'
    }

    // Enregistre le message dans les logs d'Apache
    error_log("[$severity] $message", 0);
}

// Variable pour stocker le message de confirmation
$confirmation_message = "";

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère le message et la gravité
    $message = htmlspecialchars($_POST['message']);
    $severity = htmlspecialchars($_POST['severity']);

    // Enregistre le message dans les logs
    log_message($message, $severity);

    // Définit le message de confirmation
    $confirmation_message = "<p>Le message a été logué avec succès avec une gravité de type <strong>$severity</strong>.</p>";
    $confirmation_message .= "<p>Pour consulter les logs, vérifiez le fichier <code>error.log</code> d'Apache.<br>
    Généralement situé ici : <code>/var/log/apache2/error.log</code> (sur Linux).</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de log</title>
</head>
<body>
<h1>Envoyer un message aux logs d'Apache</h1>

<?php
// Affiche le message de confirmation s'il y en a un
if (!empty($confirmation_message)) {
    echo $confirmation_message;
}
?>

<form method="POST" action="">
    <label for="message">Message :</label><br>
    <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

    <label for="severity">Gravité :</label><br>
    <select id="severity" name="severity" required>
        <option value="notice">Notice</option>
        <option value="warning">Warning</option>
        <option value="error">Error</option>
    </select><br><br>

    <button type="submit">Envoyer</button>
</
