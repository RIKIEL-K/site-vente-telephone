<?php
include './header1.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    ?>
    <script>
    window.location.href = 'presentation.php';
    </script>
<?php
    exit();
    }else{
        $id_commande= $_GET['id'];
        $detailsCommande = afficherDetailsCommande($id_commande);
        
    }


?>
<form method="post">
<div class="container mt-5">
<div class="form-floating mb-3">
<label for="floatingInputDisabled">Nom du commandeur : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['nom_utilisateur']; ?></label> 
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">nom du prduit commandé : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['nom_produit']; ?></label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">modele du produit : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['model_produit']; ?></label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">couleur : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['couleur_produit']; ?></label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">Taille de l'ecran :  </label>
<label for="floatingInputDisabled"><?= $detailsCommande['taille_ecran_produit']; ?> (en pouces) </label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">prix d'une piece de ce produit : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['prix_unitaire_produit']; ?> $ </label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">Quantité de produit commandée : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['quantite_produit_commande']; ?></label>
</div>
<div class="form-floating mb-3">
<label for="floatingInputDisabled">Prix total de la commande : </label>
<label for="floatingInputDisabled"><?= $detailsCommande['prix_total']; ?> $</label>
</div>



</div>
</div>
</form>