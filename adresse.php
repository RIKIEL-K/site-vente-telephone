<?php 
include 'header1.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
  ?>
  <script>
  window.location.href = 'presentation.php';
  </script>
<?php
exit();
}

if(isset($_POST['terminer'])){

ajouterAdresse($_POST);
unset($_SESSION['panier']);
?>
<script>
window.location.href = 'paiement.php?id=<?= $_GET['id']; ?>';
</script>
<?php
}
?>

<section class="h-100 h-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">

            <div class="row">

              <div class="col-lg-12">

                <div class="card  text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">DETAILS DE LA COMMANDE</h5>
                    </div>
                    <form method="post" class="mt-2">
                      <div data-mdb-input-init class="form-outline form-white mb-3">
                      <label class="form-label text-dark" for="typeName"> RUE</label>
                        <input type="text" id="typeName" name="numero" class="form-control form-control-lg" 
                           required />
                        
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-3">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label text-dark" for="typeExp">VILLE</label>
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                              id="exp" name="ville" required />
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label text-dark" for="typeExp">CODE POSTAL</label>
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                                id="exp" name="code_postal" required />
                            
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label text-dark" for="typeExp">PAYS</label>
                            <input type="text" id="typeExp" class="form-control form-control-lg"
                               id="exp" name="pays" required  />
                           
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div data-mdb-input-init class="form-outline form-white">
                          <label class="form-label text-dark" for="typeText">PROVINCE</label>
                            <input  id="typeText" name="province" class="form-control form-control-lg"
                            required />
                            
                          </div>
                        </div>
                      </div>
                      <div class="">
                    <div class="mt-3">
                         <input type="submit" value="confirmer l'adresse" name="terminer" class="btn btn-info btn-block btn-lg">
                    </div>
                    </div>
                   
                    </form>


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

