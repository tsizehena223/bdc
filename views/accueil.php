<?php
include '../includes/head.php';
require_once '../controllers/start_bdd.php';

//Pagination
$nbr_elem_page = 3;

//MAX DE SAV POUR LIMITER DE NOMBRE DE PAGE

function nbrpage($type)
{
    require '../controllers/start_bdd.php';

    $nbr_sav = $bdd->prepare('SELECT count(id) as nombre_sav FROM list_skills WHERE types = ?');
    $nbr_sav->execute([$type]);
    $nbs = $nbr_sav->fetchAll();
    $nb = $nbs[0]['nombre_sav'];
    return $nb;
}

$nbs = nbrpage("savoirs");
$nbsf = nbrpage("savoir-faire");
$nbse = nbrpage("savoir-etre");

$nbr_pages = max($nbs, $nbsf, $nbse);
$nbr_pages = ceil($nbr_pages / $nbr_elem_page);

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
    if ($page > $nbr_pages || $page < 1) { ?>
        <script>
            location.replace('http://localhost:8000/views/accueil.php?page=1#liste')
        </script>
<?php }
} else {
    $page = 1;
}
//LE DEBUT COMMENCE PAR 0
$debut = ($page - 1) * $nbr_elem_page;

//TABLES LISTE DES COMPETENCES

$savoir = $bdd->prepare('SELECT * FROM list_skills WHERE types = ? LIMIT ' . $debut . ', ' . $nbr_elem_page);
$savoir->execute(["Savoirs"]);

$savF = $bdd->prepare('SELECT * FROM list_skills WHERE types = ? LIMIT ' . $debut . ', ' . $nbr_elem_page);
$savF->execute(["Savoir-Faire"]);

$savE = $bdd->prepare('SELECT * FROM list_skills WHERE types = ? LIMIT ' . $debut . ', ' . $nbr_elem_page);
$savE->execute(["Savoir-Etre"]);

//COMPETENCES A ACQUERIR

//TEST SI L'USER A DEJA DES COMPETENCES A ACQUERIR

$nbr_skills_user = $bdd->prepare('SELECT * FROM bdc.skills_a_acquerir');
$nbr_skills_user->execute();
$nbr_skills_user->setFetchMode(PDO::FETCH_ASSOC);
$nbr = $nbr_skills_user->rowCount();

//RECUPERATION DES COMPETENCES SELON LE TYPE

function getSkillAAcquerir($type)
{
    require '../controllers/start_bdd.php';
    $req = $bdd->prepare('SELECT * FROM bdc.skills_a_acquerir WHERE types = ? AND id_user = ? ORDER BY create_time DESC LIMIT 2');
    $req->execute([$type, $_SESSION['id']]);
    $req->setFetchMode(PDO::FETCH_ASSOC);
    return $req;
}

$sav_sk_aa = getSkillAAcquerir("Savoirs");
$savF_sk_aa = getSkillAAcquerir("Savoir-Faire");
$savE_sk_aa = getSkillAAcquerir("Savoir-Etre");

//COMPETENCES DEJA ACQUISES

function getSkillAcquis($type)
{
    require '../controllers/start_bdd.php';
    $req = $bdd->prepare('SELECT * FROM bdc.skills_acquis WHERE types = ? AND `user_id` = ? ORDER BY create_time DESC LIMIT 2');
    $req->execute([$type, $_SESSION['id']]);
    $req->setFetchMode(PDO::FETCH_ASSOC);
    return $req;
}

$s_acquis = getSkillAcquis("Savoirs");
$sf_acquis = getSkillAcquis("Savoir-Faire");
$se_acquis = getSkillAcquis("Savoir-Etre");

?>

<title>BDC | Accueil</title>

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
                <?php if (isset($_SESSION['flash'])) { ?>
                    <div class="alert alert-success"><?= $_SESSION['flash'] ?></div>
                <?php unset($_SESSION['flash']);
                } ?>
                <div class="row align-items-center">
                    <div class="col-md-4 order-2 order-md-1 text-center text-white">
                        <img src="../images/logo/phone.png" class="img-fluid">
                        <a href="#liste"><button class="btn btn-outline-info">Liste des Compétences</button></a>
                    </div>
                    <div class="col-md-4 order-2 order-md-1 text-center text-white">
                        <img src="../images/logo/art.png" class="img-fluid">
                        <a href="#aacquérir"><button class="btn btn-outline-warning">Compétences à acquérir</button></a>
                    </div>
                    <div class="col-md-4 text-center order-1 order-md-2 text-white">
                        <img class="img-fluid" src="../images/logo/pc.png">
                        <a href="#acquis"><button class="btn btn-outline-success">Compétences Acquis</button></a>
                    </div>
                </div>
            </div>
        </section>

        <section id="liste" class="feature section pt-0" style="background-color: rgb(90, 87, 87) ;">
            <div class="container">
                <div class="row blabla">
                    <div class="col-lg-6 ml-auto justify-content-center">
                        <!-- Feature Mockup -->
                        <div class="image-content" data-aos="fade-right">
                            <img class="img-fluid" src="../images/logo/phone.png" alt="iphone">
                        </div>
                    </div>
                    <div class="col-lg-6 mr-auto align-self-center">
                        <div class="feature-content">
                            <h2 style="color: black;">Liste des compétences</h2>
                            <p class="desc">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="table-active">Savoirs</th>
                                    <?php while ($savoirs = $savoir->fetch()) { ?>
                                        <td class="table-danger"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Faire</th>
                                    <?php while ($sf = $savF->fetch()) { ?>
                                        <td class="table-info"><?= $sf['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Etre</th>
                                    <?php while ($se = $savE->fetch()) { ?>
                                        <td class="table-warning"><?= $se['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php
                                    for ($i = 1; $i <= $nbr_pages; $i++) {
                                        if ($page != $i) {
                                            echo "<a href='?page=$i#liste' class='btn btn-sm btn-outline-info'>$i</a> &nbsp;";
                                        } else {
                                            echo "<a class='btn btn-info'>$i</a> &nbsp";
                                        }
                                    }
                                    ?>
                                </tr> <br> <br>
                            </table>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section id="aacquérir" class="feature section pt-0" style="background-color: rgba(14,05,22,1) ;">
            <div class="container">
                <div class="row blabla">
                    <div class="col-lg-6 mr-auto align-self-center">
                        <div class="feature-content">
                            <!-- Feature Title -->
                            <h2>Compétences à acquérir</h2>
                            <!-- Feature Description -->
                            <p class="desc">
                                <a href="../controllers/skills_a_acquerir.php" class="btn btn-outline-success">
                                    <i class="fa fa-plus"></i> Ajouter
                                </a> <br>
                                <?php if ($nbr > 0) : ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="table-active">Savoirs</th>
                                    <?php while ($savoirs = $sav_sk_aa->fetch()) { ?>
                                        <td class="table-danger"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Faire</th>
                                    <?php while ($savoirs = $savF_sk_aa->fetch()) { ?>
                                        <td class="table-success"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Etre</th>
                                    <?php while ($savoirs = $savE_sk_aa->fetch()) { ?>
                                        <td class="table-warning"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <a href="skills_a_acquerir.php" class="btn btn-outline-warning">Voir plus <i class="ti-angle-double-right"></i></a>
                                </tr> <br><br>
                            </table>
                        <?php endif ?>
                        </p>
                        </div>
                    </div>
                    <div class="col-lg-6 ml-auto justify-content-center">
                        <!-- Feature Mockup -->
                        <div class="image-content" data-aos="fade-right">
                            <img class="img-fluid" src="../images/logo/papier.png" alt="iphone">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="acquis" class="feature section pt-0" style="background-color: rgb(90, 87, 87) ;">
            <div class="container">
                <div class="row blabla">
                    <div class="col-lg-6 ml-auto justify-content-center">
                        <!-- Feature Mockup -->
                        <div class="image-content" data-aos="fade-right">
                            <img class="img-fluid" src="../images/logo/pc.png" alt="iphone">
                        </div>
                    </div>
                    <div class="col-lg-6 mr-auto align-self-center">
                        <div class="feature-content">
                            <!-- Feature Title -->
                            <h2 style="color: black;">Compétences déjà acquis</h2>
                            <!-- Feature Description -->
                            <p class="desc">
                                <a href="../controllers/skills_acquis.php" class="btn btn-outline-info">
                                    <i class="fa fa-plus"></i> Ajouter
                                </a> <br>
                                <?php if ($nbr > 0) : ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th class="table-active">Savoirs</th>
                                    <?php while ($savoirs = $s_acquis->fetch()) { ?>
                                        <td class="table-danger"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Faire</th>
                                    <?php while ($savoirs = $sf_acquis->fetch()) { ?>
                                        <td class="table-success"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <th class="table-active">Savoir-Etre</th>
                                    <?php while ($savoirs = $se_acquis->fetch()) { ?>
                                        <td class="table-warning"><?= $savoirs['title'] ?></td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <a href="skills_acquis.php" class="btn btn-outline-warning">Voir plus <i class="ti-angle-double-right"></i></a>
                                </tr> <br><br>
                            </table>
                        <?php endif ?>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include '../includes/foot.php' ?>
    <?php
    } else {
        $_SESSION['flash'] = "Vous n'êtes pas connecté-e-s !"; ?>
        <!-- // header('location: connexion.php'); -->
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