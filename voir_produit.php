<?php 
include 'header1.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    
    ?>
    <script>
    window.location.href = 'presentation.php';
    </script>
<?php
    exit();
    }else{
        $id_produit= $_GET['id'];
        $produit=getProduitById($id_produit);
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
                            <textarea class="form-control"id="description" id="description" name="description" disabled placeholder="Description" ><?= $produit['description']; ?></textarea>
                        </div>
                                
                                <input type="text" class="form-control" id="nom" disabled  name="nom" value="<?= $produit['nom']; ?>">
                                </div>
                                <div class="mb-3">
                                <input type="text" class="form-control" id="model" disabled  name="model" value="<?= $produit['model']; ?>">
                                </div>
                                    <div class="row">
                                    <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="couleur" disabled  name="couleur" value="<?= $produit['couleur']; ?>">
                                </div>
                                <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="taille_ecran" disabled name="taille_ecran" value="<?= $produit['taille_ecran']; ?>">
                                </div>
                                    </div>
                                <div class="row">
                                <div class=" col-md-6 mb-3">
                                <input type="text" class="form-control" id="prix_unitaire" disabled  name="prix_unitaire" value="<?= $produit['prix_unitaire']; ?>">
                                </div>
                                </div>

  </div>
</div>
</form>
</div>


