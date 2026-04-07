# FootTalents Africa - Prototype Frontend (Laravel & Tailwind CSS)

Ce projet est une transformation de la maquette HTML statique en une application Laravel fonctionnelle (partie frontend), avec des données simulées (mock).

## Prérequis
- PHP 8.1 ou supérieur
- Composer

## Comment lancer le projet ?

1. Assurez-vous d'être dans le dossier `laravel/`
2. Installez les dépendances si ce n'est pas déjà fait :
   ```bash
   composer install
   ```
3. Démarrez le serveur de développement Laravel :
   ```bash
   php artisan serve
   ```
4. Accédez au projet via : http://127.0.0.1:8000

## Structure des dossiers
- `app/Http/Controllers/` : Contient les contrôleurs Laravel qui renvoient les vues (les données mockées y sont injectées depuis la configuration).
- `config/mock-data.php` : Fichier de configuration contenant de fausses données réparties entre joueurs, coachs et académies.
- `resources/views/` : Dossier contenant les templates Blade classés par rôle et section.
  - `layouts/app.blade.php` : Layout principal contenant le header, le footer et l'inclusion du CSS (via CDN Tailwind).
  - `components/player-card.blade.php` : Composant réutilisable pour afficher la fiche de présentation d'un joueur.
  - `accueil/`, `academie/`, `coach/`, `joueur/`, `recruteur/`, `auth/` : Vues spécifiques à chaque espace.
- `routes/web.php` : Contient toutes les routes web de l'application.

## Simulation des différents rôles

La connexion se fait actuellement sans base de données, à l'aide d'un mot de passe mocké et d'une liste déroulante sur la page de connexion.
1. Allez sur **Se connecter** : http://127.0.0.1:8000/login
2. Choisissez le **Rôle** souhaité dans la liste déroulante fournie dans le cadre informatif (mock : recruteur, academie, coach, joueur).
3. Cliquez sur **Se connecter** (les identifiants ne sont pas vérifiés réellement).
4. Le mot de passe ou email peut être défini à n'importe quelle valeur pour le prototype.
5. Vous serez automatiquement redirigé vers le Dashboard associé (ex: `/academie/dashboard`).
6. Le menu de navigation central s'adaptera automatiquement à ce rôle.

## Routes principales disponibles

### Publiques
| Route | URL | Description |
|-----------|-----------|-----------|
| `accueil` | `/` | Page d'accueil du projet |
| `explorer` | `/explorer` | Moteur de recherche des joueurs |
| `joueur.public` | `/joueur/{id}` | Fiche détaillée publique d'un joueur |
| `login` | `/login` | Formulaire de connexion partagé |
| `register.academie` | `/register/academie` | Inscription spécifique (génère la connexion role Académie au clic) |

### Dashboards Mocks (Accessibles aux connectés ou navigation simplifiée)
| Rôle | URL | Description |
|-----------|-----------|-----------|
| **Académie** | `/academie/dashboard` | Espace Admin pour gérér ses coachs et valider les effectifs |
| **Coach** | `/coach/dashboard` | Espace pour voir ses membres pris en charge, statistiques de validation |
| **Joueur** | `/joueur/dashboard` | Espace personnel pour médias vidéos et notations |
| **Recruteur**| `/recruteur/dashboard`| Statistiques de favoritisme et d'exploration de profil |

**Note** : L'interface est fidèlement implémentée en Tailwind CSS "mobiles-first" via script CDN comme sur la maquette d'origine. La base de données et l'authentification sécurisée seront traitées dans les phases backend ultérieures.
