<?php

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    ?>
    <script>
    window.location.href = 'presentation.php';
    </script>
<?php
    exit();
    }else{
        include'./header1.php';
        
        $id_commande=$_GET['id'];
            $resultat=supprimerCommande($id_commande);
            if($resultat){
            ?>
                <script>
                window.location.href = 'commande.php';
                </script>
            <?php
                exit();
             }else{

             }
    }
?>