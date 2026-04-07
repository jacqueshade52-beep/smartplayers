<?php

return [
    'joueurs' => [
        [
            'id' => 1,
            'nom' => 'Koffi',
            'prenom' => 'Jean',
            'age' => 19,
            'poste' => 'Milieu offensif',
            'club' => 'AJ Cotonou',
            'nationalite' => 'Bénin',
            'taille' => 178,
            'poids' => 72,
            'pied_fort' => 'Droit',
            'note_technique' => 4.5,
            'note_tactique' => 4.2,
            'note_physique' => 4.7,
            'description' => 'Jeune milieu avec une belle vista et une excellente qualité de passe.',
            'statut' => 'validé',
            'videos' => [
                ['titre' => 'Highlight match vs ASPAC', 'url' => '#'],
                ['titre' => 'Entraînement', 'url' => '#'],
            ],
            'stats' => [
                'matchs' => 24,
                'buts' => 8,
                'passes' => 12
            ]
        ],
        [
            'id' => 2,
            'nom' => 'Ahoueya',
            'prenom' => 'Paul',
            'age' => 18,
            'poste' => 'Défenseur central',
            'club' => 'ASPAC FC',
            'nationalite' => 'Bénin',
            'taille' => 185,
            'poids' => 80,
            'pied_fort' => 'Gauche',
            'note_technique' => 3.8,
            'note_tactique' => 4.5,
            'note_physique' => 4.8,
            'description' => 'Solide dans les duels, bonne relance.',
            'statut' => 'en_attente',
            'videos' => [],
            'stats' => [
                'matchs' => 20,
                'buts' => 2,
                'passes' => 1
            ]
        ],
        [
            'id' => 3,
            'nom' => 'Diop',
            'prenom' => 'Moussa',
            'age' => 20,
            'poste' => 'Attaquant',
            'club' => 'LOTO-POPO',
            'nationalite' => 'Sénégal',
            'taille' => 182,
            'poids' => 75,
            'pied_fort' => 'Droit',
            'note_technique' => 4.7,
            'note_tactique' => 4.0,
            'note_physique' => 4.5,
            'description' => 'Rapide et clinique devant le but.',
            'statut' => 'validé',
            'videos' => [
                ['titre' => 'Buts saison 2024', 'url' => '#']
            ],
            'stats' => [
                'matchs' => 28,
                'buts' => 15,
                'passes' => 5
            ]
        ]
    ],
    'academies' => [
        [
            'id' => 1,
            'nom' => 'AJ Cotonou',
            'ville' => 'Cotonou',
            'pays' => 'Bénin',
            'description' => 'Académie formatrice de talents depuis 2010.',
            'stats' => [
                'coachs' => 4,
                'joueurs' => 120
            ]
        ]
    ],
    'coachs' => [
        [
            'id' => 1,
            'nom' => 'Mensah',
            'prenom' => 'Charles',
            'academie_id' => 1,
            'categorie' => 'U19'
        ]
    ]
];
