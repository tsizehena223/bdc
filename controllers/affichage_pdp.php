<?php

require_once 'start_bdd.php';
$req = $bdd->prepare('SELECT * FROM bdc.photo_user WHERE id_user = ? LIMIT 1');
$req->setFetchMode(PDO::FETCH_ASSOC);
$req->execute([$_GET['id']]);
$tab = $req->fetchAll();
echo $tab[0]["bin"];
