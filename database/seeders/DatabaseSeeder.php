<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Academie;
use App\Models\Coach;
use App\Models\Joueur;
use App\Models\Recruteur;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // On s'assure que la base est propre (optionnel si on utilise migrate:fresh)
        
        $this->command->info('Début du remplissage de la base de données...');

        // 1. CRÉATION DES ACADÉMIES
        $academiesData = [
            [
                'name' => 'Académie Sitatunga',
                'email' => 'contact@sitatunga.bj',
                'ville' => 'Abomey-Calavi',
                'desc' => 'Centre de formation d\'excellence spécialisé dans la détection précoce.'
            ],
            [
                'name' => 'Bénin Foot Academy',
                'email' => 'info@beninfoot.bj',
                'ville' => 'Cotonou',
                'desc' => 'L\'académie de référence pour les futurs professionnels du football béninois.'
            ]
        ];

        foreach ($academiesData as $index => $aData) {
            $user = User::create([
                'name' => $aData['name'],
                'email' => $aData['email'],
                'password' => Hash::make('password123'),
                'role' => 'academie',
                'has_onboarded' => true
            ]);

            $academie = Academie::create([
                'user_id' => $user->id,
                'nom' => $aData['name'],
                'ville' => $aData['ville'],
                'pays' => 'Bénin',
                'description' => $aData['desc'],
                'email_contact' => $aData['email'],
                'site_web' => 'https://smartplayer.bj/a' . ($index + 1)
            ]);

            // 2. CRÉATION DES COACHS (3 par académie)
            $categories = ['U17', 'U19', 'Espoirs'];
            for ($i = 0; $i < 3; $i++) {
                $coachName = "Coach " . ($index == 0 ? 'Nord' : 'Sud') . " " . ($i + 1);
                $uCoach = User::create([
                    'name' => $coachName,
                    'email' => "coach" . ($i + 1) . "@a" . ($index + 1) . ".bj",
                    'password' => Hash::make('password123'),
                    'role' => 'coach',
                    'has_onboarded' => true
                ]);

                $coach = Coach::create([
                    'user_id' => $uCoach->id,
                    'academie_id' => $academie->id,
                    'prenom' => 'Coach',
                    'nom' => ($index == 0 ? 'Nord' : 'Sud') . " " . ($i + 1),
                    'categorie' => $categories[$i]
                ]);

                // 3. CRÉATION DES JOUEURS (4 par coach)
                $postes = ['Gardien', 'Défenseur', 'Milieu', 'Attaquant'];
                for ($j = 0; $j < 4; $j++) {
                    $uJoueur = User::create([
                        'name' => "Joueur " . ($index + 1) . $i . $j,
                        'email' => "joueur" . ($index + 1) . $i . $j . "@smartplayer.bj",
                        'password' => Hash::make('password123'),
                        'role' => 'joueur',
                        'has_onboarded' => true
                    ]);

                    $joueur = Joueur::create([
                        'user_id' => $uJoueur->id,
                        'coach_id' => $coach->id,
                        'academie_id' => $academie->id,
                        'prenom' => 'Talent',
                        'nom' => "N°" . ($index + 1) . $i . $j,
                        'date_naissance' => now()->subYears(rand(15, 20))->format('Y-m-d'),
                        'nationalite' => 'Béninoise',
                        'poste' => $postes[$j],
                        'pied_fort' => rand(0, 1) ? 'Droit' : 'Gaucher',
                        'categorie' => $categories[$i],
                        'taille' => rand(165, 190),
                        'poids' => rand(60, 85),
                        'description' => 'Un jeune joueur prometteur avec beaucoup de potentiel.',
                        'statut' => rand(0, 5) > 1 ? 'validé' : 'en_attente',
                        'note_technique' => rand(30, 50) / 10,
                        'note_tactique' => rand(30, 50) / 10,
                        'note_physique' => rand(30, 50) / 10,
                        'matchs_joues' => rand(5, 25),
                        'buts_marques' => rand(0, 15),
                        'passes_decisives' => rand(0, 10),
                    ]);

                    // Ajout d'une évaluation radar
                    \App\Models\Evaluation::create([
                        'joueur_id' => $joueur->id,
                        'coach_id' => $coach->id,
                        'vitesse' => rand(60, 95),
                        'frappe' => rand(50, 90),
                        'vision_jeu' => rand(50, 90),
                        'dribble' => rand(60, 95),
                        'physique' => rand(60, 90),
                        'passe' => rand(50, 95),
                        'commentaire_coach' => 'Très bonne marge de progression.',
                        'date_evaluation' => now()
                    ]);
                }
            }
        }

        // 4. CRÉATION DES RECRUTEURS
        $recruteursData = [
            ['name' => 'Marc Scout', 'email' => 'marc@scout.fr', 'org' => 'Lille OSC'],
            ['name' => 'John Agent', 'email' => 'john@global.uk', 'org' => 'Global Sports Agency']
        ];

        foreach ($recruteursData as $idx => $rData) {
            $uRecruteur = User::create([
                'name' => $rData['name'],
                'email' => $rData['email'],
                'password' => Hash::make('password123'),
                'role' => 'recruteur',
                'has_onboarded' => true
            ]);

            $recruteur = Recruteur::create([
                'user_id' => $uRecruteur->id,
                'prenom' => explode(' ', $rData['name'])[0],
                'nom' => explode(' ', $rData['name'])[1],
                'organisation' => $rData['org'],
                'fonction' => 'Scout'
            ]);

            // 5. FAVORIS (5 joueurs aléatoires par recruteur)
            $joueursAleatoires = Joueur::where('statut', 'validé')->inRandomOrder()->limit(5)->get();
            foreach ($joueursAleatoires as $j) {
                $recruteur->favoris()->attach($j->id);
            }

            // 6. MESSAGES (Discussions avec les deux académies)
            $usersAcademies = User::where('role', 'academie')->get();
            foreach ($usersAcademies as $uA) {
                // Message du recruteur
                \App\Models\Message::create([
                    'sender_id' => $uRecruteur->id,
                    'receiver_id' => $uA->id,
                    'subject' => 'Demande d\'informations',
                    'content' => "Bonjour, nous suivons plusieurs de vos joueurs de près. Serait-il possible d'organiser une visioconférence ?",
                    'is_read' => false
                ]);
                
                // Réponse de l'académie
                \App\Models\Message::create([
                    'sender_id' => $uA->id,
                    'receiver_id' => $uRecruteur->id,
                    'subject' => 'Re: Demande d\'informations',
                    'content' => "Bonjour, avec plaisir. Nous sommes disponibles jeudi prochain à 14h.",
                    'is_read' => true
                ]);
            }
        }

        $this->command->info('Base de données réinitialisée et peuplée avec succès !');
        $this->command->warn('Identifiants génériques : academie@foottalents.com | coach1@a1.bj | recruteur@foottalents.com (Pass: password123)');
        $this->command->info('Notes: Utilisez les emails ci-dessus ou les emails générés pour vous connecter.');
    }
}
