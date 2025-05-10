<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Item;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $user = User::first();
        $languages = Language::all();
        $translations_model = new Translation();
        $translations = $translations_model->grahp([], $user->language_id)->get();
        $items_model = new Item();
        $items = $items_model->grahp([], $user->language_id)->get();
        return Inertia::render('Welcome', [
            'user' => $user,
            'languages' => $languages,
            'translations' => $translations,
            'items' => $items
        ]);
    }
    public function setLanguage($language_id)
    {
        $user = User::first();
        $user->language_id = $language_id;
        $user->save();
        return redirect()->back();
    }
}
