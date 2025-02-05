<?php
include'./header1.php';
$id_u = $_SESSION['utilisateur']['id_utilisateur'];
$resultat = afficherAdresse($id_u);


if(isset($_POST['passerCommande'])){
unset($_SESSION['panier']);
?>
<script>
  alert('commande passé avec succes !');
window.location.href = 'presentation.php';
</script>
<?php
}
?>
<script>
function onlyOne(checkbox) {
    var checkboxes = document.querySelectorAll('.form-check-input');
    checkboxes.forEach((item) => {
        if (item !== checkbox) item.checked = false;
    });
}
</script>
<?php
?>
<form method="post">
<div class="container">
<table class="table mt-5">
  <thead>
    <tr>
    <th scope="col"><i class="bi bi-box-arrow-up"></i></th>
      <th scope="col">Numero de la rue</th>
      <th scope="col">code postal</th>
      <th scope="col">ville</th>
      <th scope="col">pays</th>
      <th scope="col">province</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($resultat as $r){ 
       ?>
    <tr class="table-secondary">
        <td>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="checkbox<?= $index; ?>" onclick="onlyOne(this)">
            <label class="form-check-label" for="checkbox<?= $index; ?>">
               
            </label>
        </div>
        </td>
    <td><?= $r['numero'];?></td>
      <td><?= $r['code_postal'];?></td>
      <td><?= $r['ville'];?></td>
      <td><?= $r['pays'];?></td>
      <td><?= $r['province'];?></td>
    </tr>
    <?php } ?>

  </tbody>
 
</table>

  <a href="adresse.php" class="btn btn-primary mt-4">Entrer une adresse ></a>
<input type="submit" value="suivant" name="passerCommande" class="btn btn-primary mt-4">




</div>
</form>