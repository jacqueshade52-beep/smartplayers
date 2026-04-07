# 📘 Documentation Technique & Logique Métier - SmartPlayer 2.0

## 1. Vision du Projet
**SmartPlayer** est une plateforme SAAS conçue pour digitaliser le recrutement sportif (football) en Afrique. Elle permet de certifier les talents via les académies et de les exposer aux recruteurs internationaux.

---

## 2. Architecture du Système
Le projet est bâti sur **Laravel 11** en suivant le pattern **MVC (Modèle-Vue-Contrôleur)**.

### 👤 Système de Rôles (Roles)
Chaque utilisateur (`User`) possède un rôle unique qui définit ses permissions et son espace de travail :
*   **Académie (`academie`) :** Entité institutionnelle. Gère les coachs, les infrastructures et valide globalement les profils.
*   **Coach (`coach`) :** Le bras technique. Il crée les profils des joueurs, remplit les évaluations techniques et valide les talents pour l'exposition publique.
*   **Joueur (`joueur`) :** Le talent. Il gère sa biographie, ses photos et sa bibliothèque de vidéos highlights.
*   **Recruteur (`recruteur`) :** L'utilisateur final (Agents, Scouts). Il explore la base de données, met des joueurs en favoris et contacte les académies.

---

## 3. Modèle de Données (Database Schema)

### 📂 Modèles Principaux (`app/Models`)
*   **`User` :** Gère l'authentification (email/password), le rôle, et les photos globales (profil/couverture).
*   **`Academie` :** Détails du club (Nom, Ville, Pays, Logo, Site Web).
*   **`Coach` :** Lié à une académie. Possède une catégorie (ex: U19).
*   **`Joueur` :** Entité riche contenant :
    *   *Infos Fixes :* Poste, Pied fort, Académie, Nationalité.
    *   *Stats Dynamiques :* Buts, Passes, Matchs joués, Taille, Poids.
    *   *Statut :* `brouillon` (privé), `en_attente` (correction), `validé` (public).
*   **`Evaluation` :** Stocke les notes techniques (0-100) pour la Vitesse, Frappe, Vision, Dribble, Physique et Passe.
*   **`Message` :** Gère les discussions instantanées (sender_id, receiver_id, content, is_read).
*   **`JoueurVideo` :** Liens vers les fichiers MP4 stockés pour chaque joueur.

---

## 4. Workflows Métier Clés

### 📝 Inscription & Création
1.  Une **Académie** s'inscrit sur la plateforme.
2.  L'Académie invite des **Coachs** via leur email.
3.  Le **Coach** crée des fiches **Joueurs**. Un compte utilisateur (`User`) est généré automatiquement avec un mot de passe temporaire pour le joueur.

### ⚽ Évaluation & Validation
1.  Le **Coach** remplit une évaluation technique pour un joueur.
2.  Une fois l'évaluation et le profil complets, le Coach change le statut en **`validé`**.
3.  Le profil devient alors **visible publiquement** sur la page `/explorer`.

### 🔍 Recrutement
1.  Le **Recruteur** utilise les filtres (Poste, Âge, Ville) pour trouver des talents.
2.  Il peut ajouter un joueur à ses **Favoris**.
3.  Il peut cliquer sur "Contacter l'Académie" pour ouvrir une discussion directe.

---

## 5. Structure des Fichiers Clés

### 🕹️ Contrôleurs (`app/Http/Controllers`)
*   `AccueilController` : Gère la page vitrine publique.
*   `RecruteurController` : Moteur de recherche, explorateur et gestion des favoris.
*   `CoachController` : Gestion des effectifs, évaluations et validations.
*   `AcademieController` : Gestion du staff technique et profil du club.
*   `JoueurController` : Gestion du profil personnel (vidéos, stats).
*   `MessageController` : Messagerie unifiée pour tous les rôles.
*   `PageController` : Pages statiques (CGU, Confidentialité, Mentions Légales).

### 🎨 Vues & UI (`resources/views`)
*   `layouts/app.blade.php` : Layout maître avec design "Premium" (effets de flou, dégradés).
*   `partials/nav.blade.php` : Navigation réactive qui s'adapte au rôle de l'utilisateur.
*   `components/player-card.blade.php` : Composant réutilisable pour afficher un résumé de joueur.
*   `pages/` : Contenu statique et juridique personnalisé.

---

## 6. Design & UX System
*   **Couleurs :** Vert Bénin (#008751), Jaune (#E6AD12), Rouge (#E30613), Bleu Saphir (#1A2B3C).
*   **Aesthetics :** Glassmorphism, animations au scroll (Reveal.js), ombres portées douces.
*   **Typographie :** Utilisation de polices modernes pour un aspect "Sport Pro".

---

*Ceci constitue la base logique du projet SmartPlayer. Pour toute modification majeure, se référer aux relations dans les modèles Eloquent.*
