<?php
session_start();
require_once './fonctions.php';
$users=getUtilisateur();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>SMART</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Open+Sans">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="./css/presentation_cs.css">
<link rel="stylesheet" href="./css/ajout_produit.css">
<link rel="stylesheet" href="./css/ajout_client.css">
<script src="./js/presentation_js.js"></script>
</head>
    <div class="row">
        <div class="container">
                    <nav class="navbar navbar-expand-lg sticky-top ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">SMART</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                     <?php if(isset( $_SESSION['utilisateur'])){ ?>
                        <a class="nav-link" aria-current="page" href="presentation.php">Store</a>
                        <a class="nav-link" href="ios.php">ios</a>
                        <a class="nav-link" href="android.php">Android</a>
                        <a class="nav-link btn d-none d-lg-block" href="panier.php"><i class="bi bi-bag"></i></a>
                        <a class="nav-link btn d-none d-lg-block" href="modifier_utilisateur.php?id=<?php
                        if(isset( $_SESSION['utilisateur']))
                        {
                            echo $_SESSION['utilisateur']['id_utilisateur'];
                        }
                        ?>"><i class="bi bi-person"></i></a>
                     <?php } ?>
                        <?php if(isset($_SESSION['utilisateur'])){
                            if($_SESSION['utilisateur']['description']=='admin'){ ?>
                                <a class="nav-link btn btn-info d-none d-lg-block" href="produit.php">PRODUITS</a>
                                <a class="nav-link btn btn-info d-none d-lg-block" href="utilisateur.php">UTILISATEURS</a>
                                <a class="nav-link btn btn-info d-none d-lg-block" href="commande.php">COMMANDES</a>
                           <?php } ?>
                         <?php } ?>
                                
                                
                        <a class="nav-link" aria-current="page">
                                        <?php
                            if(isset($_SESSION['utilisateur'])){?>
                                    <a class=" btn btn-danger" href="deconnexion.php">Deconnexion</a>
                            <?php }else { ?>
                                <a class=" btn btn-danger" href="connexion.php">Connexion</a>
                            <?php }?>
                        </a>
                    </div>
                    </div>
                </div>
                </nav>
        </div>
    </div>