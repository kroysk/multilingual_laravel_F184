<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\Translation;
use App\Models\TranslationLang;
use Illuminate\Support\Facades\DB;

class TranslationsSeeder extends Seeder
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

        $languagesToSeed = [
            'en' => $english,
            'es' => $spanish,
            'fr' => $french,
        ];

        $translationsDataEnglish = [
            "WELCOME" => "Welcome",
            "LANGUAGES" => "Languages",
            "TRANSLATIONS" => "Translations",
            "PRODUCTS" => "Products",
            "ADMINISTRATE_LANGUAGES" => "Administrate Languages",
            "CREATE_NEW_LANGUAGE" => "Create New Language",
            "NAME" => "Name",
            "CODE" => "Code",
            "CREATE_LANGUAGE" => "Create Language",
            "EXISTING_LANGUAGES" => "Existing Languages",
            "NO_LANGUAGES_AVAILABLE" => "No languages available or not loaded yet.",
            "ADMINISTRATE_TRANSLATIONS" => "Administrate Translations",
            "CREATE_NEW_TRANSLATION" => "Create New Translation",
            "KEY" => "Key",
            "VALUE" => "Value",
            "CREATE_TRANSLATION" => "Create Translation",
            "EXISTING_TRANSLATIONS" => "Existing Translations",
            "NO_TRANSLATIONS_AVAILABLE" => "No translations available or not loaded yet.",
            "ADMINISTRATE_PRODUCTS" => "Administrate Products",
            "PRODUCT_MANAGEMENT_CONTENT" => "Content for product management...",
            "EDIT" => "Edit",
            "DELETE" => "Delete",
            "SEARCH_IN_ANY_LANGUAGE" => "Search in any language",
            "EXISTING_PRODUCTS" => "Existing Products",
        ];

        $translationsDataSpanish = [
            "WELCOME" => "Bienvenido",
            "LANGUAGES" => "Idiomas",
            "TRANSLATIONS" => "Traducciones",
            "PRODUCTS" => "Productos",
            "ADMINISTRATE_LANGUAGES" => "Administrar Idiomas",
            "CREATE_NEW_LANGUAGE" => "Crear Nuevo Idioma",
            "NAME" => "Nombre",
            "CODE" => "Código",
            "CREATE_LANGUAGE" => "Crear Idioma",
            "EXISTING_LANGUAGES" => "Idiomas Existentes",
            "NO_LANGUAGES_AVAILABLE" => "No hay idiomas disponibles o no se han cargado aún.",
            "ADMINISTRATE_TRANSLATIONS" => "Administrar Traducciones",
            "CREATE_NEW_TRANSLATION" => "Crear Nueva Traducción",
            "KEY" => "Clave",
            "VALUE" => "Valor",
            "CREATE_TRANSLATION" => "Crear Traducción",
            "EXISTING_TRANSLATIONS" => "Traducciones Existentes",
            "NO_TRANSLATIONS_AVAILABLE" => "No hay traducciones disponibles o no se han cargado aún.",
            "ADMINISTRATE_PRODUCTS" => "Administrar Productos",
            "PRODUCT_MANAGEMENT_CONTENT" => "Contenido para la gestión de productos...",
            "EDIT" => "Editar",
            "DELETE" => "Eliminar",
            "SEARCH_IN_ANY_LANGUAGE" => "Buscar en cualquier idioma",
            "EXISTING_PRODUCTS" => "Productos Existentes",
        ];

        $translationsDataFrench = [
            "WELCOME" => "Bienvenue",
            "LANGUAGES" => "Langues",
            "TRANSLATIONS" => "Traductions",
            "PRODUCTS" => "Produits",
            "ADMINISTRATE_LANGUAGES" => "Administrer les langues",
            "CREATE_NEW_LANGUAGE" => "Créer un nouveau langage",
            "NAME" => "Nom",
            "CODE" => "Code",
            "CREATE_LANGUAGE" => "Créer un langage",
            "EXISTING_LANGUAGES" => "Langages existants",
            "NO_LANGUAGES_AVAILABLE" => "Aucun langage disponible ou non chargé.",  
            "ADMINISTRATE_TRANSLATIONS" => "Administrer les traductions",
            "CREATE_NEW_TRANSLATION" => "Créer une nouvelle traduction",
            "KEY" => "Clé",
            "VALUE" => "Valeur",
            "CREATE_TRANSLATION" => "Créer une traduction",
            "EXISTING_TRANSLATIONS" => "Traductions existantes",    
            "NO_TRANSLATIONS_AVAILABLE" => "Aucune traduction disponible ou non chargée.",
            "ADMINISTRATE_PRODUCTS" => "Administrer les produits",
            "PRODUCT_MANAGEMENT_CONTENT" => "Contenu pour la gestion des produits...",
            "EDIT" => "Modifier",
            "DELETE" => "Supprimer",
            "SEARCH_IN_ANY_LANGUAGE" => "Rechercher dans n'importe quelle langue",
            "EXISTING_PRODUCTS" => "Produits existants",
        ];
        



        DB::transaction(function () use ($translationsDataEnglish, $translationsDataSpanish, $translationsDataFrench, $languagesToSeed) {
            foreach ($translationsDataEnglish as $key => $englishValue) {
                // Crear la entrada principal de traducción (usando el inglés como fallback/valor por defecto)
                $translationEntry = Translation::updateOrCreate(
                    ['key' => $key],
                    ['value' => $englishValue]
                );

                // Crear las entradas específicas por idioma
                foreach ($languagesToSeed as $langCode => $languageModel) {
                    $specificValue = $englishValue; // Usar inglés como placeholder para es y fr
                    // Aquí podrías añadir lógica para obtener traducciones reales si las tuvieras
                    if ($langCode === 'es') { $specificValue = $translationsDataSpanish[$key]; }     
                    if ($langCode === 'fr') { $specificValue = $translationsDataFrench[$key]; }
                    TranslationLang::updateOrCreate(
                        [
                            'translation_id' => $translationEntry->id,
                            'language_id' => $languageModel->id,
                        ],
                        ['value' => $specificValue]
                    );
                }
            }
        });

        $this->command->info('Translations table seeded!');
    }
}
