# Annuaire Agent — Backend

## Présentation

Ce projet est une application Laravel 12 qui gère un annuaire d'agents et d'entités. Le backend implémente :

- PHP 8.3
- Laravel 12
- Livewire (composants dynamiques côté serveur)
- Laravel Fortify pour l'authentification
- Laravel Sanctum pour l'API / SPA
- Un modèle d'entités hiérarchique avec `entities`, `agents` et `fonctions`

## Installation

1. Installer les dépendances PHP :

```bash
composer install
```

2. Copier le fichier d'environnement :

```bash
cp .env.example .env
```

3. Générer la clé d'application :

```bash
php artisan key:generate
```

4. Configurer la base de données dans `.env` :

- `DB_CONNECTION=pgsql`
- `DB_HOST=127.0.0.1`
- `DB_PORT=5432`
- `DB_DATABASE=annuaire_db`
- `DB_USERNAME=postgres`
- `DB_PASSWORD=postgres`

5. Exécuter les migrations :

```bash
php artisan migrate
```

6. (Optionnel) Charger les seeders si le projet les inclut :

```bash
php artisan db:seed
```

## Scripts utiles

- Démarrer le serveur backend :

```bash
php artisan serve
```

- Exécuter les tests :

```bash
composer test
```

- Vérifier le code avec Pint :

```bash
composer lint
```

- Installer et préparer tout le projet (PHP + Node + build) :

```bash
composer setup
```

## Structure principale

- `app/` : logique métier, modèles, Livewire, contrôleurs
- `database/migrations/` : schéma de la base PostgreSQL
- `database/seeders/` : génération de données de test
- `routes/` : routes web, API et settings
- `resources/views/` : vues Blade
- `resources/css/` : styles Tailwind
- `resources/js/` : point d'entrée frontend Vite

## Notes spécifiques

- La table `entities` utilise un lien hiérarchique `parent_id` pour gérer les directions, services et départements.
- Le backend charge les composants Livewire via les routes et gère l’accès avec le middleware `auth`.
- Le projet utilise la stack Livewire/Volt/Blaze pour l’interface.
