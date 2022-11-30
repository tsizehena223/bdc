<?php
include '../includes/head.php';
require_once '../controllers/start_bdd.php';
?>

<link rel="stylesheet" href="../css/profil.css">
<title>BDC | Profil</title>

<body>
    <?php
    if (isset($_SESSION['id'])) {
        //POUR QUE L'AFFICHAGE SOIR A JOUR APRES LA MODIFICATION
        $req = $bdd->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$_SESSION['id']]);
        $result = $req->fetch();
        $name = $result['pseudo'];
    ?>
        <section class="section gradient-banner">
            <div class="shapes-container">
                <!-- forme arriere plan -->
                <div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
                <div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
                <div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
                <div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
                <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
                <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
                <div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
                <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
                <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
                <div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
                <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
                <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
                <div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
                <div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
                <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
                <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
            </div>
            <div class="container">
                <div class="row align-items-center">

                    <?php if (isset($_SESSION['flash'])) { ?>
                        <div class="alert alert-warning"><?= $_SESSION['flash'] ?></div>
                    <?php unset($_SESSION['flash']);
                    } ?>

                    <center><h3 class="nom text-white">Bonjour <?= $name ?> !</h3></center>
                    <a href="../controllers/modif_profil.php" class="profile btn btn-outline-info">Modifier le profil</a>

                    <div class="col-md-6 order-2 order-md-1 text-center text-md-left text-white">
                        <img class="img-fluid" src="../images/logo/pc.png">
                        <center><a href="#" class="btn btn-outline-success">Compétences acquis</a></center>
                    </div>

                    <div class="col-md-6 text-center order-1 order-md-2">
                        <img class="img-fluid" src="../images/logo/phone.png">
                        <center><a href="#" class="btn btn-outline-warning">Compétences à acquérir</a></center>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../includes/foot.php' ?>

    <?php
    } else {
        $_SESSION['flash'] = "Vous n'êtes pas connecté-e-s";
        // header('location: connexion.php'); 
    ?>
        <script>
            location.replace('connexion.php')
        </script>
    <?php
    }
    ?>

    <!-- To Top -->
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

    <!-- JAVASCRIPTS -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/bootstrap.min.js"></script>
    <script src="../plugins/slick/slick.min.js"></script>
    <script src="../plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="../plugins/syotimer/jquery.syotimer.min.js"></script>
    <script src="../plugins/aos/aos.js"></script>

    <script src="../js/script.js"></script>
</body>

</html>