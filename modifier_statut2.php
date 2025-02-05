<?php 
include './header1.php';
if(isset($_GET['id'])){ 
    var_dump($_GET)  ;
    $id_utilisateur=$_GET['id'];
    $result = updateRoleUtilisateur($id_utilisateur,'client');
}
 ?>
 <script>
 window.location.href = 'statut.php?id=<?= $_GET['id']; ?>';
 </script>
 <?php

?>