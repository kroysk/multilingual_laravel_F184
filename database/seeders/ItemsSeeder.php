<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\ItemLang;
use App\Models\Language;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que los idiomas base existan
        $english = Language::firstOrCreate(['code' => 'en'], ['name' => 'English']);
        $spanish = Language::firstOrCreate(['code' => 'es'], ['name' => 'Español']);
        $french = Language::firstOrCreate(['code' => 'fr'], ['name' => 'Français']);

        $languages = [
            'en' => $english,
            'es' => $spanish,
            'fr' => $french,
        ];

        $itemsDataEnglish = [
            "smartphone01" => [
                "name" => "iPhone 15 Pro",
                "description" => "High-end smartphone with A17 Pro chip, 6.1-inch OLED screen, and titanium design."
            ],
            "smartphone02" => [
                "name" => "Samsung Galaxy S24 Ultra",
                "description" => "Powerful Android device with 200 MP camera, integrated S Pen, and 6.8-inch display."
            ],
            "smartphone03" => [
                "name" => "Google Pixel 8 Pro",
                "description" => "Google's flagship phone with integrated AI and advanced computational photography."
            ],
            "smartphone04" => [
                "name" => "OnePlus 12",
                "description" => "Fast phone with ultra-fast charging and 120Hz AMOLED display."
            ],
            "smartphone05" => [
                "name" => "Xiaomi 14 Pro",
                "description" => "Premium phone with Leica camera and Snapdragon 8 Gen 3 processor."
            ],
            "smartphone06" => [
                "name" => "Motorola Edge 50 Ultra",
                "description" => "Elegant mobile with curved design and 50 MP camera with optical stabilization."
            ],
            "smartphone07" => [
                "name" => "Sony Xperia 1 VI",
                "description" => "Phone focused on content creators, with 4K OLED screen and professional video recording."
            ],
            "smartphone08" => [
                "name" => "Asus ROG Phone 8",
                "description" => "Gaming smartphone with advanced cooling system and ultrasonic buttons."
            ],
            "smartphone09" => [
                "name" => "Realme GT 5 Pro",
                "description" => "Powerful and economical phone, with latest generation chipset and super-fast charging."
            ],
            "smartphone10" => [
                "name" => "Honor Magic 6 Pro",
                "description" => "Futuristic phone with periscope camera and great AI performance."
            ],
            "smartphone11" => [
                "name" => "Huawei P60 Pro",
                "description" => "High-level camera with RYYB system, without Google services but with HarmonyOS."
            ],      
            "smartphone12" => [
                "name" => "Nokia XR21",
                "description" => "Ultra-rugged smartphone with military certification and long-lasting battery."
            ],
            "smartphone13" => [
                "name" => "Fairphone 5",        
                "description" => "Designed for sustainability, modular and easy to repair."
            ],
            "smartphone14" => [
                "name" => "ZTE Axon 50 Ultra",
                "description" => "Great performance with front camera hidden under the screen."
            ],
            "smartphone15" => [
                "name" => "Tecno Phantom V Fold",
                "description" => "Economical alternative to foldables with large screen and elegant design."
            ],
            "smartphone16" => [
                "name" => "Vivo X100 Pro",
                "description" => "Camera co-developed with Zeiss, focus on night photography."
            ],
            "smartphone17" => [
                "name" => "Infinix Zero Ultra",
                "description" => "Good value for money with 180W charging and curved AMOLED screen."
            ],
            "smartphone18" => [
                "name" => "Lenovo Legion Duel 2",   
                "description" => "Designed for gaming with active fans and physical buttons."
            ],
            "smartphone19" => [
                "name" => "Oppo Find X7 Ultra",
                "description" => "Premium design and excellent photographic performance with large sensors."
            ],          
            "smartphone20" => [
                "name" => "Cat S75",
                "description" => "All-terrain phone with satellite connectivity and resistance to water, dust, and drops."
            ]   
        ];

        $itemsDataSpanish = [
            "smartphone01" => [
                "name" => "iPhone 15 Pro",
                "description" => "Smartphone de alta gama con chip A17 Pro, pantalla OLED de 6.1 pulgadas y diseño de titanio."
            ],
            "smartphone02" => [
                "name" => "Samsung Galaxy S24 Ultra",
                "description" => "Potente dispositivo Android con cámara de 200 MP, S Pen integrado y pantalla de 6.8 pulgadas."
            ],
            "smartphone03" => [
                "name" => "Google Pixel 8 Pro",
                "description" => "Teléfono insignia de Google con inteligencia artificial integrada y fotografía computacional avanzada."
            ],
            "smartphone04" => [
                "name" => "OnePlus 12",
                "description" => "Teléfono rápido con carga ultra rápida y pantalla AMOLED de 120Hz."
            ],
                "smartphone05" => [
                "name" => "Xiaomi 14 Pro",
                "description" => "Dispositivo premium con cámara Leica y procesador Snapdragon 8 Gen 3."
            ],
            "smartphone06" => [
                "name" => "Motorola Edge 50 Ultra",
                "description" => "Móvil elegante con diseño curvo y cámara de 50 MP con estabilización óptica."
            ],
            "smartphone07" => [
                "name" => "Sony Xperia 1 VI",
                "description" => "Enfocado en creadores de contenido, con pantalla 4K OLED y grabación de video profesional."
            ],
            "smartphone08" => [
                "name" => "Asus ROG Phone 8",
                "description" => "Smartphone gamer con sistema de refrigeración avanzado y botones ultrasónicos."
            ],
            "smartphone09" => [
                "name" => "Realme GT 5 Pro",
                "description" => "Potente y económico, con chipset de última generación y carga súper rápida."
            ],
            "smartphone10" => [
                "name" => "Honor Magic 6 Pro",
                "description" => "Teléfono futurista con cámara periscópica y gran rendimiento en IA."
            ],
            "smartphone11" => [
                "name" => "Huawei P60 Pro",
                "description" => "Cámara de alto nivel con sistema RYYB, sin servicios de Google pero con HarmonyOS."
            ],
            "smartphone12" => [
                "name" => "Nokia XR21",
                "description" => "Smartphone ultra resistente con certificación militar y batería de larga duración."
            ],
            "smartphone13" => [
                "name" => "Fairphone 5",
                "description" => "Diseñado para la sostenibilidad, modular y fácil de reparar."
            ],
            "smartphone14" => [
                "name" => "ZTE Axon 50 Ultra",
                "description" => "Gran rendimiento con cámara frontal oculta bajo la pantalla."
            ],
            "smartphone15" => [
                "name" => "Tecno Phantom V Fold",
                "description" => "Alternativa económica a los plegables con pantalla grande y diseño elegante."
            ],
            "smartphone16" => [
                "name" => "Vivo X100 Pro",
                "description" => "Cámara co-desarrollada con Zeiss, enfoque en fotografía nocturna."
            ],
            "smartphone17" => [
                "name" => "Infinix Zero Ultra",
                "description" => "Buena relación calidad-precio con carga de 180W y pantalla curva AMOLED."
            ],
            "smartphone18" => [
                "name" => "Lenovo Legion Duel 2",
                "description" => "Diseñado para gaming con ventiladores activos y botones físicos."
            ],
            "smartphone19" => [
                "name" => "Oppo Find X7 Ultra",
                "description" => "Diseño premium y excelente desempeño fotográfico con sensores grandes."
            ],
            "smartphone20" => [
                "name" => "Cat S75",
                "description" => "Teléfono todoterreno con conectividad satelital y resistencia al agua, polvo y caídas."
            ]
        ];

        $itemsDataFrench = [
            "smartphone01" => [
                "name" => "iPhone 15 Pro",
                "description" => "Smartphone de haute gamme avec chip A17 Pro, écran OLED de 6.1 pouces et design en titane."
            ],
            "smartphone02" => [
                "name" => "Samsung Galaxy S24 Ultra",
                "description" => "Dispositif Android puissant avec caméra de 200 MP, S Pen intégré et écran de 6.8 pouces."
            ],
            "smartphone03" => [
                "name" => "Google Pixel 8 Pro",
                "description" => "Téléphone insignia de Google avec intelligence artificielle intégrée et photographie numérique avancée."
            ],
            "smartphone04" => [
                "name" => "OnePlus 12",
                "description" => "Téléphone rapide avec charge ultra rapide et écran AMOLED de 120 Hz."
            ],
            "smartphone05" => [
                "name" => "Xiaomi 14 Pro",
                "description" => "Dispositif premium avec caméra Leica et processeur Snapdragon 8 Gen 3."
            ],
            "smartphone06" => [
                "name" => "Motorola Edge 50 Ultra",
                "description" => "Mobile élégant avec design courbé et caméra de 50 MP avec stabilisation optique."
            ],
            "smartphone07" => [
                "name" => "Sony Xperia 1 VI",
                "description" => "Concentré sur les créateurs de contenu, avec écran 4K OLED et enregistrement vidéo professionnel."
            ],
            "smartphone08" => [
                "name" => "Asus ROG Phone 8",
                "description" => "Smartphone gamer avec système de refroidissement avancé et boutons ultrasoniques."
            ],
            "smartphone09" => [
                "name" => "Realme GT 5 Pro",
                "description" => "Puissant et économique, avec chipset de dernière génération et charge ultra rapide."
            ],
            "smartphone10" => [
                "name" => "Honor Magic 6 Pro",
                "description" => "Téléphone futuriste avec caméra periscopique et haut rendement en IA."
            ],
            "smartphone11" => [
                "name" => "Huawei P60 Pro",
                "description" => "Caméra de haut niveau avec système RYYB, sans services Google mais avec HarmonyOS."
            ],
            "smartphone12" => [
                "name" => "Nokia XR21",
                "description" => "Smartphone ultra résistant avec certification militaire et batterie de longue durée."
            ],
            "smartphone13" => [
                "name" => "Fairphone 5",
                "description" => "Conçu pour la durabilité, modulaire et facile à réparer."
            ],
            "smartphone14" => [
                "name" => "ZTE Axon 50 Ultra",
                "description" => "Haute performance avec caméra frontale cachée sous l'écran."
            ],
            "smartphone15" => [
                "name" => "Tecno Phantom V Fold",
                "description" => "Alternative économique aux pliants avec écran grand et design élégant."
            ],
            "smartphone16" => [
                "name" => "Vivo X100 Pro",
                "description" => "Caméra co-développée avec Zeiss, focalisée sur la photographie nocturne."
            ],
            "smartphone17" => [
                "name" => "Infinix Zero Ultra",
                "description" => "Haute performance avec charge de 180 W et écran courbé AMOLED."
            ],
            "smartphone18" => [
                "name" => "Lenovo Legion Duel 2",
                "description" => "Conçu pour le gaming avec ventilateurs actifs et boutons physiques."
            ],
            "smartphone19" => [
                "name" => "Oppo Find X7 Ultra",
                "description" => "Design premium et excellente performance photographique avec capteurs de grande taille."
            ],
            "smartphone20" => [
                "name" => "Cat S75",
                "description" => "Téléphone tout-terrain avec connectivité satellite et résistance à l'eau, à la poussière et aux chutes."
            ]
        ];


        DB::transaction(function () use ($languages, $itemsDataEnglish, $itemsDataSpanish, $itemsDataFrench) {
            foreach ($itemsDataEnglish as $key => $englishValue) {
                // Crear el ítem base (con valores en inglés como default en la tabla items)
                $item = Item::create([
                    'name' => $englishValue['name'],
                    'description' => $englishValue['description'],
                    // Añade aquí otros campos no traducibles si los tienes, ej: 'sku' => "SKU_PROD_{$i}"
                ]);

                // Crear las traducciones para cada idioma
                foreach ($languages as $code => $languageModel) {
                    $name = "";
                    $description = "";

                    switch ($code) {
                        case 'en':
                            $name = $englishValue['name'];
                            $description = $englishValue['description'];
                            break;
                        case 'es':
                            $name = $itemsDataSpanish[$key]['name'];
                            $description = $itemsDataSpanish[$key]['description'];
                            break;
                        case 'fr':
                            $name = $itemsDataFrench[$key]['name'];
                            $description = $itemsDataFrench[$key]['description'];
                            break;
                    }

                    ItemLang::create([
                        'item_id' => $item->id,
                        'language_id' => $languageModel->id,
                        'name' => $name,
                        'description' => $description,
                    ]);
                }
            }
        });

        $this->command->info('Items table seeded with 20 products and translations!');
    }
}
