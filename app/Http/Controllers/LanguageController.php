<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public $rules = [
        'name' => 'required|string|min:3|max:255',
        'code' => 'required|string|min:2|max:255',
    ];
    public function index()
    {
        return response()->json(Language::all());
    }
    public function create()
    {
        //validate the request
        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        $language = Language::create($request->all());
        return response()->json($language);
    }
    public function store(Request $request)
    {
        $language = Language::create($request->all());
        return response()->json($language);   
    }
    public function show(Language $language)
    {
        return response()->json($language);
    }
    public function edit(Language $language)
    {
        return response()->json($language);
    }
    public function update(Request $request, Language $language)
    {
        return response()->json($language);
    }
    public function destroy(Language $language)
    {
        return response()->json($language);
    }
}
