<?php
include('../includes/head.php');
if (isset($_POST['modification']) && isset($_SESSION['id'])) {
    if (empty($_POST['username']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['username'])) {
        $message = "Username invalid";
    } elseif (empty($_POST['fonction'])) {
        $message = "Fonction invalid";
    } elseif (empty($_POST['numero'])) {
        $message = "Numéro invalid";
    } elseif (empty($_POST['git'])) {
        $message = "Github invalid";
    } else {
        require_once 'start_bdd.php';

        //TESTER SI LE NOM EST DEJA PRIS
        $req = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req->execute([$_POST['username']]);
        $result = $req->fetch();

        if ($result) {
            $message = "Name already token";
        } else {
            //INSERTION AUTRES INFOS

            //TESTER SI Y A DEJA DES INFOS
            $requ = $bdd->prepare('SELECT * FROM user_info WHERE id_user = ? LIMIT 1');
            $requ->execute([$_SESSION['id']]);
            $requ->setFetchMode(PDO::FETCH_ASSOC);
            $test = $requ->fetch();

            if ($test != null) {
                $del = $bdd->prepare('DELETE FROM user_info WHERE id_user = ?');
                $del->execute([$_SESSION['id']]);
            }
            //FIN DE TEST

            $req = $bdd->prepare('INSERT INTO user_info (fonction, phone_number, git, id_user)
            VALUES (?, ?, ?, ?) ');
            $req->execute([$_POST['fonction'], $_POST['numero'], $_POST['git'], $_SESSION['id']]);

            $requete = $bdd->prepare('UPDATE users SET pseudo = ? WHERE id = ?');
            $requete->execute([$_POST['username'], $_SESSION['id']]);

            $_SESSION['flash'] = "Profil modified successfully"; ?>
            <!-- header('location: ../views/profil.php'); -->
            <script>
                location.replace('../views/profil.php')
            </script>
<?php }
    }
}
?>

<title>BDC | Modification du profil</title>

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
                        <h2 style="color: white; ">Modification du Profil</h2> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="New name" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="number" name="numero" class="form-control" placeholder="Phone number" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="text" name="fonction" class="form-control" placeholder="Your function (eg: dev web)" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="text" name="git" class="form-control" placeholder="Github account" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="submit" name="modification" class="btn btn-info btn-md" value="Modifier" />
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