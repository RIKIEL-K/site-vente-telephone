<?php
include 'header1.php';
if(isset($_SESSION['utilisateur'])){
    unset($_SESSION['utilisateur']);
}
?>
     <script>
        window.location.href = 'connexion.php';
      </script>