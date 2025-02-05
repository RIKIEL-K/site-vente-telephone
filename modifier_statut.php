
<?php 
include './header1.php';
if(isset($_GET['id'])){ 
    $id_utilisateur=$_GET['id'];
    $result = updateRoleUtilisateur($id_utilisateur,'admin');
}
 ?>
 <script>
 window.location.href = 'statut.php?id=<?= $_GET['id']; ?>';
 </script>
 <?php

?>