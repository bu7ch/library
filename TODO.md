# TODO – Projet PHP MVC (Library)

## Gestion de dépendances
- **`composer.json`** : ajouter les packages requis (ex: symfony/http-foundation, monolog/monolog, guzzlehttp/guzzle pour requêtes HTTP, phpunit/phpunit pour les tests).
- Exécuter `composer install` puis vérifier le `composer.lock`.

## Initialisation & configuration
- Créer un fichier `.env` ou `.env.example` avec les paramètres : DB_HOST, DB_NAME, DB_USER, DB_PASS, etc.
- Implémenter une petite façade de chargement d’environnement dans `public/index.php` ou un fichier bootstrap.

## Routing & Entrypoint
### Dans `public/index.php` :
- Lire l’URI, router vers le bon contrôleur et action.
- Gérer les méthodes HTTP (GET, POST, PUT, DELETE).
- Renvoyer les vues correspondantes.

## Modèle `Livre`
### `src/Model/Livre.php`
- Propriétés : id, titre, auteur, isbn, description, date_publication.
- Créer les getters/setters et éventuellement un constructeur.

### `src/Model/Database.php`
- Implémenter une connexion PDO unique (singleton).
- Gérer les erreurs et la mise en cache de la connexion.

## Repository `LivreRepository`
### `src/Model/LivreRepository.php`
- Méthodes CRUD : `find($id)`, `findAll()`, `save(Livre $livre)`, `update(Livre $livre)`, `delete($id)`.
- Utiliser des requêtes préparées.
- Ajouter des filtres ou pagination si nécessaire.

## Service `OpenLibrary`
### `src/Service/OpenLibrary.php`
- Mettre en place des requêtes HTTP vers l’API OpenLibrary pour récupérer des livres (ex: par ISBN).
- Parser les réponses JSON et mapper sur `Livre` ou un DTO.

## Contrôleur `LivreController`
### `src/Controller/LivreController.php`
- Actions : `index()`, `show($id)`, `create()`, `store()`, `edit($id)`, `update($id)`, `delete($id)`.
- Utiliser la session pour les flash messages.
- Renvoyer les vues correspondantes (`../View/livre/index.php` etc.).

## Vues
- `src/View/layout.php` : layout commun (header, footer).
- `src/View/livre/*.php` : templates pour lister, créer, éditer, afficher un livre.
- Utiliser `<?= ... ?>` ou `<?= $this->render... ?>` selon la logique de rendu.

## Tests unitaires
- **`tests/Unit/LivreTest.php`** : tester la classe modèle (getters/setters).
- **`tests/Unit/LivreRepositoryTest.php`** : mocker la connexion PDO ou utiliser une base de test.
- `tests/Bootstrap.php` : charger l'autoload, configurer l'environnement (ex: un fichier `tests.env`).

## Configuration PHPUnit
- **`phpunit.xml`** : définir le bootstrap, les groups, le coverage, etc.
- Vérifier que les tests passent localement.

## Documentation
- Mettre à jour le `README.md` avec : installation, configuration, création de la base, tests, contribution.
- Ajouter des commentaires de code clairs.

## Sécurité & bonnes pratiques
- Valider toutes les entrées utilisateur (prévenir XSS/SQL injection).
- Utiliser des prepared statements partout.
- Gestion des erreurs propre : try/catch, logger.

## Versioning / Branching
- Créer un dépôt Git (`.git` déjà présent) et pousser les commits.
- Utiliser des branches `feature/*`, `bugfix/*`, `release/*`.



> **Note** : Suivre cette liste étape par étape devrait mener à un projet MVC fonctionnel, testable et embarqué dans Docker.
