<?php

if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    ?>
    <script>
    window.location.href = 'produit.php';
    </script>
    <?php
    exit();
    }else{
        include'./header1.php';
        
        $id_produit=$_GET['id'];
        $produit = getProduitById($id_produit);
            
            $resultat=suppressProduit($produit);
            if($resultat){
                ?>
                <script>
                window.location.href = 'produit.php';
                </script>
              <?php
                exit();
             }else{

             }
    }
?>