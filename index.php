<?php

$message = "";
$messageColor = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = urlencode(trim($_POST['email']));
    $password = urlencode(trim($_POST['password']));

    $url = "https://uhqzlpabycxrepisgi.supabase.co/rest/v1/Login?Email=eq.$email&password=eq.$password";

    $headers = [
        "apikey: SERVICE_ROLE_KEY",
        "Authorization: Bearer SERVICE_ROLE_KEY",
        "Content-Type: application/json"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    if (!empty($data)) {
        $message = "Bien connecté ✅";
        $messageColor = "green";
    } else {
        $message = "Email ou mot de passe incorrect ❌";
        $messageColor = "red";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>

<h2>Connexion</h2>

<form method="POST">
    <label>Email :</label><br>
    <input type="text" name="email" required><br><br>

    <label>Mot de passe :</label><br>
    <input type="text" name="password" required><br><br>

    <button type="submit">Se connecter</button>
</form>

<p style="color: <?php echo $messageColor; ?>;">
    <?php echo $message; ?>
</p>

</body>
</html>
