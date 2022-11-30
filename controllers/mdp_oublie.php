<?php
include '../includes/head.php';

function token_random_string($leng = 20)
{
    $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $token = '';
    for ($i = 0; $i < $leng; $i++) {
        $token .= $str[rand(0, strlen($str) - 1)];
    }
    return $token;
}

if (isset($_POST['reinitialisation'])) {
    if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $message = "Email invalid";
    } else {
        require_once 'start_bdd.php';

        $req = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $req->execute([$_POST['email']]);
        $result = $req->fetch();
        $nombre = $req->rowCount();

        if ($nombre != 1) {
            $message = "Email ne correspond à aucun membre!";
        } else {
            if ($result['valid'] != 1) { //MAIL PAS ENCORE VALIDE

                $token = token_random_string(7);

                $update = $bdd->prepare('UPDATE users SET token = ? WHERE email = ?');
                $update->execute([$token, $_POST['email']]);

                //RENVOI DU MAIL
                $to = $_POST['email'];
                $subject = "Confirmation d'inscription";
                $headers = "Content-Type: text/html; charset=utf-8\r\n";
                $headers .= "From: tsizehena223@gmail.com\r\n";
                $link = '<a href="http://localhost:8000/controllers/verification.php?email=' . $_POST['email'] . '&token=' . $token . '"><b>ici</></a>';
                $contents = 'Afin de valider votre inscription avec cette adresse email, merci de cliquer ' . $link;
                if (mail($to, $subject, $contents, $headers)) {
                    $message_info = "Votre email n'est pas encore confirmé : merci de cliquer sur le lien envoyé à votre adresse email";
                } else {
                    $message = "Il y a une erreur !";
                }
            } else {
                //MAIL DEJA VALIDE
                $token = token_random_string(7);

                $req1 = $bdd->prepare('SELECT * FROM psw_reset WHERE email = ?');
                $req1->execute([$_POST['email']]);

                $nbr1 = $req1->rowCount();

                //SI TOKEN N'EST JAMAIS MIS A JOUR
                if ($nbr1 == 0) {
                    $req2 = $bdd->prepare('INSERT INTO psw_reset (email, token) VALUES (?, ?)');
                    $req2->execute([$_POST['email'], $token]);
                } else { // TOKEN EST DEJA A JOUR AU MOINS UNE FOIS
                    $req3 = $bdd->prepare('UPDATE psw_reset SET token = ? WHERE email = ?');
                    $req3->execute([$token, $_POST['email']]);
                }

                //RENVOI DU MAIL
                $to = $_POST['email'];
                $subject = "Réinitialisation du mot de passe";
                $headers = "Content-Type: text/html; charset=utf-8\r\n";
                $headers .= "From: tsizehena223@gmail.com\r\n";
                $link = '<a href="http://localhost:8000/controllers/new_password.php?email=' . $_POST['email'] . '&token=' . $token . '"><b>Réinitialiser mon mdp</></a>';
                $contents = 'Afin de réinitaliser votre mot de passe, merci de cliquer ' . $link;
                if (mail($to, $subject, $contents, $headers)) {
                    $message_info = "Pour réinitialiser votre mdp: merci de cliquer sur le lien envoyé à votre adresse email";
                } else {
                    $message = "Il y a une erreur !";
                }
            }
        }
    }
}
?>

<title>BDC | Forgotten Password</title>

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

                <?php if (isset($message_info)) { ?>
                    <div class="message alert alert-info"><?= $message_info ?></div>
                <?php } ?>

                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <center>
                        <h2 style="color: white; ">Réinitialisation de MdP</h2> <br>
                        <p>Entrer votre adresse email afin de réinitaliser votre mot de passe.</p> <br>
                    </center>
                    <form method="post">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Votre adresse email *" value="" />
                        </div> <br>
                        <center>
                            <div class="form-group">
                                <input type="submit" name="reinitialisation" class="btn btn-outline-info btn-md" value="Réinitialiser" />
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