<?php
include('../includes/head.php');
require_once('start_bdd.php');

if ($_GET) {
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    }
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
    }

    if (!empty($email) && !empty($token)) {
        $requete = $bdd->prepare('SELECT * FROM users WHERE email = ? AND token = ?');
        $requete->execute([$email, $token]);

        $nombre = $requete->rowCount();

        if ($nombre == 1) { //SI LE MAIL EXISTE
            $update = $bdd->prepare('UPDATE users SET valid = :valid, token = :token WHERE email = :email');

            $update->bindValue(':valid', 1);
            $update->bindValue(':token', 'valid');
            $update->bindValue(':email', $email);

            $resulUpdate = $update->execute();

            if ($resulUpdate) {
                echo "<script type=\"text/javascript\">
                alert('Adresse email bien confirmé');
                document.location.href = '../views/connexion.php';
                </script>";
            } else {
                $message_error = "Email non confirmé !";
            }
        }
    }
} else {
    $_SESSION['flash'] = "Vous n'êtes pas connecté-e-s"; ?>
    <script>
        location.replace('../views/connexion.php')
    </script>
<?php } ?>

<title>BDC | Vérification</title>

<body>
    <?php if (isset($message_error)) { ?>
        <div class="alert alert-danger"><?= $message_error ?></div>
    <?php } ?>
</body>