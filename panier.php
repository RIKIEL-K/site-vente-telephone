<?php
include './header1.php';


if (!isset($_SESSION['panier'])) {
  $_SESSION['panier'] = array();
}

if (isset($_GET['id'])) {
    $id_produit = $_GET['id'];
    $product = getProduitById($id_produit);
    
    if (empty($product)) {
        die("Ce produit n'existe pas");
    }
    
    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit]++;
    } else {
        $_SESSION['panier'][$id_produit] = 1;
    }
}

if (isset($_POST['ajouter'])) {
    $id_produit = $_POST['id_produit'];
    if (isset($_SESSION['panier'][$id_produit])) {
        $_SESSION['panier'][$id_produit]++;
    } else {
        $_SESSION['panier'][$id_produit] = 1;
    }
}

if (isset($_POST['payer'])) {
    ajouter_commande();
}


?>





<form method="post">
<section class="h-100">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0">PANIER</h3>
        </div>
        <?php 
            if (!empty($_SESSION['panier'])) {
              $ids = array_keys($_SESSION['panier']);
              
            foreach ($_SESSION['panier'] as $produit => $quantite) {
              $ps = getProduitById($produit); 
              
             ?>
                 <div class="card rounded-3 mb-4">
                        <div class="card-body p-4">
                          <div class="row d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                              <img src="
                             <?php 
                                    if(isset($ps['chemin']) && !empty($ps['chemin'])){
                                      echo $ps['chemin'];  
                                    }else{
                                      echo './images/background.png'; 
                                    }
                              ?>
                              "class="img-fluid rounded-3" alt="Img">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3">
                              <p class="lead fw-normal mb-2"><?= $ps['nom']; ?></p>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                              <input id="form1" min="0" name="quantite" type="text" disabled 
                                class="form-control form-control-sm" value="<?= $quantite; ?>" />
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-0">
                              <h5 class="mb-0"><?= $ps['prix_unitaire']; ?></h5>
                            </div>

                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                              <a href="supprimer_produit.php?id=<?= $ps['id_produit'] ;?>" class="text-danger"><i class="bi bi-trash3"></i></a>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-0">
                              <form method="get" action="panier.php">
                                  <input type="hidden" name="id" value="<?= $ps['id_produit']; ?>">
                                  <button type="submit" class="btn btn-info">Ajouter</button>
                              </form>
                           
                    </div>
                          </div>
                        </div>
                      </div>
               <?php } ?> 
              <?php } ?>

                <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Paiements</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li
                class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Net à Payer
                <span><?php $mt=CalculTotal(); echo $mt; ?><span> $</span></span>
              </li>
            </ul>

          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <input type="submit" value="Choisir une adresse" name="payer" class="btn btn-warning btn-block btn-lg">
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
</form>