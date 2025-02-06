# Site de Vente de Téléphones

Un site web en **PHP procédural**, sans framework, permettant l'achat de téléphones en ligne avec paiement via l'API PayPal. Ce projet tourne sur XAMPP et utilise MySQL comme base de données. 

Ce projet utilise **HTML, CSS, JavaScript et Bootstrap** pour l'interface utilisateur.

---

## 📌 Fonctionnalités

-  Liste des téléphones disponibles avec description et prix.
-  Système de panier pour ajouter et gérer les achats.
-  Paiement sécurisé avec l'API PayPal.
-  Système de gestion des utilisateurs (connexion, inscription).
-  Interface d'administration pour gérer les produits.
-  Stockage des commandes dans une base de données MySQL.

## 📌 Installation et configuration

### 📌 Prérequis

- PHP (≥ 7.x)
- MySQL
- XAMPP (Apache, MySQL, PHP)
- Un compte **PayPal Developer** pour les paiements en mode test (sandbox)

### 📌 Étapes d'installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/RIKIEL-K/site-E-commerce.git
   cd site-E-commerce

# Fichier de configuration (`config.php`)

```php
define("DB_HOST", "localhost");
define("DB_USER", "VOTRE_UTILISATEUR");
define("DB_PASSWORD", "VOTRE_MOT_DE_PASSE");
define("DB_NAME", "VOTRE_BASE_DE_DONNEES");
define("DB_PORT", 3306);

define('PAYPAL_CLIENT_ID', 'votre_client_id');

