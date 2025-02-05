<?php
include './header1.php';

   if(isset($_SESSION['utilisateur'])){

      ?>
         <script>
           window.location.href = 'presentation.php';
       </script>
     <?php
   }

if(isset($_POST['btn_connexion'])){
    
 $email=$_POST['courriel'];
 $mot_de_passe = $_POST['mot_de_passe'];
 $utilisateur = getUtilisateurByEmail($email);
 if($utilisateur){
    
    if(password_verify($mot_de_passe,$utilisateur['mot_de_passe']))
   {
      if($utilisateur['statut']=='actif'){
         unset($utilisateur['mot_de_passe']);
         $_SESSION['utilisateur']=$utilisateur;
      
         ?>
          <script>
              window.location.href = 'presentation.php';
            </script>
         <?php
      }else{
         ?>
         <script>
            alert('votre compte a été desactivé');
           </script>
        <?php
      }

   }else{
      ?>
         <script>
            alert("Reesayer !");
         </script>
      <?php
    
    }
 }else{
   ?>
         <script>
            alert("Mot de passe ou courriel incorrect !");
         </script>
   <?php
 }

}
?>
<form method="post">
<div class="container mt-5">
<div class="mb-3">
  <label for="courriel" class="form-label">Courriel</label>
  <input type="email" class="form-control" id="courriel" name="courriel" placeholder="courriel">
</div>
<label for="mot_de_passe" class="form-label">Mot de Passe</label>
<input type="password" id="mot_de_passe" class="form-control" name="mot_de_passe">

 <div class="row">
 <input type="submit" class="btn btn-primary mt-3" value="Se connecter" name="btn_connexion">
   <a href="ajout_client.php" class="btn btn-info mt-3 ml-2">s'incrire</a> 
   
</div>
</div>
</div>
</form>

</body>
</html>