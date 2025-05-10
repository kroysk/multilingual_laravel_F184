<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemLang extends ExtendedModel
{
    public $timestamps = false;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_lang';
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'item_id',
        'language_id',
        'name',
        'description'
    ];

   
}
