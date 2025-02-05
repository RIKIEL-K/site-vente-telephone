<?php
 include'./header1.php';
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
    ?>
    <script>
        window.location.href = 'panier.php';
    </script>
    <?php
    exit();
    }else{
        $id_produit=$_GET['id'];
            unset($_SESSION['panier'][$id_produit]);
                ?>
                <script>
                    window.location.href = 'panier.php';
                </script>
                <?php
                exit();
    }
?>