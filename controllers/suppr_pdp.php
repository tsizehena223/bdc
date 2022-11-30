<?php
require_once 'start_bdd.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$suppr = $bdd->prepare('DELETE FROM photo_user WHERE id_user = ?');
$suppr->execute([$_SESSION['id']]);

if ($suppr) {
    $_SESSION['flash'] = "Success !";
} else {
    $_SESSION['flash'] = "Erreur !";
}
header('location: ../views/profil.php');
