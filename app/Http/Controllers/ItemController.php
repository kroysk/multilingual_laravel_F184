<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\User;
class ItemController extends Controller
{
    protected $model;
    public function __construct()
    {
        $this->model = new Item();
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
    public function update(Request $request, $item)
    {
        $user = User::first();
        $item = $this->model->find($item);
        $item->modify($request->all(), $user->language_id);
        return response()->json($item);
    }
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
    public function search(Request $request)
    {
        $user = User::first();

        // echo $user->language_id;
        if (!$request->search) {
            $items = $this->model->grahp([], $user->language_id)->get();
            return $items;
        }
        if (!$request->searchInAnyLanguage) {
            return $this->model->grahp([], $user->language_id)
            ->where('item_lang.name', 'like', '%' . $request->search . '%')
            ->orWhere('item_lang.description', 'like', '%' . $request->search . '%')->get();
        }
        return $this->model->select('item_id', 'item_lang.name', 'item_lang.description')
        ->join('item_lang', 'items.id', '=', 'item_lang.item_id')
        ->where('item_lang.name', 'like', '%' . $request->search . '%')
        ->orWhere('item_lang.description', 'like', '%' . $request->search . '%')->get();
    }
}