<?php

include "./config.php";

/** 
*fonction qui permet de se connecter à la base de donnée
* @return mysqli|bool 
*/
function connexionDB(){
    $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME,DB_PORT);

    if($conn == false){
        die("Erreur de connection avec la base de donnée : ".mysqli_connect_error());
    }else{
        return $conn;
    }
}


/**
 * fonction pour ajouter un produit
 * param array $produit 
 * @return void
 */

function ajoutProduit($produit,$data){
$nom  = $produit['nom'];
$model = $produit['model'];
$couleur = $produit['couleur'];
$taille_ecran =$produit['taille_ecran'];
$prix_unitaire  = $produit['prix_unitaire'];
$quantite  = $produit['quantite'];
$description  = $produit['description'];
$sys = $produit['sys'];
/**
 * Ceci est une requete préparée qui attends des paramètres
 */
$sql = "insert into Produit(nom,model,couleur,taille_ecran,prix_unitaire,quantite,description,sys)values(?,?,?,?,?,?,?,?)";

$connect = connexionDB();
//initialisation de la req avec la base de donnée
$stmt = mysqli_prepare($connect,$sql);
/**
 * pour la fonction mysqli_stmt_bind_param prends en paramètre des types selon la norme suivante 
 * string s , int i ,float|double d en suivants l'ordre des paramètres . 
 */
mysqli_stmt_bind_param($stmt,"sssssiss",$nom,$model,$couleur,$taille_ecran,$prix_unitaire,$quantite,$description,$sys);
/**
 * les requetes SQL insert , update et delete retourne un type booléen, on vérifie cela avec la fonction 
 * mysqli_stmt_execute() 
 * @return  true|false 
 */

 $resultat= mysqli_stmt_execute($stmt);
 if($resultat){
    /**$connect contient tous les éléments du produit dont son id
     * mysqli_insert_id permet de recupérer ses élélments
     */
    $id_produit = mysqli_insert_id($connect);
    uploadImage($data,$id_produit);
    // return true;
    }
    return $resultat;

}
/** 
 * fonction pour deplacer une image de la machine vers le dossier client puis vers le serveur 
 * @param array $data 
 * @return bool
*/

function uploadImage($data,$id_produit){
    if(isset($data['image'])&& $data['image']['error']===UPLOAD_ERR_OK){
        $image_name=$data['image']['name'];
        $image_destination='images/'.basename($image_name);
        $from = $data['image']['tmp_name'];
        $image_type = strtolower(pathinfo($image_destination,PATHINFO_EXTENSION));
        if(in_array($image_type,['jpg','jpeg','png','gif'])){
            if(move_uploaded_file($from,$image_destination)){
                /**
                 *  sauf que La fonction ajoutImage prends en parametre un tableau qui contient id_produit et chemin 
                 * pour pouvoir etre exéécuter donc on cree ce tableau 
                 */
                $image = ['chemin'=>$image_destination,'id_produit'=>$id_produit];/**je n'ai pas id_produit dans la fonction uploadImage donc je la modifie */
                ajoutImage($image);
                return true;  
            }else{
                // echo 'Impossible de télécharger le fichier';
                return false;
            }
        }else{
            // echo 'Impossible de télécharger le fichier avec cet extension';
            return false;
        }
    }
    return false;
}
/**
 * fonction pour ajouter un produit
 * @param array $image 
 * @return bool
 * la fonction ajoutImage a besoin du chemin qui est contenue dans la fonction
 * uploadImage donc on va l'appelé de ce coté
 */

 function ajoutImage($image){
    $chemin  = $image['chemin'];
    $id_produit  = $image['id_produit'];

    /**
     * Ceci est une requete préparée qui attends des paramètres
     */
    $sql = "insert into Image(chemin,id_produit)values(?,?)";
    
    $connect = connexionDB();
    //initialisation de la req avec la base de donnée
    $stmt = mysqli_prepare($connect,$sql);
    /**
     * pour la fonction mysqli_stmt_bind_param prends en paramètre des types selon la norme suivante 
     * string s , int i ,float|double d en suivants l'ordre des paramètres . 
     */
    mysqli_stmt_bind_param($stmt,"si",$chemin,$id_produit);
    /**
     * les requetes SQL insert , update et delete retourne un type booléen, on vérifie cela avec la fonction 
     * mysqli_stmt_execute() 
     * @return  true|false 
     */
    
     return mysqli_stmt_execute($stmt);
    
    }

    function ajouterClient($client){
        global $erreurs;
    $nom = $client["nom"];
    $prenom = $client["prenom"];
    $date_naissance = $client["date_naissance"];
    $telephone = $client["telephone"];
    $courriel = $client["courriel"];
    $mot_de_passe = $client["mot_de_passe"];
    $confirm_password = $client["confirm_password"];
    
    if(isset($nom,$prenom,$date_naissance,$telephone,$courriel,$mot_de_passe,$confirm_password)){
        if(empty($nom)){
            $erreurs['nom']='le nom est vide';
    
            return false;
        }
        if($confirm_password===$mot_de_passe){
            $utilisateur=getUtilisateurByEmail($courriel);
            if($utilisateur){
                return false; /**? */
            }else{
    
                $mot_de_passe = password_hash($mot_de_passe,PASSWORD_DEFAULT);
                $sql = "insert into utilisateur(nom,prenom,date_naissance,telephone,courriel,mot_de_passe)values(?,?,?,?,?,?)";
            
                $connect = connexionDB();
                $stmt = mysqli_prepare($connect,$sql);
                mysqli_stmt_bind_param($stmt,"ssssss",$nom,$prenom,$date_naissance,$telephone,$courriel,$mot_de_passe);
                
                $resultat = mysqli_stmt_execute($stmt);
                if($resultat){
                    $role = getRoleByDesc('client');
                    /**permet de recuperer le dernier élément entré dans la db */
                    $id_utilisateur = mysqli_insert_id($connect);
                    insertRoleUtilisateur($role['id_role'],$id_utilisateur);
                    return true;
                }
           
            }
    
        }else{
        return false;
        }
    }else{
        // $erreurs['isNullOrIsNotExists']='';
        return false;
    }
    
    
    }
    // function contrainteNomPrenom($client){
    //     $nomClient = $client['nom'];
    //     $prenomClient = $client['prenom'];
        
    //     if (strlen($nomClient)>=4 && strlen($prenomClient)>=4){
    //         return true;
    //     }else{
    //         return false;
    //     }
        
    // }
    function getUtilisateurByEmail($email){
        $sql = 'select u.*,r.description from utilisateur u join role_utilisateur ru 
        on u.id_utilisateur = ru.id_utilisateur join role r 
        on ru.id_role=r.id_role where courriel = ?';
        $connex=connexionDB();
        $stmt=mysqli_prepare($connex,$sql);
        mysqli_stmt_bind_param($stmt,'s',$email);
        $resultat = mysqli_stmt_execute($stmt);
        if($resultat){
         $resultatData = mysqli_stmt_get_result($stmt);
         if(mysqli_num_rows($resultatData)>=0){
             return mysqli_fetch_assoc($resultatData);
         }else{
             return false;
         }
        }else{
         return false;
        }
        
    }
    /**
     * fonction qui me retourne le role en fonction de la description
     * @param string $description
     * @return array | bool 
     */
    function getRoleByDesc($description){

        $sql='select * from Role where description = ? ';
        $connex = connexionDB();
        $stmt = mysqli_prepare($connex,$sql);
        mysqli_stmt_bind_param($stmt,'s',$description);
        /**
         * Verifie si la requete a été execute avec succes ou non
         * @return bool 
         */
        $resultats = mysqli_stmt_execute($stmt);
        /**
         * fetch_assoc retourne un tableau contenant le resultat de la requete . au prealable il faut verifier si la variable 
         * contient quelque chose(des lignes ou pas ) sinon fetch_assoc retourne false 
         */
        if($resultats){ /**si a a ete execute avec succes */
            /**
             * stmt_get_result recupere le resultat de la requete mysqli_stmt_execute et verifie si elle contient une information
             * ici la variable resultats devient un tableau. On peut déclarer une autre variable mais on prefere garder celle ci 
             * pour diminuer le nombre de variable
             * @return array 
             */
            $resultats = mysqli_stmt_get_result($stmt);
            /**il faut vérifier si le nombre de lignes dans $resultats est supérieur à zero */
            if(mysqli_num_rows($resultats)>0){
        
                return mysqli_fetch_assoc($resultats);
            }else{
               
                return false;
            }
        }else{
            
            return false;
        }
    }
    /**
 * fonction qui permet l'insertion dans la table role utilisateur
 * @param int $id_role
 * @param int $id_utilisateur
 * @return bool
 */
function insertRoleUtilisateur($id_role,$id_utilisateur){
    $sql = 'insert into Role_utilisateur(id_role,id_utilisateur)values(?,?);';
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param( $stmt,'ii',$id_role,$id_utilisateur);
    return mysqli_stmt_execute($stmt);
}

/**
 * fonction qui retourne tous nos produits
 * @return array 
 */
function getProduits(){
    $sql = 'select * from produit p left join Image i on p.id_produit=i.id_produit';
    $connx = connexionDB();
    $resultats  = mysqli_query($connx,$sql);
    $produits = [];
    // foreach ($resultats as $produit) {
    //     $produits[]=$produit;
    // }
    if(mysqli_num_rows($resultats)>0){
        while($produit = mysqli_fetch_assoc($resultats)){
            $produits[]=$produit;
        }
    }
    
    return $produits;
    
    }
 /**
  * une fonction qui retourne un utilisateur avec tous ses parametres
  * @return array
  */
 function getUtilisateur(){
        $sql='select * from utilisateur';
        $connex = connexionDB();
        $result=mysqli_query($connex,$sql);
        $users = [];
        foreach($result as $user){
            $users[]=$user;
        }
        return $users;
    }
/**
 * fonction qui permet de faire la modification d'un produit
 * @param array $produit
 * @return bool
 */
function updateProduit($produit){
    $id_produit = $produit['id_produit'];
    $nom  = $produit['nom'];
    $prix_unitaire  = $produit['prix_unitaire'];
    $taille_ecran = $produit['taille_ecran'];
    $quantite  = $produit['quantite'];
    $model  = $produit['model'];
    $couleur  = $produit['couleur'];
    $description  = $produit['description'];
    
    $sql='update produit set nom = ? , prix_unitaire=? ,taille_ecran=? ,quantite=?, model = ?,couleur=?,description= ? where  id_produit = ?';
    
    $connex = connexionDB();
    /**initialisation de la base de données */
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,'sssisssi',$nom,$prix_unitaire,$taille_ecran,$quantite,$model,$couleur,$description,$id_produit);
    /**insert update , delete le resultat c,est du type bool */
    return mysqli_stmt_execute($stmt);
    }
/**
 * Fonction qui permet de modifier un utilisateur 
 * @param int id_utilisateur
 * @return array|bool
 */

 function getUtilisateurById($id_utilisateur){
    $sql= 'select * from utilisateur where id_utilisateur= ?';
   $connex = connexionDB();
   $stmt = mysqli_prepare($connex,$sql);
   mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
   $result = mysqli_stmt_execute($stmt);
   if($result){
       $result=mysqli_stmt_get_result($stmt);
       if(mysqli_num_rows($result)>0){
           return mysqli_fetch_assoc($result);
       }else{
           return false;
       }
   }else{
       return false;
   }
   }
   /**
 * Fonction qui permet d'afficher un produit 
 * @param int id_utilisateur
 * @return array|bool
 */

 function getProduitById($id_produit){
    $sql= 'select * from produit p left join Image i on p.id_produit=i.id_produit where p.id_produit= ?';
   $connex = connexionDB();
   $stmt = mysqli_prepare($connex,$sql);
   mysqli_stmt_bind_param($stmt,'i',$id_produit);
   $result = mysqli_stmt_execute($stmt);
   if($result){
       $result=mysqli_stmt_get_result($stmt);
       if(mysqli_num_rows($result)>0){
           return mysqli_fetch_assoc($result);
       }else{
           return false;
       }
   }else{
       return false;
   }
   }
/**
 * fonction qui permet de faire la modification d'un utilisateur
 * @param array $utilisateur
 * @return bool
 */
function updateUtilisateur($utilisateur){
    $id_utilisateur = $utilisateur['id_utilisateur'];
    $nom  = $utilisateur['nom'];
    $prenom  = $utilisateur['prenom'];
    $date_naissance  = $utilisateur['date_naissance'];
    $telephone  = $utilisateur['telephone'];
    $courriel  = $utilisateur['courriel'];
    $mot_de_passe  = $utilisateur['mot_de_passe'];
    
    
    $sql='update utilisateur set nom = ? , prenom=? , date_naissance = ?, telephone= ?,courriel=?,mot_de_passe= ? where  id_utilisateur = ?';
    
    $connex = connexionDB();
    /**initialisation de la base de données */
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,'ssssssi',$nom,$prenom,$date_naissance,$telephone,$courriel,$mot_de_passe,$id_utilisateur);
    /**insert update , delete le resultat c'est du type bool */
    return mysqli_stmt_execute($stmt);
}
function supprimerUtilisateur($utilisateur){
    $id_utilisateur= $utilisateur['id_utilisateur'];
    $sql='delete from utilisateur where id_utilisateur=?';
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id_utilisateur);
    return mysqli_stmt_execute($stmt);

}
/**
 * fonction qui permet de mettre a jour le status d'un client 
 * @return bool
 */
function updateRoleUtilisateur($id_utilisateur,$description){
    $result = getRoleByDesc($description);
    if (!$result) {
        echo "Erreur: rôle non trouvé.";
        return false;
    }
    $id = $result['id_role'];
    $sql='update role_utilisateur set id_role=? where id_utilisateur=?';
    $conn = connexionDB();
 $stmt=mysqli_prepare($conn,$sql);
 mysqli_stmt_bind_param($stmt,'ii',$id,$id_utilisateur);
 return mysqli_stmt_execute($stmt);

}
/**Ne fonctionne pas encore 
 * fonction qui retourne le role d'un utilisateur en fonction de son id
 * @param int $id_utilisateur
 * @return string|bool
 */
function getRoleUtilisateur($id_utilisateur){
    $sql='select id_role from Role_utilisateur where id_utilisateur = ? ';
    $conn = connexionDB();
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    $result =  mysqli_stmt_execute($stmt);
    if($result){
        $result=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }else{
        return false;
    }
}
function suppressProduit($produit){
    $id_produit= $produit['id_produit'];
    $sql='delete from produit where id_produit=?';
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id_produit);
    return mysqli_stmt_execute($stmt);

}
function CalculTotal(){
    $total = 0;
    $conn = connexionDB();
     
    foreach ($_SESSION['panier'] as $id_produit => $quantite) {
            $sql ='SELECT prix_unitaire FROM produit WHERE id_produit=?';
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,'i',$id_produit);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            $total+=$row['prix_unitaire']*$quantite;
    }

    return $total;
}
function ajouter_commande(){
    if(isset($_SESSION['utilisateur'])){
        if(empty($_SESSION['panier'])){
            die('votre panier est vide');
        }

        $id_utilisateur = $_SESSION['utilisateur']['id_utilisateur'];
        $conn = connexionDB();
         $prix_total=CalculTotal();
        //  var_dump($prix_total);
        $quantite_commande = array_sum($_SESSION['panier']);
       
        $date_commande = date('Y-m-d H:i:s');
        $sql = 'insert into commande (date_commande,id_utilisateur,quantite_commande,prix_total) values(?,?,?,?)';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'sidd',$date_commande,$id_utilisateur,$quantite_commande,$prix_total);
        mysqli_stmt_execute($stmt);

        $id_commande = mysqli_insert_id($conn);
        foreach($_SESSION['panier'] as $id_produit => $quantite){
            $sql = 'insert into produit_commande(id_produit,id_commande,quantite) values(?,?,?)';
            $stmt = mysqli_prepare($conn,$sql);
            // $quantite=$quantite-1;
            mysqli_stmt_bind_param($stmt,'iii',$id_produit,$id_commande,$quantite);
            mysqli_stmt_execute($stmt);
            // var_dump($quantite);
        }

         unset($_SESSION['panier']);
        ?>
            <script>
            window.location.href='adresse.php?id=<?= $id_commande ; ?>';
          </script>
       <?php
    }else{
        return "l'utilisateur n'est pas connecté";
    }
}
function ajouterAdresse($adresse){
    if(isset($_SESSION['utilisateur'])){

        
        $ville = $adresse['ville'];
        $code_postal = $adresse['code_postal'];
        $pays = $adresse['pays'];
        $numero = $adresse['numero'];
        $province = $adresse['province'];
        $conn = connexionDB();

        $sql = 'insert into adresse (ville,code_postal,pays,numero,province) values(?,?,?,?,?)';
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,'sssss',$ville,$code_postal,$pays,$numero,$province);
        $result = mysqli_stmt_execute($stmt);
        $id_adresse = mysqli_insert_id($conn);
        if($result){
            $id_utilisateur = $_SESSION['utilisateur']['id_utilisateur'];         
            $sql = "insert into adresse_utilisateur(id_adresse,id_utilisateur)values(?,?)";
            $stmt = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($stmt,'ii',$id_adresse,$id_utilisateur);
           $result = mysqli_stmt_execute($stmt);
           if($result){
                return true;
           }else{
            return false;
           }
        }
      
    }
}


function afficherAdresse($id_utilisateur){
    $sql='SELECT a.ville, a.code_postal, a.pays,a.province,a.numero FROM adresse a JOIN adresse_Utilisateur au ON a.id_adresse = au.id_adresse WHERE au.id_utilisateur = ?';
    $conn = connexionDB();
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_utilisateur);
    $result =  mysqli_stmt_execute($stmt);
    if($result){
        $result=mysqli_stmt_get_result($stmt);
        $adresses=[];
        if(mysqli_num_rows($result)>0){
            while($adresse = mysqli_fetch_assoc($result)){
                $adresses[]=$adresse;
            }
        }
        
        return $adresses;
    }  

    
}

function getCommande(){
    $sql='select c.date_commande, c.quantite_commande,c.prix_total,c.id_commande,u.nom from commande c , utilisateur u where u.id_utilisateur = c.id_utilisateur  ';
    $connex = connexionDB();
    $result=mysqli_query($connex,$sql);
    $commandes = [];
    foreach($result as $cmd){
        $commandes[]=$cmd;
    }
    return $commandes;
}
function supprimerCommande($id_commande){
    $sql='delete from commande where id_commande=?';
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,"i",$id_commande);
    $resultat=  mysqli_stmt_execute($stmt);
    if($resultat){
return true;
    }else{
        return false;
    }
}
function updateStatus($status,$id){
    $sql = "update utilisateur set statut = ? where id_utilisateur = ?";
    $conn = connexionDB();
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'si',$status,$id);
    return mysqli_stmt_execute($stmt);
}
/**
 * fonction qui retourne tous nos produits
 * @return array 
 */
function chercherSysteme($sys){
    $sql = 'select p.*,i.chemin from produit p left join Image i on p.id_produit=i.id_produit where p.sys = ?';
    $conn = connexionDB();
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt,'s',$sys);
    $result =  mysqli_stmt_execute($stmt);
    if($result){
        $result=mysqli_stmt_get_result($stmt);
        $sys_produit=[];
        if(mysqli_num_rows($result)>0){
            while($sys_p = mysqli_fetch_assoc($result)){
                $sys_produit[]=$sys_p;
            }
        }
        
        return $sys_produit;
    }  

    
    }
function getPrixTotalById($id_commande){
    $sql = 'SELECT prix_total FROM commande WHERE id_commande = ?';
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex, $sql);

    mysqli_stmt_bind_param($stmt, 'i', $id_commande);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_bind_result($stmt, $prix_total);
    mysqli_stmt_fetch($stmt);
    
    
    return $prix_total;
     
}

function afficherDetailsCommande($id_commande) {

    // Requête SQL pour récupérer les détails de la commande
    $sql = "
        SELECT 
            c.id_commande,
            c.date_commande,
            c.quantite_commande,
            c.prix_total,
            u.nom AS nom_utilisateur,
            u.prenom AS prenom_utilisateur,
            p.nom AS nom_produit,
            p.model AS model_produit,
            p.couleur AS couleur_produit,
            p.taille_ecran AS taille_ecran_produit,
            p.prix_unitaire AS prix_unitaire_produit,
            pc.quantite AS quantite_produit_commande,
            i.chemin AS chemin_image
        FROM 
            Commande c
            JOIN Utilisateur u ON c.id_utilisateur = u.id_utilisateur
            JOIN produit_commande pc ON c.id_commande = pc.id_commande
            JOIN Produit p ON pc.id_produit = p.id_produit
            LEFT JOIN Image i ON p.id_produit = i.id_produit
        WHERE 
            c.id_commande = ?
    ";
    $connex = connexionDB();
    $stmt = mysqli_prepare($connex,$sql);
    mysqli_stmt_bind_param($stmt,'i',$id_commande);
    $result = mysqli_stmt_execute($stmt);
    if($result){
        $result=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
            return mysqli_fetch_assoc($result);
        }else{
            return false;
        }
    }else{
        return false;
    }

}
