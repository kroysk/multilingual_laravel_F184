<?php

namespace App\Http\Controllers;

use App\Models\Translation;
use App\Models\User;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Translation();
    }
    public function index()
    {
        return $this->model->all();
    }
    public function store(Request $request)
    {
        $user = User::first();
        $this->model->modify($request->all(), $user->language_id);
        return response()->json($this->model);
    }
    public function update(Request $request, $translation)
    {
        $user = User::first();
        // $translation_model = $this->model->where('id', $translation)->first();
        $translation = $this->model->find($translation);
        $translation->modify($request->all(), $user->language_id);
        return response()->json($translation);
    }
    public function destroy(Translation $translation) 
    {
        $translation->delete();
        return response()->json(['message' => 'Translation deleted successfully']);
    }
}
