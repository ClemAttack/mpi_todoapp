<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer un utilisateur de test
        $user = User::firstOrCreate([
            'email' => 'test@example.com'
        ], [
            'name' => 'Utilisateur Test',
            'password' => bcrypt('password'),
        ]);

        // Créer des todos d'exemple
        $todos = [
            [
                'title' => 'Apprendre Laravel',
                'description' => 'Étudier les concepts de base de Laravel et créer une première application',
                'completed' => false,
                'due_date' => now()->addDays(7),
            ],
            [
                'title' => 'Faire les courses',
                'description' => 'Acheter du pain, du lait et des fruits',
                'completed' => true,
                'due_date' => now()->subDays(1),
            ],
            [
                'title' => 'Appeler le médecin',
                'description' => 'Prendre rendez-vous pour un contrôle annuel',
                'completed' => false,
                'due_date' => now()->addDays(3),
            ],
            [
                'title' => 'Nettoyer la maison',
                'description' => 'Passer l\'aspirateur et faire la poussière',
                'completed' => false,
                'due_date' => now()->addDays(1),
            ],
            [
                'title' => 'Réviser pour l\'examen',
                'description' => 'Relire les chapitres 5 à 8 du cours de PHP',
                'completed' => false,
                'due_date' => now()->addDays(5),
            ],
        ];

        foreach ($todos as $todoData) {
            Todo::create(array_merge($todoData, ['user_id' => $user->id]));
        }
    }
}
