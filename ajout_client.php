<?php
include './header1.php';
if(isset($_POST['btn_save'])){ 
ajouterClient($_POST);
?>
<script>
window.location.href = 'connexion.php';
</script>
<?php } ?>


<section class="vh-100 bg-image"
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-3">
              <h2 class="text-uppercase text-center mb-2">Creer un compte</h2>
              <form method="post">
                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="nom">Nom</label>
                  <input type="text" id="nom" class="form-control form-control-lg" name="nom" />
                  
                </div>
                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="prenom">Prenom</label>
                  <input type="text" id="prenom" class="form-control form-control-lg" name="prenom" />
                  
                </div>
                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="date_naissance">Date de naissance</label>
                  <input type="date" id="date_naissance" class="form-control form-control-lg" name="date_naissance" />
                  
                </div>
                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="courriel">Courriel</label>
                  <input type="email" id="courriel" class="form-control form-control-lg" name="courriel"/>
                </div>
                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="telephone">Telephone</label>
                  <input type="text" id="telephone" class="form-control form-control-lg" name="telephone"/>
                  
                </div>

                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="mot_de_passe">Mot de Passe</label>
                  <input type="password" id="mot_de_passe" class="form-control form-control-lg" name="mot_de_passe" />
                  
                </div>

                <div data-mdb-input-init class="form-outline mb-2">
                <label class="form-label" for="confirm_password">Confirmer votre mot de passe </label>
                  <input type="password" id="confirm_password" class="form-control form-control-lg" name="confirm_password" />
                  
                </div>
                <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-secondary btn-block btn-lg text-body" id="btn_save" name="btn_save" value="s'enregistrer" >
                  <!-- <a class="btn btn-secondary btn-block btn-lg text-body" href="" name="enregistrer">S'enregistrer</a> -->
                </div>
                <p class="text-center text-muted mt-2 mb-0">Vous avez déjà un compte? <a href="connexion.php"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>