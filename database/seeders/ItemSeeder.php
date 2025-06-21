<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */    public function run()
    {
        // Get users and categories
        $users = User::all();
        $electronics = Category::where('name', 'Electronics')->first();
        $books = Category::where('name', 'Books')->first();
        $clothing = Category::where('name', 'Clothing')->first();
        $accessories = Category::where('name', 'Accessories')->first();
        $documents = Category::where('name', 'Documents')->first();
        $other = Category::where('name', 'Other')->first();

        // Check if categories exist
        if (!$electronics || !$books || !$clothing || !$accessories || !$documents || !$other) {
            $this->command->error('Some categories are missing! Please run CategorySeeder first.');
            return;
        }

        $this->command->info('All categories found. Proceeding with item creation...');

        // ENSA Tangier locations
        $locations = [
            'Amphi 1', 'Amphi 2', 'Amphi 4',
            'Salle A1', 'Salle A2', 'Salle A3', 'Salle A4', 'Salle A5', 'Salle A6', 'Salle A7', 'Salle A8',
            'Salle B1', 'Salle B2', 'Salle B3', 'Salle B4', 'Salle B5', 'Salle B6', 'Salle B7', 'Salle B8', 
            'Salle B9', 'Salle B10', 'Salle B11', 'Salle B12', 'Salle B13', 'Salle B14', 'Salle B15', 
            'Salle B16', 'Salle B17', 'Salle B18', 'Salle B19', 'Salle B20', 'Salle B21',
            'Salle C1', 'Salle C2', 'Salle C3', 'Salle C4', 'Salle C5', 'Salle C6', 'Salle C7', 'Salle C8',
            'Bibliothèque', 'Cafétéria', 'Parking', 'Couloir Principal', 'Laboratoire Informatique'
        ];

        // Sample items data
        $items = [
            // Electronics - Lost items
            [
                'type' => 'lost',
                'category_id' => $electronics->id,
                'title' => 'iPhone 13 Pro - Coque bleue',
                'description' => 'iPhone 13 Pro avec une coque de protection bleue. Écran fissuré au coin supérieur droit. Très important, contient mes photos de famille.',
                'location' => 'Amphi 2',
                'reward' => 300.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $electronics->id,
                'title' => 'MacBook Air M1 - Autocollants',
                'description' => 'MacBook Air gris sidéral avec plusieurs autocollants (Python, React, ENSA). Dans un sac noir Targus.',
                'location' => 'Salle B15',
                'reward' => 500.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $electronics->id,
                'title' => 'AirPods Pro - Boîtier rayé',
                'description' => 'AirPods Pro blancs, boîtier avec quelques rayures. Nom gravé "Ahmed" au dos.',
                'location' => 'Cafétéria',
                'reward' => 100.00,
                'status' => 'active'
            ],

            // Electronics - Found items
            [
                'type' => 'found',
                'category_id' => $electronics->id,
                'title' => 'Chargeur iPhone Lightning',
                'description' => 'Chargeur iPhone original blanc, câble Lightning vers USB-A. Trouvé sur une table.',
                'location' => 'Salle A5',
                'reward' => null,
                'status' => 'active'
            ],
            [
                'type' => 'found',
                'category_id' => $electronics->id,
                'title' => 'Écouteurs Samsung Galaxy Buds',
                'description' => 'Écouteurs sans fil Samsung noirs dans leur boîtier de charge. Trouvés sous un siège.',
                'location' => 'Amphi 1',
                'reward' => null,
                'status' => 'active'
            ],

            // Books - Lost items
            [
                'type' => 'lost',
                'category_id' => $books->id,
                'title' => 'Livre "Algorithmes et Structures de Données"',
                'description' => 'Livre de cours avec notes manuscrites. Couverture rouge, édition 2022. Nom écrit sur la première page.',
                'location' => 'Bibliothèque',
                'reward' => 50.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $books->id,
                'title' => 'Cahier de TP - Réseaux Informatiques',
                'description' => 'Cahier spirale bleu avec tous mes TPs de réseaux. Contient des schémas importants pour les examens.',
                'location' => 'Salle C3',
                'reward' => 30.00,
                'status' => 'active'
            ],

            // Books - Found items
            [
                'type' => 'found',
                'category_id' => $books->id,
                'title' => 'Manuel de Mathématiques',
                'description' => 'Manuel "Analyse et Algèbre" avec marque-pages. Nom effacé sur la couverture.',
                'location' => 'Salle B8',
                'reward' => null,
                'status' => 'active'
            ],
            [
                'type' => 'found',
                'category_id' => $books->id,
                'title' => 'Bloc-notes avec dessins techniques',
                'description' => 'Petit carnet avec croquis et schémas techniques. Trouvé dans le couloir.',
                'location' => 'Couloir Principal',
                'reward' => null,
                'status' => 'active'
            ],

            // Clothing - Lost items
            [
                'type' => 'lost',
                'category_id' => $clothing->id,
                'title' => 'Veste Nike noire - Taille M',
                'description' => 'Veste de sport Nike noire avec logo blanc. Taille M. Fermeture éclair cassée.',
                'location' => 'Parking',
                'reward' => 80.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $clothing->id,
                'title' => 'Sac à dos Eastpak rouge',
                'description' => 'Sac à dos rouge avec porte-clés Mickey. Contient mes affaires de sport et une gourde.',
                'location' => 'Salle A2',
                'reward' => 60.00,
                'status' => 'active'
            ],

            // Clothing - Found items
            [
                'type' => 'found',
                'category_id' => $clothing->id,
                'title' => 'Pull gris - Taille L',
                'description' => 'Pull en laine gris chiné, taille L. Marque Zara. Trouvé sur une chaise.',
                'location' => 'Amphi 4',
                'reward' => null,
                'status' => 'active'
            ],
            [
                'type' => 'found',
                'category_id' => $clothing->id,
                'title' => 'Casquette New York Yankees',
                'description' => 'Casquette noire avec logo NY brodé. Visière légèrement déformée.',
                'location' => 'Salle B12',
                'reward' => null,
                'status' => 'active'
            ],

            // Accessories - Lost items
            [
                'type' => 'lost',
                'category_id' => $accessories->id,
                'title' => 'Montre Apple Watch Series 7',
                'description' => 'Apple Watch noire avec bracelet sport. Écran fissuré mais fonctionne. Très sentimentale.',
                'location' => 'Laboratoire Informatique',
                'reward' => 200.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $accessories->id,
                'title' => 'Trousseau de clés avec porte-clés BMW',
                'description' => 'Trousseau avec 4 clés et porte-clés BMW. Une clé de voiture, clés de maison.',
                'location' => 'Salle C1',
                'reward' => 100.00,
                'status' => 'active'
            ],

            // Accessories - Found items
            [
                'type' => 'found',
                'category_id' => $accessories->id,
                'title' => 'Lunettes de vue - Monture noire',
                'description' => 'Lunettes de vue avec monture noire rectangulaire. Dans un étui rigide bleu.',
                'location' => 'Salle A7',
                'reward' => null,
                'status' => 'active'
            ],
            [
                'type' => 'found',
                'category_id' => $accessories->id,
                'title' => 'Bracelet en argent',
                'description' => 'Bracelet en argent avec gravure "Sarah 2023". Trouvé près des lavabos.',
                'location' => 'Couloir Principal',
                'reward' => null,
                'status' => 'active'
            ],

            // Documents - Lost items
            [
                'type' => 'lost',
                'category_id' => $documents->id,
                'title' => 'Carte Nationale d\'Identité',
                'description' => 'CNI au nom de Mohamed BENNANI. Urgence absolue pour les examens !',
                'location' => 'Salle B3',
                'reward' => 150.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $documents->id,
                'title' => 'Portefeuille en cuir marron',
                'description' => 'Portefeuille contenant carte d\'étudiant, permis de conduire et quelques dirhams.',
                'location' => 'Cafétéria',
                'reward' => 200.00,
                'status' => 'active'
            ],

            // Documents - Found items
            [
                'type' => 'found',
                'category_id' => $documents->id,
                'title' => 'Carte d\'étudiant ENSA',
                'description' => 'Carte d\'étudiant ENSA Tangier. Photo visible mais nom partiellement effacé.',
                'location' => 'Bibliothèque',
                'reward' => null,
                'status' => 'active'
            ],

            // Other - Lost items
            [
                'type' => 'lost',
                'category_id' => $other->id,
                'title' => 'Gourde en acier inoxydable',
                'description' => 'Gourde blanche avec autocollants de voyage. Très importante, cadeau de ma sœur.',
                'location' => 'Salle C5',
                'reward' => 40.00,
                'status' => 'active'
            ],
            [
                'type' => 'lost',
                'category_id' => $other->id,
                'title' => 'Calculatrice scientifique Casio',
                'description' => 'Calculatrice Casio fx-991EX avec autocollant nom "Fatima". Indispensable pour les maths.',
                'location' => 'Salle A4',
                'reward' => 60.00,
                'status' => 'active'
            ],

            // Other - Found items
            [
                'type' => 'found',
                'category_id' => $other->id,
                'title' => 'Parapluie noir compact',
                'description' => 'Petit parapluie noir pliable. Manche en bois. Trouvé près de l\'entrée.',
                'location' => 'Couloir Principal',
                'reward' => null,
                'status' => 'active'
            ]
        ];

        // Create items with random users and dates
        foreach ($items as $itemData) {
            Item::create([
                'user_id' => $users->random()->id,
                'category_id' => $itemData['category_id'],
                'type' => $itemData['type'],
                'title' => $itemData['title'],
                'description' => $itemData['description'],
                'location' => $itemData['location'],
                'date_found' => Carbon::now()->subDays(rand(1, 30)),
                'reward' => $itemData['reward'],
                'status' => $itemData['status'],
                'expires_at' => Carbon::now()->addDays(rand(30, 90)),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now()->subDays(rand(0, 5))
            ]);
        }
    }
}
