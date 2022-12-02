<?php
include '../includes/head.php';

if ($_GET) {
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
    }
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
    }

    if (!empty($email) && !empty($token)) { //TEST SI LES GET EXISTENT
        require_once 'start_bdd.php';

        $req = $bdd->prepare('SELECT * FROM psw_reset WHERE email = ? AND token = ?');
        $req->execute([$email, $token]);

        $nombre = $req->rowCount();

        if ($nombre != 1) {
            header('location: ../views/connexion.php');
        } else { // SI ILS EXISTENT
            if (isset($_POST['valider'])) {
                if (!empty($_POST['password']) && !empty($_POST['password2']) && $_POST['password'] == $_POST['password2']) {
                    // MAJ MOT DE PASSE AU NIVEAU DE BD
                    // $psw = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $psw = $_POST['password'];
                    $requete = $bdd->prepare('UPDATE users SET psw = ? WHERE email = ?');
                    $result = $requete->execute([$psw, $email]);

                    if ($result) {
                        echo "<script type=\"text/javascript\">
                        alert('Mot de passe réinitialisé avec succès');
                        document.location.href = '../views/connexion.php';
                        </script>";
                    } else {
                        $message = "Mdp non réinitialisé";
                        header('location: ../views/connexion.php');
                    }
                } else {
                    $message = "Password invalid";
                }
            }
        }
    }
} else {
    $_SESSION['flash'] = "Vous n'êtes pas connecté-e-s"; ?>
    <!-- // header('location: ../views/connexion.php'); -->
    <script>
        location.replace('../views/connexion.php')
    </script>
<?php } ?>

<title>BDC | New Password</title>

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
                        <h2 style="color: white; ">Nouvel Mot de passe</h2> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="New Password *" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="password" name="password2" class="form-control" placeholder="Confirm New Password *" value="" />
                        </div> <br>
                        <center>
                            <input type="submit" name="valider" class="btn btn-info btn-md" value="Valider" />
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