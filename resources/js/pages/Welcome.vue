<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
const props = defineProps({
    user: Object,
    languages: Array,
    translations: Array,
    items: Array
});

const activeTab = ref('languages');
const dictionary = ref([]);

async function SelectTab(tab) {
    activeTab.value = tab;
}
async function submitCreateLanguageForm(event) {
    const formData = new FormData(event.target);
    const name = formData.get('name');
    const code = formData.get('code');
    
    try {
        const response = await fetch('/languages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                name: name,
                code: code
            })
        });

        if (!response.ok) {
            alert('Error creating language');
            throw new Error('Error creating language');
        }
        //resolve the response
        const data = await response.json();
        // add the language to the languages array
        props.languages.push(data);
        alert('Language created successfully');
        // Could add success message or refresh languages list here
        
    } catch (error) {
        console.error('Error:', error);
        // Could add error handling UI here
    }
}
async function submitCreateTranslationForm(event) {
    const formData = new FormData(event.target);
    const key = formData.get('key');
    const value = formData.get('value');

    try {
        const response = await fetch('/translations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                key: key,
                value: value
            })
        });

        if (!response.ok) {
            alert('Error creating translation');
            throw new Error('Error creating translation');
        }
        //resolve the response
        const data = await response.json();
        // add the translation to the translations array
        props.translations.push(data);
        alert('Translation created successfully');
    } catch (error) {
        console.error('Error:', error);
        // Could add error handling UI here
    }
}
async function setLanguage(language_id) {
    await fetch(`/set-language/${language_id}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    });
    //reload the page
    location.reload();
}
async function editTranslation(translation_id) {
    var text = await prompt('Enter the new value for the translation', props.translations.find(translation => translation.id === translation_id).value);
    if (text) {
        const response = await fetch(`/translations/${translation_id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ value: text })
        });
        if (!response.ok) {
            alert('Error updating translation');
            throw new Error('Error updating translation');
        }
        alert('Translation updated successfully');
        //reload the page
        location.reload();
    }
}
async function deleteTranslation(translation_id) {
    await fetch(`/translations/${translation_id}`, {
        method: 'DELETE'
    });
}
function translate(key) {
    return dictionary.value[key] || key;
}

const search = ref('');
const searchInAnyLanguage = ref(false);
const items = ref([]);

async function searchItems() {
    const anyLanguage = searchInAnyLanguage.value ? 1 : 0;
    const response = await fetch(`/items/search?search=${search.value}&searchInAnyLanguage=${anyLanguage}`);
    const data = await response.json();
    items.value = data;
}
onMounted(() => {
    console.log(props.translations);
    props.translations.forEach(translation => {
        dictionary.value[translation.key] = translation.value;
    });
    items.value = props.items;
});
</script>

<template>
    <div class="container mx-auto p-4 md:p-6 lg:p-8">
        <!-- Header with the name of the user and a dropdown to change the language -->
        <header class="bg-gray-100 p-4 rounded-lg shadow mb-6 flex flex-col sm:flex-row justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2 sm:mb-0">{{ translate('WELCOME') }}, {{ user ? user.name : 'Invitado' }}</h1>
            <div class="relative">
                <select
                    @change="setLanguage($event.target.value)"
                    name="language"
                    id="language"
                    class="block appearance-none bg-white border border-gray-300 rounded-md py-2 px-4 pr-8 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-700"
                >
                    <option v-if="!languages || languages.length === 0" value="" disabled>Cargando...</option>
                    <option v-for="language in languages" :key="language.id" :value="language.id" :selected="language.id === user.language_id">
                        {{ language.name }}
                    </option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                    </svg>
                </div>
            </div>
        </header>
        <!-- TABS (Language Management, Product Management, Translation Management) -->
        <div class="bg-white p-6 rounded-lg shadow">
            <ul class="flex border-b border-gray-200">
                <li class="-mb-px mr-1">
                    <button @click="SelectTab('languages')" class="inline-block py-2 px-4 text-gray-600 hover:text-blue-600 font-semibold" :class="{ 'bg-blue-500 text-white': activeTab === 'languages' }">
                        {{ translate('LANGUAGES') }}
                    </button>
                </li>
                <li class="mr-1">
                    <button @click="SelectTab('translations')" class="inline-block py-2 px-4 text-gray-600 hover:text-blue-600 font-semibold" :class="{ 'bg-blue-500 text-white': activeTab === 'translations' }">
                        {{ translate('TRANSLATIONS') }}
                    </button>
                </li>
                <li class="mr-1">
                    <button @click="SelectTab('products')" class="inline-block py-2 px-4 text-gray-600 hover:text-blue-600 font-semibold" :class="{ 'bg-blue-500 text-white': activeTab === 'products' }">
                        {{ translate('PRODUCTS') }}
                    </button>
                </li>
            </ul>
        </div>

        <!-- Section for Language Management -->
        <section v-if="activeTab === 'languages'" class="bg-white p-6 rounded-lg shadow mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ translate('ADMINISTRATE_LANGUAGES') }}</h2>
            
            <!-- Form to create language -->
            <form @submit.prevent="submitCreateLanguageForm" class="mb-8 p-4 border border-gray-200 rounded-md">
                <h3 class="text-lg font-medium text-gray-700 mb-3">{{ translate('CREATE_NEW_LANGUAGE') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="create-lang-name" class="block text-sm font-medium text-gray-700 mb-1">{{ translate('NAME') }}:</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="create-lang-name"
                            placeholder="Ej: Español" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        />
                    </div>
                    <div>
                        <label for="create-lang-code" class="block text-sm font-medium text-gray-700 mb-1">{{ translate('CODE') }}:</label>
                        <input 
                            type="text" 
                            name="code" 
                            id="create-lang-code"
                            placeholder="Ej: es (2 letras)" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        />
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    {{ translate('CREATE_LANGUAGE') }}
                </button>
            </form>

            <!-- List of Languages -->
            <div>
                <h3 class="text-lg font-medium text-gray-700 mb-3">{{ translate('EXISTING_LANGUAGES') }}</h3>
                <ul v-if="languages && languages.length > 0" class="space-y-2">
                    <li 
                        v-for="language in languages" 
                        :key="language.id" 
                        class="p-3 bg-gray-50 border border-gray-200 rounded-md flex justify-between items-center"
                    >
                        <span>{{ language.name }} <span class="text-xs text-gray-500">({{ language.code }})</span></span>
                        <!-- Aquí podrías añadir botones de editar/eliminar si es necesario -->
                    </li>
                </ul>
                <p v-else class="text-gray-500 italic">
                    {{ translate('NO_LANGUAGES_AVAILABLE') }}
                </p>
            </div>
        </section>

        <!-- Section for Translation Management -->
        <section v-if="activeTab === 'translations'" class="bg-white p-6 rounded-lg shadow mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ translate('ADMINISTRATE_TRANSLATIONS') }}</h2>
            <!-- Form to create translation -->         
            <form @submit.prevent="submitCreateTranslationForm" class="mb-8 p-4 border border-gray-200 rounded-md">
                <h3 class="text-lg font-medium text-gray-700 mb-3">{{ translate('CREATE_NEW_TRANSLATION') }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="create-translation-key" class="block text-sm font-medium text-gray-700 mb-1">{{ translate('KEY') }}:</label>
                        <input 
                            type="text" 
                            name="key" 
                            id="create-translation-key"
                            placeholder="Ej: 'hello'"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        />
                    </div>
                    <div>
                        <label for="create-translation-value" class="block text-sm font-medium text-gray-700 mb-1">{{ translate('VALUE') }}:</label>
                        <textarea 
                            name="value" 
                            id="create-translation-value"
                            placeholder="Ej: 'Hola'"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        ></textarea>
                    </div>
                </div>
                <button 
                    type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    {{ translate('CREATE_TRANSLATION') }}
                </button>
            </form>
            <!-- List of Translations -->
            <div>
                <h3 class="text-lg font-medium text-gray-700 mb-3">{{ translate('EXISTING_TRANSLATIONS') }}</h3>
                <ul v-if="translations && translations.length > 0" class="space-y-2">
                    <li v-for="translation in translations" :key="translation.id" class="p-3 bg-gray-50 border border-gray-200 rounded-md flex justify-between items-center">
                        <span>{{ translation.key }}</span>
                        <span >{{ translation.value }}</span>
                        <!-- add a button to edit the translation -->
                        <div class="flex items-center gap-2">
                            <button @click="editTranslation(translation.id)" class="text-blue-500 hover:text-blue-700">{{ translate('EDIT') }}</button>
                            <button @click="deleteTranslation(translation.id)" class="text-red-500 hover:text-red-700">{{ translate('DELETE') }}</button>
                        </div>
                    </li>
                </ul>
                <p v-else class="text-gray-500 italic">
                    {{ translate('NO_TRANSLATIONS_AVAILABLE') }}
                </p>
            </div>
        </section>

        <!-- Section for Product Management -->
        <section v-if="activeTab === 'products'" class="bg-white p-6 rounded-lg shadow mt-4">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">{{ translate('ADMINISTRATE_PRODUCTS') }}</h2>
            <!-- Add content for product management here -->
            <p class="text-gray-600">{{ translate('PRODUCT_MANAGEMENT_CONTENT') }}</p>
            <div class="space-y-4">
                <!-- Search input -->
                <div class="relative">
                    <input 
                        type="text" 
                        v-model="search" 
                        placeholder="Search for a product"
                        class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    />
                    <span class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>

                <!-- Language search option -->
                <div class="flex items-center space-x-2 bg-gray-50 p-3 rounded-lg">
                    <input 
                        type="checkbox" 
                        id="searchInAnyLanguage"
                        v-model="searchInAnyLanguage"
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                    />
                    <label 
                        for="searchInAnyLanguage" 
                        class="text-sm text-gray-700 font-medium"
                    >
                        {{ translate('SEARCH_IN_ANY_LANGUAGE') }}
                    </label>
                </div>

                <!-- Search button -->
                <button 
                    @click="searchItems" 
                    class="w-full bg-blue-600 text-white px-6 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition duration-200 ease-in-out flex items-center justify-center space-x-2"
                >
                    <span>Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            <!-- List of products -->
            <div>
                <h3 class="text-lg font-medium text-gray-700 mb-3">{{ translate('EXISTING_PRODUCTS') }}</h3>
                <ul v-if="items && items.length > 0" class="space-y-2">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ translate('NAME') }}</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ translate('DESCRIPTION') }}</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="item in items" :key="item.id" class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ item.name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ item.description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </ul>
                <p v-else class="text-gray-500 italic">
                    {{ translate('NO_PRODUCTS_AVAILABLE') }}
                </p>
            </div>
        </section>
    </div>
</template>

