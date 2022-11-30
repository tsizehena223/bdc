<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="../css/head.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="shortcut icon" href="../images/logo/logo_princ.png" type="image/x-icon">

    <meta charset="utf-8">
    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../plugins/slick/slick.css">
    <link rel="stylesheet" href="../plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="../plugins/fancybox/jquery.fancybox.min.css">
    <link rel="stylesheet" href="../plugins/aos/aos.css">
    <link href="../css/style.css" rel="stylesheet">
    <style>
        body {
            background-color: #140522;
        }

        .register .nav-tabs .nav-link:hover {
            border: none;
        }

        .text-align {
            margin-top: -3%;
            margin-bottom: -9%;

            padding: 10%;
            margin-left: 30%;
        }

        .form-new {
            margin-right: 22%;
            margin-left: 20%;
        }

        .register-heading {
            margin-left: 30%;
            margin-bottom: 10%;
            color: #e9ecef;
        }

        .register-heading h1 {
            margin-left: 21%;
            margin-bottom: 10%;
            color: #e9ecef;
        }

        .btnLoginSubmit {
            border: none;
            padding: 2%;
            width: 25%;
            cursor: pointer;
            background: #29abe2;
            color: #fff;
        }

        .register {
            background: -webkit-linear-gradient(right, blue, rgb(27, 26, 26), black, rgb(27, 26, 26), #5f0ba3);
            margin-top: 5%;
            padding: 3%;
            border-radius: 2.5rem;
        }

        .nav-tabs .nav-link {
            border: 1px solid transparent;
            border-top-left-radius: .25rem;
            border-top-right-radius: .25rem;
            color: white;
        }

        .navibar {
            padding: 1%;
            background: rgba(14, 05, 22, 1);
            position: relative;
            z-index: 100;
            top: 0;
        }

        .navibar img {
            border: 1px solid transparent;
            border-radius: 50%;
            height: 3.5em;
        }
    </style>

    <div class="navibar">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid m-lg-auto">
                <a href="../index.php" class="navbar-brand"><img src="../images/logo/logo.png"></a>
                &nbsp; &nbsp;
                <!-- J'AI ENLEVE LES SPAN BOUTTONS -->
                <!-- <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collaKpse navbar-collKapse" id="navbarCCollapse">
                    <div class="navbar-nav ms-auto">
                        <ul class="navbar-nav heyhey form-group">
                            <?php if (isset($_SESSION['id'])) { ?>
                                <a href="../views/accueil.php" class="accueil btn btn-outline-info" style="width: 5em;">
                                    <i class="ti-home"></i>
                                    <small><i id="accueil">Accueil</i></small>
                                </a> &nbsp; &nbsp;
                                <a href="../controllers/deconnexion.php" class="deconnex btn btn-outline-danger" style="width: 7em;">
                                    <i class="fa fa-sign-out"></i>
                                    <center><small><i id="deconnex">Déconnexion</i></small></center>
                                </a> &nbsp; &nbsp;
                                <a href="../views/profil.php" class="profil btn btn-outline-success" style="width: 5em;">
                                    <i class="ti-user"></i>
                                    <small><i id="profil">Profil</i></small>
                                </a>
                            <?php } else { ?>
                                <a href="../views/inscription.php" class="inscri btn btn-outline-info" style="width: 7em;">
                                    <i class="fa fa-sign-in"></i>
                                    <small><i id="inscri">S'inscrire</i></small>
                                </a> &nbsp; &nbsp;
                                <a href="../views/connexion.php" class="connect btn btn-outline-light" style="width: 8em;">
                                    <i class="fa fa-user"></i>
                                    <small><i id="connect">Se connecter</i></small>
                                </a>
                            <?php }; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

</head>