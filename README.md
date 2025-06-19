# TodoApp - Application de Gestion de Tâches

Une application web moderne de gestion de tâches (Todo) développée avec Laravel 12, offrant une interface utilisateur intuitive et des fonctionnalités avancées.

## 🚀 Fonctionnalités

### ✨ Fonctionnalités Principales
- **Gestion complète des todos** : Création, lecture, modification, suppression (CRUD)
- **Authentification utilisateur** : Inscription, connexion et déconnexion sécurisées
- **Interface moderne** : Design responsive avec Tailwind CSS et Font Awesome
- **Statuts des tâches** : Marquage des todos comme terminées/non terminées
- **Dates d'échéance** : Gestion des échéances avec alertes de retard
- **Statistiques** : Vue d'ensemble avec compteurs de todos
- **Sécurité** : Autorisations par utilisateur (chaque utilisateur ne voit que ses propres todos)

### 🎨 Interface Utilisateur
- Design moderne et responsive
- Navigation intuitive
- Messages de confirmation et d'erreur
- Indicateurs visuels pour les todos en retard
- Animations et transitions fluides

## 🛠️ Technologies Utilisées

- **Backend** : Laravel 12 (PHP 8.2+)
- **Frontend** : Tailwind CSS, Font Awesome
- **Base de données** : MySQL
- **Authentification** : Laravel Auth
- **Validation** : Laravel Form Requests
- **Autorisations** : Laravel Policies

## 📋 Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL 5.7 ou supérieur
- Node.js et NPM (pour les assets)

## 🚀 Installation

### 1. Cloner le projet
```bash
git clone <url-du-repo>
cd todoapp
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Configuration de l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configuration de la base de données
Modifiez le fichier `.env` avec vos paramètres de base de données :
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todoapp
DB_USERNAME=votre_username
DB_PASSWORD=votre_password
```

### 5. Exécuter les migrations
```bash
php artisan migrate
```

### 6. Seeder la base de données (optionnel)
```bash
php artisan db:seed
```

### 7. Installer les dépendances frontend (optionnel)
```bash
npm install
npm run dev
```

### 8. Démarrer le serveur
```bash
php artisan serve
```

L'application sera accessible à l'adresse : `http://localhost:8000`

## 👤 Comptes de Test

Après avoir exécuté le seeder, vous pouvez vous connecter avec :
- **Email** : `test@example.com`
- **Mot de passe** : `password`

## 📁 Structure du Projet

```
todoapp/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   └── RegisteredUserController.php
│   │   │   └── TodoController.php
│   │   └── Requests/
│   │       └── Auth/
│   │           └── LoginRequest.php
│   ├── Models/
│   │   ├── Todo.php
│   │   └── User.php
│   └── Policies/
│       └── TodoPolicy.php
├── database/
│   ├── migrations/
│   │   └── 2025_06_19_075531_create_todos_table.php
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── TodoSeeder.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── layouts/
│       │   └── app.blade.php
│       └── todos/
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── index.blade.php
│           └── show.blade.php
└── routes/
    ├── auth.php
    └── web.php
```

## 🔧 Configuration

### Variables d'environnement importantes
- `APP_NAME` : Nom de l'application
- `APP_ENV` : Environnement (local, production, etc.)
- `APP_DEBUG` : Mode debug
- `DB_*` : Configuration de la base de données
- `MAIL_*` : Configuration des emails (si nécessaire)

### Personnalisation
- **Couleurs** : Modifiez les classes Tailwind CSS dans les vues
- **Logo** : Remplacez l'icône Font Awesome dans `layouts/app.blade.php`
- **Validation** : Ajustez les règles dans les Form Requests

## 🚀 Déploiement

### Production
1. Configurez votre serveur web (Apache/Nginx)
2. Définissez `APP_ENV=production` et `APP_DEBUG=false`
3. Optimisez l'application :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```
4. Configurez les permissions des dossiers `storage` et `bootstrap/cache`

### Docker (optionnel)
```dockerfile
FROM php:8.2-fpm
# Configuration Docker...
```

## 🧪 Tests

```bash
# Exécuter tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

## 📝 API (Futur)

L'application est conçue pour être facilement extensible avec une API REST :
- Routes API dans `routes/api.php`
- Contrôleurs API dédiés
- Authentification par tokens

## 🤝 Contribution

1. Fork le projet
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 📄 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 🆘 Support

Pour toute question ou problème :
- Ouvrez une issue sur GitHub
- Contactez l'équipe de développement

## 🔄 Mises à jour

### Laravel
```bash
composer update laravel/framework
php artisan migrate
```

### Dépendances
```bash
composer update
npm update
```

## 📊 Statistiques du Projet

- **Lignes de code** : ~2000
- **Fichiers** : ~50
- **Fonctionnalités** : 10+
- **Tests** : À implémenter

---

**Développé avec ❤️ en utilisant Laravel**
