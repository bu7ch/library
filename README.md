# 📚 Projet de Révision PHP : Système de Gestion de Bibliothèque (Mini-Framework MVC)

Ce projet est un exercice intensif d'une journée pour réviser les fondamentaux du développement web en PHP : POO, MVC, PDO et sécurité.

## 🛠️ Prérequis

*   **PHP** (version 8.0 ou supérieure)
*   **Serveur Web** (Apache avec `mod_rewrite` activé ou Nginx)
*   **Base de Données** (MySQL ou MariaDB)
*   **Composer** (fortement recommandé pour l'autoloading)

## 🚀 Initialisation

### 1. Base de Données

Créez une base de données nommée `bibliotheque` et exécutez la requête SQL suivante :

```sql
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    auteur VARCHAR(255) NOT NULL,
    annee INT
);
```

### 2. Configuration

*   **Autoloading :** Si vous utilisez Composer, créez un fichier `composer.json` et exécutez `composer install`.
*   **Connexion DB :** Dans votre classe `Database.php`, configurez les paramètres de connexion (hôte, nom de la base, utilisateur, mot de passe).

### 3. Structure de Fichiers

Assurez-vous d'avoir la structure de dossiers suivante :

```
/bibliotheque/
├── public/
│   ├── .htaccess
│   └── index.php
├── src/
│   ├── Controller/
│   ├── Model/
│   └── View/
└── vendor/ (si Composer est utilisé)
```

### 4. Lancement

Placez le dossier `bibliotheque` dans le répertoire de votre serveur web (`htdocs` ou `www`). L'application devrait être accessible via une URL propre, par exemple : `http://localhost/bibliotheque/livres`.

**Bon courage !**
