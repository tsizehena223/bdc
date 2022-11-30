<?php
include('../includes/head.php');
if (isset($_POST['modification']) && isset($_SESSION['id'])) {
    if (!empty($_POST['image'])) {
        $message = "File invalid";
    } else {
        require_once 'start_bdd.php';

        //TESTER SI Y A DEJA DE PHOTOS
        $requ = $bdd->prepare('SELECT * FROM photo_user WHERE id_user = ? LIMIT 1');
        $requ->execute([$_SESSION['id']]);
        $requ->setFetchMode(PDO::FETCH_ASSOC);
        $test = $requ->fetch();

        if ($test != null) {
            $del = $bdd->prepare('DELETE FROM photo_user WHERE id_user = ?');
            $del->execute([$_SESSION['id']]);
        }
        //FIN DE TEST

        $req = $bdd->prepare('INSERT INTO photo_user (nom, taille, types, bin, id_user)
            VALUES (?, ?, ?, ?, ?) ');
        $req->execute([
            $_FILES["image"]["name"],
            $_FILES["image"]["size"],
            $_FILES["image"]["type"],
            file_get_contents($_FILES["image"]["tmp_name"]),
            $_SESSION['id']
        ]);

        $_SESSION['flash'] = "Profil modified successfully"; ?>
        <script>
            location.replace('../views/profil.php')
        </script>
<?php }
}
?>

<title>BDC | Ajout de photo de profil</title>

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
                <?php if (isset($message)) { ?>
                    <div class="message alert alert-danger"><?= $message ?></div>
                <?php } ?>

                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <center>
                        <h2 style="color: white; ">Ajout de photo de Profil</h2> <br>
                    </center>
                    <form enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <input type="hidden" name="MAX_FILE_SIZE" value="2500000" />
                            <label for="pdp">Inserer une image : </label>
                            <input type="file" name="image" id="pdp" class="form-controll" size="50" placeholder="Your pic *" required>
                        </div> <br>
                        <div class="form-group">
                            <input type="submit" name="modification" class="btn btn-info btn-md" value="Valider" />
                            <a href="../views/profil.php" class="btn btn-outline-success btn-md">Retourner au profil</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img class="img-fluid" src="../images/logo/pc.png" alt="screenshot">
                </div>
            </div>
        </div>
    </section>

    <?php include '../includes/foot.php' ?>

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