<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExtendedModel;
class Translation extends ExtendedModel
{
    public $timestamps = false;
    protected $table = 'translations';
    protected $lang_model = 'TranslationLang';
    protected $lang_relation = 'translation_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'key',
        'value',
    ];
}