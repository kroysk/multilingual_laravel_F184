<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class ExtendedModel extends Model
{/**
     * Get the attributes that can be translated.
     * translate the attributes to the language specified using the translate function
     * @param string $lang The language to translate to.
     * @param array $options Additional options.
     * @return array The translated attributes.
     */
    public function grahp($query, $lang = null, $options = [])
    {
        $attributes = $this->fillable;
        $attributes = array_map(function ($attribute) {
            //get table name . attribute name
            return $this->getTable() . '.' . $attribute;
        }, $attributes);

        $search = $this->translate($attributes, $lang);

        return $search;
    }

    /**
     * Modify the model with the translated attributes.
     * @param array $attributes The attributes to modify.
     * @param string $lang The language to translate to.
     * @return void
     */
    //function modify to update the model with the translated attributes
    public function modify($attributes, $lang = null)
    {
        $update_language = new \stdClass();
        $model_translate = null;
        $class_translate = null;
        if ($lang !== null) {
            //get the namespace of the model
            $class_translate = "App\\Models\\" . $this->lang_model;
            $model_translate = new $class_translate();
        }

        foreach ($attributes as $attribute => $value) {
            if ($attribute === 'id') {
                continue;
            }
            if (in_array($attribute, $this->fillable, true)) {
                $this->$attribute = $value;
            }
            if ($lang !== null && $attribute !== 'id' && in_array($attribute, $model_translate->fillable, true)) {
                $update_language->$attribute = $value;
            }
        }

        $result = $this->save();

        if ($lang !== null) {
            try {
                $language = $class_translate::where($this->lang_relation, $this->id)->where('language_id', $lang)->first();
                if (!$language) {
                    $language = new $class_translate();
                    $language->{$this->lang_relation} = $this->id;
                    $language->language_id = $lang;
                }
                foreach ($update_language as $key => $value) {
                    $language->$key = $value;
                }
                $language->save();
            } catch (\Exception $e) {
                try {
                    $language = $class_translate::where($this->lang_relation, $this->id)->where('language_id', $lang)->first();
                    if ($language) {
                        foreach ($update_language as $key => $value) {
                            $language->$key = $value;
                        }
                        $language->save();
                    }
                } catch (\Exception $e) {
                    //do nothing
                }
            }
        }

        return $result;
    }

    //translate the attributes to the language specified using the translate function
    /**
     * Translate the attributes to the language specified.
     * @param array $attributes The attributes to translate.
     * @param string $lang The language to translate to.
     * @return array The translated attributes.
     */
    public function translate($attributes, $lang = null)
    {
        try {
            if ($lang === null) {
                return $this->select($attributes);
            }
            $class = "App\\Models\\" . $this->lang_model;
            $model_translate = new $class();
            $select = [];
            foreach ($attributes as $attribute) {
                if ($attribute !== $this->getTable() . '.id' && in_array(str_replace($this->getTable() . '.', '', $attribute), $model_translate->fillable)) {
                    $select[] = DB::raw("COALESCE(" . $model_translate->getTable() . "." . str_replace($this->getTable() . '.', '', $attribute) . ",$attribute) AS " . str_replace($this->getTable() . '.', '', $attribute));
                } else {
                    $select[] = $attribute;
                }
            }
            return $this->select($select)->leftJoin($model_translate->getTable(), function ($query) use ($model_translate, $lang) {
                $query->on($this->getTable() . '.id', '=', $model_translate->getTable() . '.' . $this->lang_relation)
                    ->where($model_translate->getTable() . '.language_id', $lang);
            });
        } catch (\Exception $e) {
            return $this->select($attributes);
        } catch (\Throwable $e) {
            return $this->select($attributes);
        }
    }
}