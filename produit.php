<?php
include './header1.php';
$produits=getProduits();
?>
<form method="post">
    <div class="container rounded bg-white mt-5 mb-5">
    <h1 class="text-uppercase mb-3 fs-1" style="font-size:1.5em;">gestion de produits</h1>
    <a href="ajout_produit.php" class="btn btn-info d-inline-flex justify-content-end mb-2"><i class="bi bi-file-plus"></i></i>Ajouter</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Description</th>
      <th scope="col">Prix</th>
      <th scope="col">Promotion</th>
      <th scope="col">Voir</th>
      <th scope="col">Modifier</th>
      <th scope="col">supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($produits as $produit){ ?>
    <tr>
      <th scope="row"><?= $produit['nom'] ?></th>
      <td><?= $produit['description'] ?></td>
      <td><?= $produit['prix_unitaire'] ?></td>
      <td><?= $produit['prix_unitaire'] ?></td>
      <td><a href="voir_produit.php?id=<?=$produit['id_produit'];?>" class="btn btn-info"><i class="bi bi-eye"></i>Visualiser</a></td>
      <td><a href="modifier_produit.php?id=<?=$produit['id_produit'];?>" class="btn btn-primary"><i class="bi bi-brush"></i>modifier</a></td>
      <td><a href="supprimer.php?id=<?=$produit['id_produit'];?>" class="btn btn-danger"><i class="bi bi-trash"></i>supprimer</a></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
    </div>
</form>