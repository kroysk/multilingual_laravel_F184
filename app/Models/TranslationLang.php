<?php

namespace App\Models;

use App\Models\ExtendedModel;

class TranslationLang extends ExtendedModel
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'translation_lang';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'translation_id',
        'language_id',
        'value',
    ];

}
