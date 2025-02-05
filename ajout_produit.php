<?php
include './header1.php';

if(isset($_POST['btn-ajout'])){
     $resultat = ajoutProduit($_POST,$_FILES);
}
?>
<body>
<div class="container-fluid">
        <div class="row d-flex justify-content-center">
                    <div class="card1" style="width: 30rem;">
                    <h5 class="mb-3 text-center" style="font-family: Roboto, sans-serif; margin-top:20px;">AJOUTER VOTRE TELEPHONE</h5>
                <img src="./images/background.png" class="card-img-top" alt="...">
                <div class="card-body1">
                <form method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom"  name="nom">
                                </div>
                                <div class="mb-3">
                                <label for="nom" class="form-label">Model du téléphone</label>
                                <input type="text" class="form-control" id="model"  name="model">
                                </div>
                                    <div class="row">
                                    <div class="mb-3 col-md-6">
                                <label for="nom" class="form-label">Couleur</label>
                                <input type="text" class="form-control" id="couleur"  name="couleur">
                                </div>
                                <div class="mb-3 col-md-6">
                                <label for="nom" class="form-label">Taille d'ecran</label>
                                <input type="text" class="form-control" id="taille_ecran"  name="taille_ecran">
                                </div>
                                    </div>
                                <div class="row">
                                <div class=" col-md-6 mb-3">
                                <label for="prix_unitaire" class="form-label">Prix unitaire</label>
                                <input type="number" class="form-control" id="prix_unitaire"  name="prix_unitaire">
                                </div>
                                <div class="col-md-6 mb-3">
                                <label for="quantite" class="form-label">Quantite</label>
                                <input type="number" min="0" class="form-control" id="quantite"  name="quantite">
                            </div>
                                </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file"  class="form-control" id="image"  name="image">
                            </div>
                                <div class="row">
                                <div class="input-group input-group-sm mb-1 col-12">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Android ou Ios ?</span>
                                    <input type="text" class="form-control" aria-label="Sizing example input" name="sys" aria-describedby="inputGroup-sizing-sm">
                            </div>
                                </div>
                             
                            <div class="form-floating mt-4">
                            
                                <textarea class="form-control"id="description" id="description" name="description" placeholder="Description"></textarea>
                                
                            </div>
                    <div class="cta-section">
                    
                        <input type="submit" class="btn btn-light mt-2" id="btn-ajout" name="btn-ajout" value="Ajouter le téléphone">
                    </div>
                </div>
            </div>
        </div>
</div>
</body>
</html>

