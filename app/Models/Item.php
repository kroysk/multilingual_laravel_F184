<?php

namespace App\Models;

use App\Models\ExtendedModel;

class Item extends ExtendedModel
{
    protected $table = 'items';
    protected $lang_model = 'ItemLang';
    protected $lang_relation = 'item_id';
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description'
    ];
}

