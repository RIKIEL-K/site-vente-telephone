<?php
include './header1.php';
$utilisateurs=getUtilisateur();

?>
<form method="post">
    <div class="container rounded bg-white mt-5 mb-5">
    <h1 class="text-uppercase mb-3 fs-1" style="font-size:1.5em;">gestion des utilisateurs</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Date de naissance</th>
      <th scope="col">Courriel</th>
      <th scope="col">Telephone</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($utilisateurs as $u){ ?>
    <tr>
      <th scope="row"><?= $u['nom'] ?></th>
      <td><?= $u['prenom'] ?></td>
      <td><?= $u['date_naissance'] ?></td>
      <td><?= $u['courriel'] ?></td>
      <td><?= $u['telephone'] ?></td>
      <td>
        <a href="statut.php?id=<?=$u['id_utilisateur']; ?>" class="btn btn-info">changer le statut</a>
       </td>
      <td><a href="supprimer_utilisateur.php?id=<?=$u['id_utilisateur'];?>" class="btn btn-danger"><i class="bi bi-trash3"></i>supprimer</a></td>
      <td>
        <a href="statutInactif.php?id=<?= $u['id_utilisateur']; ?>" class="btn btn-primary">rendre inactif</a>
       </td>
       <td><a href="statutActif.php?id=<?= $u['id_utilisateur']; ?>" class="btn btn-primary">rendre actif</a></td>
    </tr>
     <?php } ?>
  </tbody>
</table>
    </div>
</form>