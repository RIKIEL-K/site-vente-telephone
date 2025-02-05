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
        
        $id_utilisateur=$_GET['id'];
        $utilisateur = getUtilisateurById($id_utilisateur);
           
            $resultat=supprimerUtilisateur($utilisateur);
            if($resultat){
            ?>
                <script>
                window.location.href = 'utilisateur.php';
                </script>
            <?php
                exit();
             }else{

             }
    }
?>