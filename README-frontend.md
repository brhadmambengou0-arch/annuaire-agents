# Annuaire Agent — Frontend

## Présentation

Le frontend de ce projet est intégré à Laravel via Vite. Il utilise :

- Vite comme build tool
- Tailwind CSS pour les styles
- Alpine.js pour les interactions légères
- Le plugin Laravel Vite pour charger les assets dans Blade

## Installation

1. Installer les dépendances Node :

```bash
npm install
```

2. Démarrer le mode développement :

```bash
npm run dev
```

3. Générer les assets de production :

```bash
npm run build
```

## Configuration

Le fichier `vite.config.js` expose les entrées suivantes :

- `resources/css/app.css`
- `resources/js/app.js`

Le fichier `tailwind.config.js` est configuré pour scanner :

- `resources/views/**/*.blade.php`
- `storage/framework/views/*.php`
- les vues de pagination Laravel

## Structure principale

- `resources/css/app.css` : styles globaux Tailwind
- `resources/js/app.js` : point d’entrée JavaScript
- `tailwind.config.js` : configuration Tailwind
- `vite.config.js` : configuration Vite

## Bonnes pratiques

- En développement, laissez `npm run dev` tourner pour le rafraîchissement automatique.
- En production, lancer `npm run build` avant le déploiement.
- Si vous modifiez les composants Blade, Vite recharge automatiquement grâce à `refresh: true`.

## Intégration Laravel

Les assets compilés sont inclus dans les vues Blade via le plugin Laravel Vite. Ainsi, le frontend reste pleinement intégré au backend Laravel.
