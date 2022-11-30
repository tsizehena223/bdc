<?php
include('../includes/head.php');

if (isset($_POST['inscription'])) {
    if (empty($_POST['username']) || !preg_match('/[a-zA-Z0-9]+/', $_POST['username'])) {
        $message = "Username invalid";
    } elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $message = "Email invalid";
    } elseif (empty($_POST['password']) || $_POST['password'] != $_POST['password2']) {
        $message = "Password invalid";
    } else {
        require_once('../controllers/start_bdd.php');

        $req1 = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
        $req1->execute([$_POST['username']]);
        $result1 = $req1->fetch();

        $req2 = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $req2->execute([$_POST['email']]);
        $result2 = $req2->fetch();

        if ($result1) {
            $message = "Name already token";
        } elseif ($result2) {
            $message = "Email already token";
        } else {

            function token_random_string($leng = 7)
            {
                $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $token = '';
                for ($i = 0; $i < $leng; $i++) {
                    $token .= $str[rand(0, strlen($str) - 1)];
                }
                return $token;
            }

            $token = token_random_string(7);

            // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $password = $_POST['password'];
            $requete = $bdd->prepare('INSERT INTO bdc.users (pseudo, email, psw, token) VALUES (?, ?, ?, ?)');
            $requete->execute([$_POST['username'], $_POST['email'], $password, $token]);

            //ENVOIE D'UN MAIL DE CONFIRMATION

            $to = $_POST['email'];
            $subject = "Confirmation d'inscription";
            $headers = "Content-Type: text/html; charset=utf-8\r\n";
            $headers .= "From: tsizehena223@gmail.com\r\n";
            $link = '<a href="http://localhost:8000/controllers/verification.php?email=' . $_POST['email'] . '&token=' . $token . '"><b>ici</></a>';
            $contents = 'Afin de valider votre inscription avec cette adresse email, merci de cliquer ' . $link;
            if (mail($to, $subject, $contents, $headers)) {
                $message_success = "Merci de cliquer sur le lien envoyé à votre adresse email";
            } else {
                $message = "Il y a une erreur !";
            }
        }
    }
}
?>

<title>BDC | Inscription</title>

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
            <?php if (isset($message)) { ?>
                <div class="message alert alert-danger"><?= $message ?></div> <br> <br>
            <?php }
            if (isset($message_success)) { ?>
                <div class="message alert alert-success"><?= $message_success ?></div> <br> <br>
            <?php } ?>
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <center>
                        <h2 style="color: white; ">Inscription</h2> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Your name *" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Your email *" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Your Password *" value="" />
                        </div> <br>
                        <div class="form-group">
                            <input type="password" name="password2" class="form-control" placeholder="Confirm Password *" value="" />
                        </div> <br>
                        <center>
                            <div class="form-group">
                                <input type="submit" name="inscription" class="btn btn-outline-success btn-md" value="S'inscrire" />
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