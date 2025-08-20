# RACED ONG - Plateforme Web Laravel

Bienvenue sur la plateforme web de l'ONG RACED, développée avec Laravel. Ce projet propose un site web dynamique pour la gestion de contenus institutionnels, d'actualités, de rapports, d'équipe, de galerie, de partenaires, de témoignages, de statistiques, et bien plus encore.

## Présentation du projet

Cette application permet à une ONG ou une association de :
- Présenter ses missions, valeurs, équipe, axes d'intervention, partenaires, etc.
- Publier des actualités, des rapports, des projets, des témoignages.
- Gérer dynamiquement les pages, les sections, les menus, la galerie photo.
- Administrer l'ensemble du contenu via une interface d'administration sécurisée.

## Fonctionnalités principales

- **Gestion des pages dynamiques** (création, édition, sections personnalisées)
- **Actualités** (catégories, publication programmée, éditeur riche)
- **Rapports** (catégories, téléchargement PDF, affichage par catégorie)
- **Galerie d'images** (catégories, upload, affichage frontend)
- **Équipe & membres** (catégories, fiches membres)
- **Partenaires, témoignages, statistiques**
- **Paramètres du site** (coordonnées, réseaux sociaux, numéros MOMO/MOOV/CELTIIS, mail, etc.)
- **Gestion des menus dynamiques**
- **Newsletter, contact, bénévolat**
- **Interface d'administration complète**
- **Frontend moderne et responsive**

## Prérequis

- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL/MariaDB ou autre SGBD compatible
- [Optionnel] Redis/Memcached pour le cache

## Installation

1. **Cloner le dépôt**
   ```bash
   git clone <url-du-repo> raced
   cd raced
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances front-end**
   ```bash
   npm install
   npm run build # ou npm run dev pour le développement
   ```

4. **Configurer l'environnement**
   - Copier le fichier `.env.example` en `.env` :
     ```bash
     cp .env.example .env
     ```
   - Modifier les variables d'environnement (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.)

5. **Générer la clé d'application**
   ```bash
   php artisan key:generate
   ```

6. **Lancer les migrations et les seeders**
   ```bash
   php artisan migrate --seed
   ```

7. **Créer le lien de stockage pour les fichiers uploadés**
   ```bash
   php artisan storage:link
   ```

8. **Démarrer le serveur de développement**
   ```bash
   php artisan serve
   ```

## Utilisation

- **Accès à l'administration** :
  - URL : `/admin`
  - Identifiants par défaut : voir le seeder ou créer un utilisateur via artisan
- **Accès au site public** :
  - URL : `/`
- **Gestion des modules** :
  - Pages, actualités, rapports, galerie, équipe, partenaires, etc. via le menu admin
- **Paramètres du site** :
  - Menu "Paramètres" pour configurer les coordonnées, réseaux sociaux, numéros MOMO/MOOV/CELTIIS, mail, etc.

## Personnalisation

- **Ajout de sections dynamiques** : via l'admin, menu "Sections" ou "Pages"
- **Modification des menus** : via l'admin, menu "Menus"
- **Ajout de catégories** : pour actualités, rapports, équipe, galerie, etc.
- **Configuration des couleurs, logos, images** : via "Paramètres" ou en remplaçant les fichiers dans `public/assets/images/`

## Déploiement

- **Configurer `.env` pour la production** (cache, mail, base de données, etc.)
- **Compiler les assets** :
  ```bash
  npm run build
  ```
- **Optimiser le cache** :
  ```bash
  php artisan config:cache
  php artisan route:cache
  php artisan view:cache
  ```
- **Sécuriser le dossier `storage` et les permissions**

## Support & Contribution

- Pour toute question ou bug, ouvrez une issue sur le dépôt GitHub.
- Les contributions sont les bienvenues !
- Merci de respecter le code de conduite du projet.

## Licence

Ce projet est open-source sous licence MIT.
