<?php
include './header1.php';
$commandes = getCommande();

?>
<form method="post">
    <div class="container rounded bg-white mt-5 mb-5">
    <h1 class="text-uppercase mb-3 fs-1" style="font-size:1.5em;">gestion des commandes</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom de l'utilisateur</th>
      <th scope="col">quantite commandeé</th>
      <th scope="col">prix Total</th>
      <th scope="col">Date de la commande</th>
      <th scope="col">actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($commandes as $c){ ?>
    <tr>
      <th scope="row"><?= $c['nom'] ?></th>
      <td><?= $c['quantite_commande'] ?></td>
      <td><?= $c['prix_total'] ?></td>
      <td><?= $c['date_commande'] ?></td>
      <td><a href="supprimer_commande.php?id=<?=$c['id_commande'];?>" class="btn btn-danger"><i class="bi bi-trash3"></i>supprimer la commande</a></td>
      <td><a href="voir_commande.php?id=<?=$c['id_commande'];?>" class="btn btn-primary"></i>Afficher les Détails</a></td>
    </tr>
     <?php } ?>
  </tbody>
</table>
    </div>
</form>