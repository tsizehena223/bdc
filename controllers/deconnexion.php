<?php
session_start();

if (isset($_SESSION['id'])) {
    session_unset();
    session_destroy();
    header('location: ../index.php');
} else {
    include '../includes/head.php'; ?>

    <title>BDC | Déconnexion</title>

    <body>
        <div class="alert alert-danger">Vous n'êtes pas connectés!</div>
        <?php include '../includes/foot.php' ?>
    </body>

<?php } ?>