<?php

/**
 * afin que l'utilisateur ne puisse pas supprimer l'id_produit dans l'url
 * donc on verifie si cette variable existe ou quel est un entier sinon on le redirige vers la page de connexion 
 *
 */
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
            ?>
            <script>
            window.location.href = 'produit.php';
            </script>
        <?php
exit();
}else{
    include './header1.php';
    $id_produit=$_GET['id'];
    $produit = getProduitById($id_produit);
    if(isset($_POST['btn_modifier'])){
        $_POST['id_produit']=$id_produit;
        $resultat=updateProduit($_POST);
        if($resultat){
         ?>
            <script>
            window.location.href = 'produit.php';
            </script>
         <?php
            exit(); 
        }
    }
}



?>
<div class="container d-flex justify-content-center mt-5 ">
<form method="post">
<div class="card" style="width: 18rem;">
  <img  src="
  <?php 
      if(isset($produit['chemin']) && !empty($produit['chemin'])){
        echo $produit['chemin']; 
      }else{
        echo './images/background.png'; 
      }
      ?>" class="card-img-top" alt=".">
  <div class="card-body">
  <div class="mb-3">
                         <div class="form-floating mb-4">
                            <textarea class="form-control"id="description" id="description" name="description"  placeholder="Description" ><?= $produit['description']; ?></textarea>
                        </div>
                                
                                <input type="text" class="form-control" id="nom"   name="nom" value="<?= $produit['nom']; ?>">
                                </div>
                                <div class="mb-3">
                                <input type="text" class="form-control" id="model"   name="model" value="<?= $produit['model']; ?>">
                                </div>
                                    <div class="row">
                                    <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="couleur"   name="couleur" value="<?= $produit['couleur']; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                         <input type="text" class="form-control" id="taille_ecran"  name="taille_ecran" value="<?= $produit['taille_ecran']; ?>">
                                </div>
                                    </div>
                                <div class="row">
                                <div class=" col-md-6 mb-3">
                                             <input type="text" class="form-control" id="prix_unitaire"   name="prix_unitaire" value="<?= $produit['prix_unitaire']; ?>">
                                </div>
                                        <div class="mt-5 text-center">
                                            <input type="submit" class="btn btn-danger" name="btn_modifier" value="enregister">
                                        </div>
                                </div>

  </div>
</div>
</form>
</div>