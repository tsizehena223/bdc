<?php
include '../includes/head.php';
require_once '../controllers/start_bdd.php';

//RECUPERATION INFO USERS
$request = $bdd->prepare('SELECT * FROM bdc.user_info WHERE id_user = ?');
$request->execute([$_SESSION['id']]);
$res = $request->fetch();

if ($res != null) {
    $fonction = $res['fonction'];
    $phone = $res['phone_number'];
    $git = $res['git'];
}

//RECUPERATION PHOTO DE PROFIL

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

                    <div class="col-md-6 order-2 order-md-1 text-center text-md-left text-white">
                        <!-- template -->
                        <!-- <section class="vh-100" style="background-color: black;"> -->
                        <div class="container py-5 h-100 order-1">
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col col-lg-12 mb-4 mb-lg-0">
                                    <div class="card mb-3" style="border-radius: 20px;">
                                        <div class="row g-0">
                                            <div class="col-md-4 gradient-custom text-center profil1 text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                                <!-- <img src="../images/user.jpg" alt="Avatar" class="img-fluid my-5" style="width: 80px; border-radius: 50%" /> -->
                                                <img src="../controllers/affichage_pdp.php?id=<?= $_SESSION['id'] ?>" class="img-fluid my-5" style="width: 80px; border-radius: 50%" />
                                                <a href="../controllers/add_pdp.php"><i class="fa fa-camera" style="color: yellow; position: absolute; top: 7em; left: 7.5em;"></i></a>
                                                <h5 class="text-white"><?= $name ?></h5>
                                                <code>
                                                    <?php if (isset($fonction)) echo $fonction;
                                                    else echo "------" ?>
                                                </code> <br> <br>
                                                <a href="../controllers/modif_profil.php"><i class="far fa-edit mb-5"></i></a>
                                            </div>
                                            <div class="col-md-8 profil2 text-white">
                                                <div class="card-body p-4">
                                                    <h6 class="text-white">Information</h6>

                                                    <hr class="mt-0 mb-4">

                                                    <div class="row pt-1">
                                                        <div class="col-12 mb-4">
                                                            <h6 class="text-white">Email</h6>
                                                            <p class="text-white"><small class="mail"><?= $_SESSION['email'] ?></small></p> <br>
                                                            <h6 class="text-white">Phone</h6>
                                                            <p class="text-white">
                                                                <?php if (isset($phone)) echo $phone;
                                                                else echo "-------" ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <hr class="mt-0 mb-4">

                                                    <div class="row justify-content-start">
                                                        <div>
                                                            <i class="fab fa-github fa-lg me-3"></i> &nbsp;
                                                            <small class="mail">
                                                                <?php if (isset($git)) echo $git;
                                                                else echo "-------" ?>
                                                            </small>
                                                        </div>

                                                    </div> <br>

                                                    <hr class="mt-0 mb-4">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- </section> -->
                        <!-- FIN TEMPLATE  -->
                    </div>

                    <div class="col-md-6 text-center order-2 order-md-2">
                        <img class="img-fluid" src="../images/logo/pc.png"> <br>
                        <a href="../controllers/modif_profil.php" class="btn btn-outline-info">Modifier</a>
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
    <?php } ?>

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