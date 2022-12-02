<?php
require_once 'start_bdd.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$suppr = $bdd->prepare('DELETE FROM users WHERE id = ?');
$suppr->execute([$_SESSION['id']]);

//JE VAIS PAS ENCORE SUPPRIMER LES INFO CONCERNANT L'USER

if ($suppr) {
    $_SESSION['flash'] = "Success !";
} else {
    $_SESSION['flash'] = "Erreur !";
}

unset($_SESSION['id']);
header('location: ../views/connexion.php');
