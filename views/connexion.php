<?php
include('../includes/head.php');

if (isset($_POST['connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once '../controllers/start_bdd.php';

    $requete = $bdd->prepare('SELECT * FROM bdc.users WHERE email = ?');
    $requete->execute([$email]);
    $result = $requete->fetch();

    if (!$result) {
        $message = "Email doesn't exist";
    } elseif ($result['valid'] == 0) { //MAIL PAS ENCORE CONFIRME
        function token_random_string($leng = 20)
        {
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $token = '';
            for ($i = 0; $i < $leng; $i++) {
                $token .= $str[rand(0, strlen($str) - 1)];
            }
            return $token;
        }

        $token = token_random_string(7);

        $upd = $bdd->prepare('UPDATE users SET token = ? WHERE email = ?');
        $upd->execute([$token, $_POST['email']]);

        //ENVOIE D'UN MAIL DE CONFIRMATION

        $to = $_POST['email'];
        $subject = "Confirmation d'inscription";
        $headers = "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "From: tsizehena223@gmail.com\r\n";
        $link = '<a href="http://localhost:8000/controllers/verification.php?email=' . $_POST['email'] . '&token=' . $token . '"><b>ici</></a>';
        $contents = 'Afin de valider votre inscription avec cette adresse email, merci de cliquer ' . $link;
        if (mail($to, $subject, $contents, $headers)) {
            $message = "Mail pas encore validé. Merci de cliquer sur le lien envoyé à votre adresse email";
        } else {
            $message = "Erreur code !";
        }

        // $message = "Email pas encore confirmé";

    } else { // MAIL DEJA OK

        // $passwordIsOk = password_verify($_POST['password'], $result['psw']);

        $passwordIsOk = false;
        if ($_POST['password'] === $result['psw']) {
            $passwordIsOk = true;
        }

        if ($passwordIsOk) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['pseudo'] = $result['pseudo'];
            $_SESSION['email'] = $result['email'];

            if (isset($_POST['sesouvenir'])) {
                setcookie("email", $_POST['email']);
                setcookie("password", $_POST['password']);
            } else {
                if (isset($_COOKIE['email'])) {
                    setcookie($_COOKIE['email'], '');
                }
                if (isset($_COOKIE['password'])) {
                    setcookie($_COOKIE['password'], '');
                }
            }

            $_SESSION['flash'] = "Connected successfully"; ?>
            <!-- // header("location: profil.php"); -->
            <!-- LA FONCTION HEADER DE PHP A UNE ERREUR DU COUP ON LA REMPLACE PAR UNE DE JS -->

            <script>
                location.replace("accueil.php");
            </script>
<?php
        } else {
            $message = "Error password";
        }
    }
}
?>

<title>BDC | Connexion</title>

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
                <?php }
                if (isset($message_success)) { ?>
                    <div class="message alert alert-success"><?= $message_success ?></div>
                <?php } ?>
                <?php if (isset($_SESSION['flash'])) { ?>
                    <div class="alert alert-warning"><?= $_SESSION['flash'] ?></div>
                <?php unset($_SESSION['flash']);
                } ?>
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <center>
                        <h2 style="color: white; ">Connexion</h2> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your email *" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div>
                        <small style="color: white;"><input type="checkbox" name="sesouvenir"> Remember me</small> <br> <br>
                        <div class="form-group">
                            <input type="submit" name="connexion" class="btn btn-outline-success btn-md" value="Se connecter" /> &nbsp; &nbsp; &nbsp;
                            <small style="color: white;"><a href="../controllers/mdp_oublie.php" class="btn btn-sm btn-outline-danger"> Forgotten Password ?</a></small>
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