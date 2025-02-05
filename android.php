<?php 
include './header1.php';
$ios_produits = chercherSysteme('android');

?>

<form method="post">
<div class="row1">
        <div class="col-lg-6">
            <div class=" mt-5"><span class="brand-form">SMART.</span><span class="brand-text">Vos produits Android</span> <br></div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12">
			<h2>Produits <b>ANDROID</b></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<?php $j=0; ?>
			<div class="carousel-inner">
				<div class="item carousel-item active">
                   
					<div class="row">
                            <?php 
                            $i=1;
                            foreach ($ios_produits as $ios_produit) { ?>
						<div class="col-sm-3">
							<div class="thumb-wrapper">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
								<div class="img-box">
									<img src=
                                    "<?php 
                                            if(isset($ios_produit['chemin']) && !empty($ios_produit['chemin'])){
                                                echo $ios_produit['chemin']; 
                                            }else{
                                                echo './images/background.png'; 
                                            }
                                            ?>" class="img-fluid" alt="">									
								</div>
								<div class="thumb-content">
									<h4><input type="text" value="<?= $ios_produit['nom']; ?>" disabled name="nom" class="form-control text-center" style="border:none;background-color:white;"></h4>									
									<div class="star-rating">
										<ul class="list-inline">
											<li class="list-inline-item"><input type="text" disabled class="form-control text-center" value="<?= $ios_produit['model'] ?>" style="border:none;  background-color:white;" name="model"></li>
											<li class="list-inline-item"><input type="text" disabled class="form-control text-center" value="<?= $ios_produit['couleur'] ?>" style="border:none;  background-color:white;" name="couleur"></li>
										</ul>
									</div>
									<p class="item-price"><input type="text" disabled class="form-control text-center" value="<?= $ios_produit['prix_unitaire'] ?>" style="border:none;  background-color:white;" name="prix_unitaire"></b></p>
                                     <!-- <input type="submit" value="Ajouter au panier" name="add-cart" class="btn btn-primary"> -->
									<a href="panier.php?id=<?= $ios_produit['id_produit']; ?>" class="btn btn-primary">Ajouter au panier</a>
									
								</div>						
							</div>
						</div>	
                        <?php } ?>
					</div>
                    
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
</form>