<?php
include('../includes/head.php');

if (isset($_POST['ajouter'])) {
    if (!empty($_POST['title']) && !empty($_POST['type']) && !empty($_POST['descri'])) {
        $title = htmlspecialchars($_POST['title']);
        $type = htmlspecialchars($_POST['type']);
        $descri = htmlspecialchars($_POST['descri']);
        $id_user = $_SESSION['id'];

        require_once 'start_bdd.php';
        $insert = $bdd->prepare('INSERT INTO skills_a_acquerir (title, types, descriptions, id_user, create_time)
        VALUES (?, ?, ?, ?, NOW())');
        $insert->execute([$title, $type, $descri, $id_user]);

        $_SESSION['flash']['success'] = "Compétence insérée avec success";
    } else {
        $_SESSION['flash']['danger'] = "Compétence non insérée ! Veuillez réessayer.";
    }
}
?>

<title>BDC | Ajout de compétence</title>

<body>
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
                <?php if (isset($_SESSION['flash']['danger'])) { ?>
                    <div class="alert alert-danger"><?= $_SESSION['flash']['danger'] ?></div>
                <?php unset($_SESSION['flash']);
                } ?>
                <?php if (isset($_SESSION['flash']['success'])) { ?>
                    <div class="alert alert-success"><?= $_SESSION['flash']['success'] ?></div>
                <?php unset($_SESSION['flash']);
                } ?>
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <center>
                        <h2 style="color: white; ">Ajouter une compétence à acquérir</h2> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <label for="title">Titre : </label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="" />
                        </div> <br>

                        <div class="form-group">
                            <label for="type">Type : </label>
                            <input type="text" name="type" id="type" class="form-control" placeholder="(Savoir / Savoir-Faire / Savoir-être)" value="" />
                        </div> <br>

                        <div class="form-group">
                            <label for="descri">Description : </label> <br>
                            <textarea name="descri" id="descri" cols="30" rows="2" placeholder="Description"></textarea>
                        </div> <br>

                        <center>
                            <div class="form-group">
                                <input type="submit" name="ajouter" class="btn btn-outline-success btn-md" value="Ajouter" /> &nbsp; &nbsp;
                                <a href="../views/accueil.php#aacquérir" class="btn btn-outline-danger btn-sm">Retour</a>
                            </div>
                        </center>
                    </form>
                </div>
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img class="img-fluid" src="../images/logo/pc.png" alt="screenshot">
                </div>
            </div>
        </div>
    </section>

    <?php include '../includes/foot.php' ?>

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