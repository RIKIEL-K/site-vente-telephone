<?php 

include'./header1.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    ?>
    <script>
    window.location.href = 'presentation.php';
    </script>
  <?php
  exit();
  }else{
    
    $mt = strval(getPrixTotalById($_GET['id']));
    
  }



?>
<form method="post">
<div class="container">
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">
            <div class="row">

              <div class=" col-lg-5" style="margin-left: 320px;">

                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Details du paiement</h5>
                    
                    </div>

                    <form class="mt-4">
                      <div data-mdb-input-init class="form-outline form-white mb-4">
                      <label class="form-label" for="typeName">Nom du proprietaire</label>
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17"
                          placeholder="Nom" required />
                       
                      </div>

                      <div data-mdb-input-init class="form-outline form-white mb-4">
                      <label class="form-label" for="typeText">Numero de carte</label>
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17"
                          placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" required/>
                       
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label" for="typeExp">Expiration</label>
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" required />
                           
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label" for="typeText">Cvv</label>
                            <input type="password" id="typeText" class="form-control form-control-lg"
                              placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" required />
                            
                          </div>
                        </div>
                      </div>
                      <hr class="my-4">

                        <div class="d-flex justify-content-between">
                        <p class="mb-2">Total</p>
                        <p class="mb-2"><?= $mt; ?><span> $</span></p>
                        </div>

                    </form>

                    <hr class="my-4">


                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                    
                        <span>
                        <?php  if(isset($_SESSION['utilisateur'])){ ?> 
                          <div id="paypal-button-container"></div>
                     <?php } ?>
                        </span>
                      </div>
                    </button>

                  </div>
                </div>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>


</form>


<script src="https://www.paypal.com/sdk/js?client-id=<?=PAYPAL_CLIENT_ID?>&components=buttons"></script>
<script>

paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?= $mt; ?>' // Remplacez par le montant total de la commande
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed ');
            // Vous pouvez rediriger l'utilisateur ou effectuer d'autres actions ici
        });
    }
}).render('#paypal-button-container'); // ID du conteneur où le bouton PayPal doit être rendu
</script>